<template>
    <div>
        <v-skeleton-loader
            class="mx-auto"
            type="table-heading,table-thead,table-tbody"
            v-show="skeleton"
        ></v-skeleton-loader>
        <v-data-table
            :headers="headers"
            :items="data"
            :items-per-page="data.length"
            class="elevation-1"
            :search="search"
            hide-default-footer
            v-show="!skeleton"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Ссылки</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-dialog v-model="dialog" max-width="550px">
                        <template v-slot:activator="{ on }">
                            <v-row>
                                <v-col cols="8">
                                    <v-btn color="success" dark class="mb-2" v-on="on"
                                    >Добавить
                                    </v-btn
                                    >
                                </v-col>
                                <v-col cols="4">
                                    <v-text-field
                                        v-model="search"
                                        append-icon="mdi-magnify"
                                        label="Поиск"
                                        single-line
                                        hide-details
                                        class="searchInput"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </template>
                        <v-card>
                            <v-card-title class="headline" :class="[isSuccess ? 'success' : 'warning']">
                                <span style="color:white">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-form ref="form"
                                            v-model="valid"
                                            lazy-validation
                                            :class="[isSuccess ? 'addForm' : 'editForm']">
                                        <v-row>
                                            <v-col cols="12">
                                                <v-autocomplete
                                                    v-model="editedItem.link_type_id"
                                                    item-value="id"
                                                    item-text="name"
                                                    :items="linkTypes"
                                                    label="Тип ссылки"
                                                    :rules="requiredList('Тип ссылки')"
                                                ></v-autocomplete>
                                                <v-text-field
                                                    v-model="editedItem.link"
                                                    label="Cсылка"
                                                    :rules="requiredText('Cсылка')"
                                                ></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-form>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="error darken-1" text @click="close">Отмена</v-btn>
                                <v-btn color="success darken-1" text @click="save"
                                >Сохранить
                                </v-btn
                                >
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon color="warning" small class="mr-2" @click="editItem(item)"
                >mdi-pencil
                </v-icon
                >
                <v-icon color="error" small @click="showDeleteDialog(item)"
                >mdi-delete
                </v-icon
                >
            </template>
            <template v-slot:no-data>Нет данных !</template>
        </v-data-table>
        <v-row>
            <v-dialog
                justify="center"
                v-model="deleteDialog"
                persistent
                max-width="350"
            >
                <v-card>
                    <v-card-title class="headline deleteDialogHead"
                    >Вы действительно хотите удалить выбранную строку ?
                    </v-card-title
                    >
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="error darken-1" text @click="deleteDialog = false"
                        >Нет
                        </v-btn
                        >
                        <v-btn color="success darken-1" text @click="deleteItem">Да</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
        <v-snackbar
            v-model="snackbar.show"
            right
            top
            :color="snackbar.color"
            :timeout="snackbar.time"
        >
            {{ snackbar.text }}
            <template v-slot:action="{ attrs }">
                <v-icon @click="snackbar.show = false" color="white"
                >mdi-close-circle-outline
                </v-icon
                >
            </template>
        </v-snackbar>
    </div>
</template>

<script>
    import main from "../../mixins/main.js";

    export default {
        mixins: [main],
        data: () => ({
            linkTypes:[],
            headers: [
                {text: "Действия", value: "actions", sortable: false,width:20},
                {text: "Тип ссылки", value: "link_types.name", sortable: false,width:250},
                { text: "Ссылка", value: "link", sortable: false }
            ],
            coverUrl: '',
            editedItem: {
                link_type_id:undefined,
                link: undefined
            },
            defaultItem: {
                link_type_id:undefined,
                link: undefined
            },
        }),
        created() {
            this.index();
        },
        methods: {
            index() {
                axios
                    .get("/api/v1/links")
                    .then((response) => {
                        this.data = response.data.links;
                        this.linkTypes = response.data.link_types;
                        this.skeleton = false;
                    })
                    .catch(function (error) {
                    });
            },
            store() {
                var validate = this.$refs.form.validate();
                if (validate) {
                    axios.post('/api/v1/links',this.editedItem)
                        .then( (response)=>{
                            this.showSnack("success", "Данные успешно добавлены!");
                            this.data.unshift(response.data.link);
                            this.close();
                        })
                        .catch( (error)=>{
                            this.showSnack("error", "Ссылка на выбранный сервис уже добавлена!");
                        });
                }
            },
            update() {
                var validate = this.$refs.form.validate();
                if (validate) {
                    axios.post("/api/v1/links/" + this.editedItem.id + "?_method=PUT", this.editedItem)
                        .then((response) => {
                            this.showSnack("success", "Данные успешно изменены!");
                            Object.assign(this.data[this.editedIndex], response.data.link);
                            this.close();
                        })
                        .catch( (error)=>{
                            this.showSnack("error", "Ссылка на выбранный сервис уже добавлена!");
                        });
                }
            },
            deleteItem() {
                axios
                    .delete("/api/v1/links/" + this.editedItem.id)
                    .then((response) => {
                            this.data.splice(this.editedIndex, 1);
                            this.showSnack("success", "Данные успешно удалены !");
                            this.close();
                    })
                    .catch(function (error) {
                        this.showSnack("success", "Ошибка сервера!");
                    });
            }
        },
    };
</script>

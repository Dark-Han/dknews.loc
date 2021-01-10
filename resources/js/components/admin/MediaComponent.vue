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
            <template v-slot:item.size_id="{ item }">
                <span>{{getSizeName(item.size_id)}}</span>
            </template>
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Медиа</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-dialog v-model="dialog" max-width="750px">
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
                                            <v-col cols="6">
                                                <v-text-field
                                                    v-model="editedItem.name"
                                                    label="Название"
                                                    :rules="requiredText('Название')"
                                                ></v-text-field>
                                                <v-autocomplete
                                                    v-model="editedItem.size_id"
                                                    item-value="id"
                                                    item-text="name"
                                                    :items="sizes"
                                                    label="Размер"
                                                    :rules="requiredList('Размер')"
                                                ></v-autocomplete>
                                                <v-file-input
                                                    accept="image/*"
                                                    label="Обложка"
                                                    v-model="cover"
                                                    :rules="requiredCover('Обложка')"
                                                ></v-file-input>
                                                <v-img :src='coverUrl' v-show="coverUrl!==null"></v-img>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-autocomplete
                                                    v-model="editedItem.link_count_id"
                                                    item-value="id"
                                                    item-text="name"
                                                    :items="linkCounts"
                                                    label="Кол-во ссылок"
                                                    :rules="requiredList('Кол-во ссылок')"
                                                ></v-autocomplete>
                                                <v-text-field
                                                    v-model="editedItem.link_name1"
                                                    label="Название ссылки 1"
                                                    :rules="requiredText('Название ссылки 1')"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="editedItem.link1"
                                                    label="Ссылка 1"
                                                    :rules="requiredText('Ссылка 1')"
                                                ></v-text-field>

                                                <div v-show="editedItem.link_count_id>1">
                                                    <v-text-field
                                                        v-model="editedItem.link_name2"
                                                        label="Название ссылки 2"
                                                        :rules="editedItem.link_count_id>1?requiredText('Название ссылки 2'):[]"
                                                    ></v-text-field>
                                                    <v-text-field
                                                        v-model="editedItem.link2"
                                                        label="Ссылка 2"
                                                        :rules="editedItem.link_count_id>1?requiredText('Ссылка 2'):[]"
                                                    ></v-text-field>
                                                </div>

                                                <div v-show="editedItem.link_count_id===3">
                                                    <v-text-field
                                                        v-model="editedItem.link_name3"
                                                        label="Название ссылки 3"
                                                        :rules="editedItem.link_count_id===3?requiredText('Название ссылки 3'):[]"
                                                    ></v-text-field>
                                                    <v-text-field
                                                        v-model="editedItem.link3"
                                                        label="Ссылка 3"
                                                        :rules="editedItem.link_count_id===3?requiredText('Ссылка 3'):[]"
                                                    ></v-text-field>
                                                </div>
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
            sizes: [
                {id: 1, name: '460*115'},
                {id: 2, name: '300*275'},
                {id: 3, name: '570*128'}
            ],
            linkCounts: [
                {id: 1, name: '1'},
                {id: 2, name: '2'},
                {id: 3, name: '3'}
            ],
            headers: [
                {text: "Действия", value: "actions", sortable: false, width: 20},
                {text: "Название", value: "name", sortable: false},
                {text: "Размер", value: "size_id", sortable: false},
                {text: "Название ссылки 1", value: "link_name1", sortable: false},
                {text: "Название ссылки 2", value: "link_name2", sortable: false},
                {text: "Название ссылки 3", value: "link_name3", sortable: false}
            ],
            coverUrl: '',
            editedItem: {
                name: "",
                cover: null,
                size_id: 1,
                link_count_id: 1,
                link_name1: '',
                link1: '',
                link_name2: '',
                link2: '',
                link_name3: '',
                link3: ''
            },
            defaultItem: {
                name: "",
                cover: null,
                size_id: 1,
                link_count_id: 1,
                link_name1: '',
                link1: '',
                link_name2: '',
                link2: '',
                link_name3: '',
                link3: ''
            },
        }),
        created() {
            this.index();
        },
        watch: {},
        methods: {
            index() {
                axios
                    .get("/api/v1/medias")
                    .then((response) => {
                        var res = response.data;
                        this.data = res.data;
                        this.skeleton = false;
                    })
                    .catch(function (error) {
                    });
            },
            store() {
                var validate = this.$refs.form.validate();
                if (validate) {
                    var formData = this.getFormDataFrom(this.editedItem);
                    axios.post('/api/v1/medias', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((res) => {
                        this.showSnack("success", "Данные успешно добавлены!");
                        this.data.unshift(res.data.data);
                        this.close();
                    })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            getFormDataFrom(data) {
                var formData = new FormData();
                for (var i in data) {
                    formData.append(i, data[i]);
                }
                return formData;
            },
            update() {
                var validate = this.$refs.form.validate();
                if (validate) {
                    var formData = this.getFormDataFrom(this.editedItem);
                    axios.post("/api/v1/medias/" + this.editedItem.id + "?_method=PUT", formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then((res) => {
                            this.showSnack("success", "Данные успешно изменены!");
                            Object.assign(this.data[this.editedIndex], res.data.data);
                            this.close();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            deleteItem() {
                axios.post("/api/v1/medias/" + this.editedItem.id + "?_method=DELETE", {
                    cover: this.editedItem.cover
                })
                    .then((res) => {
                        this.data.splice(this.editedIndex, 1);
                        this.showSnack("success", "Данные успешно удалены!");
                        this.close();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getSizeName(id){
                for(let i in this.sizes){
                    if(this.sizes[i].id===id){
                        return this.sizes[i].name;
                    }
                }
            }
        },
    };
</script>

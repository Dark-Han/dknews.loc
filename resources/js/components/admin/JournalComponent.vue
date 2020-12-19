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
                    <v-toolbar-title>Журналы</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-dialog v-model="dialog" max-width="850px">
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
                                                    v-model="editedItem.journal_type_id"
                                                    item-value="id"
                                                    item-text="name"
                                                    :items="journalTypes"
                                                    label="Тип"
                                                    :rules="requiredList('Тип')"
                                                ></v-autocomplete>
                                                <v-text-field
                                                    v-model="editedItem.for_year_serial_number"
                                                    label="№ выпуска за год"
                                                    :rules="requiredText('№ выпуска за год')"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="editedItem.for_all_time_serial_number"
                                                    label="№ выпуска за все время"
                                                    :rules="requiredText('№ выпуска за все время')"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-menu
                                                    v-model="dateMenu"
                                                    :close-on-content-click="false"
                                                    :nudge-right="40"
                                                    transition="scale-transition"
                                                    offset-y
                                                    min-width="290px"
                                                >
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-text-field
                                                            v-model="dateFormatted"
                                                            label="Дата выпуска"
                                                            prepend-icon="mdi-calendar"
                                                            readonly
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        ></v-text-field>
                                                    </template>
                                                    <v-date-picker
                                                        v-model="editedItem.release_date"
                                                        locale="ru"
                                                        @input="dateMenu = false"
                                                    ></v-date-picker>
                                                </v-menu>
                                                <div v-if="editedIndex===-1">
                                                    <v-file-input
                                                        label="Журнал"
                                                        v-model="editedItem.journal"
                                                        :rules="requiredCover('Журнал')"
                                                    ></v-file-input>
                                                </div>
                                                <div v-else>
                                                    <v-file-input
                                                        label="Журнал"
                                                        :placeholder="editedIndex>-1?'Заменить журнал':''"
                                                        v-model="editedItem.updatedJournal"
                                                    ></v-file-input>
                                                    <a :href="'/storage/'+editedItem.journal" target="_blank" class="currentFile">Текущий
                                                        журнал</a>
                                                </div>
                                                <v-file-input
                                                    accept="image/*"
                                                    label="Обложка"
                                                    :placeholder="editedIndex>-1?'Заменить обложку':''"
                                                    v-model="cover"
                                                    prepend-icon="mdi-camera"
                                                    :rules="requiredCover('Обложка')"
                                                ></v-file-input>
                                                <v-img :src='coverUrl' v-show="coverUrl!==null"></v-img>
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
            dateMenu: false,
            journalTypes: [],
            headers: [
                {text: "Действия", value: "actions", sortable: false, width: 20},
                {text: "Название", value: "name", sortable: false},
                {text: "Тип", value: "type", sortable: false},
                {text: "Дата выпуска", value: "release_date_jFY", sortable: false}
            ],
            coverUrl: '',
            editedItem: {
                name: "",
                cover: null,
                journal_type_id: 1,
                release_date: new Date().toISOString().substr(0, 10),
                journal: null,
                for_year_serial_number: '',
                for_all_time_serial_number: ''
            },
            defaultItem: {
                name: "",
                cover: null,
                journal_type_id: 1,
                release_date: new Date().toISOString().substr(0, 10),
                journal: null,
                for_year_serial_number: '',
                for_all_time_serial_number: ''
            },
        }),
        created() {
            this.index();
            this.setJournalTypes();
            this.dateFormatted = this.formatDate(new Date().toISOString().substr(0, 10));
        },
        watch: {
            'editedItem.release_date': function (val) {
                this.dateFormatted = this.formatDate(val);
            }
        },
        methods: {
            index() {
                axios
                    .get("/api/v1/journals")
                    .then((response) => {
                        this.data = response.data.data;
                        this.skeleton = false;
                    })
                    .catch(function (error) {
                    });
            },
            store() {
                var validate = this.$refs.form.validate();
                if (validate) {
                    var formData = this.getFormDataFrom(this.editedItem);
                    axios.post('/api/v1/journals', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((response) => {
                        this.showSnack("success", "Данные успешно добавлены!");
                        this.data.unshift(response.data.data);
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
                    axios.post("/api/v1/journals/" + this.editedItem.id + "?_method=PUT", formData, {
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
                axios.delete('/api/v1/journals/' + this.editedItem.id)
                    .then((res) => {
                        this.data.splice(this.editedIndex, 1);
                        this.showSnack("success", "Данные успешно удалены!");
                        this.close();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            async setJournalTypes() {
                axios.get('/api/v1/journal_types')
                    .then((response) => {
                        this.journalTypes = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
    };
</script>

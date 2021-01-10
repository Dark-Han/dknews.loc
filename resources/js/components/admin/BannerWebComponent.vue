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
                    <v-toolbar-title>Баннеры (веб)</v-toolbar-title>
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
                                                <v-text-field
                                                    v-model="editedItem.link"
                                                    label="Ссылка"
                                                    :rules="requiredText('Ссылка')"
                                                ></v-text-field>
                                                <v-autocomplete
                                                    v-model="editedItem.disposition_id"
                                                    item-value="id"
                                                    item-text="name"
                                                    :items="dispositions"
                                                    label="Рассположение"
                                                    :rules="requiredList('Рассположение')"
                                                ></v-autocomplete>
                                                <v-autocomplete
                                                    v-show="editedItem.disposition_id<3"
                                                    v-model="editedItem.serial_number_id"
                                                    item-value="id"
                                                    item-text="name"
                                                    :items="serialNumbers"
                                                    label="Порядковый номер"
                                                    :rules="requiredList('Порядковый номер')"
                                                ></v-autocomplete>
                                                <v-autocomplete
                                                    v-show="editedItem.disposition_id===3"
                                                    v-model="editedItem.category_id"
                                                    item-value="id"
                                                    item-text="name"
                                                    :items="categories"
                                                    label="Категория"
                                                    :rules="editedItem.disposition_id===3?requiredList('Категория')
                                                            :[]"
                                                ></v-autocomplete>
                                                <v-autocomplete
                                                    v-model="editedItem.limit_id"
                                                    item-value="id"
                                                    item-text="name"
                                                    :items="limits"
                                                    label="Тип лимита"
                                                    :rules="requiredList('Тип лимита')"
                                                ></v-autocomplete>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-text-field
                                                    v-show="editedItem.limit_id!==1"
                                                    v-model="editedItem.must_seen"
                                                    label="Лимит"
                                                    type="number"
                                                    min="0"
                                                ></v-text-field>
                                                <v-menu
                                                    v-model="dateMenuSt"
                                                    :close-on-content-click="false"
                                                    :nudge-right="40"
                                                    transition="scale-transition"
                                                    offset-y
                                                    min-width="290px"
                                                >
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-text-field
                                                            v-model="dateFormattedSt"
                                                            label="Дата начала"
                                                            prepend-icon="mdi-calendar"
                                                            readonly
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        ></v-text-field>
                                                    </template>
                                                    <v-date-picker
                                                        v-model="editedItem.date_st"
                                                        locale="ru"
                                                        @input="dateMenuSt = false"
                                                    ></v-date-picker>
                                                </v-menu>

                                                <div v-show="editedItem.limit_id!==2">
                                                    <v-menu
                                                        v-model="dateMenuEn"
                                                        :close-on-content-click="false"
                                                        :nudge-right="40"
                                                        transition="scale-transition"
                                                        offset-y
                                                        min-width="290px"
                                                    >
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-text-field
                                                                v-model="dateFormattedEn"
                                                                label="Дата конец"
                                                                prepend-icon="mdi-calendar"
                                                                readonly
                                                                v-bind="attrs"
                                                                v-on="on"
                                                            ></v-text-field>
                                                        </template>
                                                        <v-date-picker
                                                            v-model="editedItem.date_en"
                                                            locale="ru"
                                                            @input="dateMenuEn = false"
                                                        ></v-date-picker>
                                                    </v-menu>
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
            dateMenuSt:false,
            dateMenuEn:false,
            dateFormattedSt:null,
            dateFormattedEn:null,
            dispositions:[],
            limits:[],
            serialNumbers:[],
            categories:[],
            headers: [
                {text: "Действия", value: "actions", sortable: false,width:20},
                {text: "Название", value: "name", sortable: false},
                {text: "Просмотрено", value: "seen", sortable: false},
                { text: "Ссылка", value: "link", sortable: false },
                { text: "Расположение", value: "disposition.name", sortable: false },
                { text: "Категория", value: "category.name", sortable: false },
                { text: "Порядковый номер", value: "serialNumber.name", sortable: false },
                { text: "Тип лимита", value: "limit.name", sortable: false },
                { text: "Дата начала", value: "date_st_string", sortable: false },
                {text: "Дата конец", value: "date_en_string", sortable: false},
                {text: "Лимит просмотров", value: "must_seen", sortable: false},
            ],
            coverUrl: '',
            editedItem: {
                name: "",
                link: "",
                cover:null,
                disposition_id: 1,
                serial_number_id: 1,
                limit_id: 1,
                must_seen: 0,
                category_id:0,
                date_st: new Date().toISOString().substr(0, 10),
                date_en: new Date().toISOString().substr(0, 10)
            },
            defaultItem: {
                name: "",
                link: "",
                cover:null,
                disposition_id: 1,
                serial_number_id: 1,
                limit_id: 1,
                must_seen: 0,
                category_id:0,
                date_st: new Date().toISOString().substr(0, 10),
                date_en: new Date().toISOString().substr(0, 10)
            },
        }),
        created() {
            this.index();
            this.setDispositions();
            this.setLimits();
            this.setSerialNumbers();
            this.setCategory();
            this.dateFormattedSt=this.formatDate(this.editedItem.date_st);
            this.dateFormattedEn=this.formatDate(this.editedItem.date_en);
        },
        watch: {
            'editedItem.date_st':function (val) {
                this.dateFormattedSt=this.formatDate(val);
            },
            'editedItem.date_en':function (val) {
                this.dateFormattedEn=this.formatDate(val);
            }
        },
        methods: {
            index() {
                axios
                    .get("/api/v1/banners_web")
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
                    axios.post('/api/v1/banners_web', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((response) => {
                        this.showSnack("success", "Данные успешно добавлены!");
                        this.data.unshift(response.data);
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
                    axios.post("/api/v1/banners_web/" + this.editedItem.id + "?_method=PUT", formData, {
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
                axios.post("/api/v1/banners_web/" + this.editedItem.id + "?_method=DELETE", {
                    cover:this.editedItem.cover
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
            setLimits(){
                axios
                    .get("/api/v1/banners/limits")
                    .then((response) => {
                        this.limits = response.data.limits;
                        this.skeleton = false;
                    })
                    .catch(function (error) {
                    });
            },
            setDispositions(){
                axios
                    .get("/api/v1/banners/dispositions")
                    .then((response) => {
                        this.dispositions = response.data.dispositions;
                        this.skeleton = false;
                    })
                    .catch(function (error) {
                    });
            },
            setSerialNumbers(){
                axios
                    .get("/api/v1/banners/serial_numbers")
                    .then((response) => {
                        this.serialNumbers = response.data.serialNumbers;
                        this.skeleton = false;
                    })
                    .catch(function (error) {
                    });
            },
            setCategory(){
                axios
                    .get("/api/v1/categories")
                    .then((response) => {
                        this.categories = response.data.data;
                        this.skeleton = false;
                    })
                    .catch(function (error) {
                    });
            }
        },
    };
</script>

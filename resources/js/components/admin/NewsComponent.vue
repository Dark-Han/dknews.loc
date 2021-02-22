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
                    <v-toolbar-title>Новости</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-dialog v-model="dialog" fullscreen eager>
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
                            <v-toolbar
                                class="headline" :class="[isSuccess ? 'success' : 'warning']"
                            >
                                <v-btn
                                    icon
                                    dark
                                    @click="closeDialog"
                                >
                                    <v-icon>mdi-close</v-icon>
                                </v-btn>
                                    <v-toolbar-title style="color: white">{{formTitle}}</v-toolbar-title>
                                <v-spacer></v-spacer>
                                <v-toolbar-items>
                                    <v-btn
                                        dark
                                        text
                                        @click="save"
                                    >
                                        Сохранить
                                    </v-btn>
                                </v-toolbar-items>
                            </v-toolbar>
                            <v-card-text>
                                <v-container fluid>
                                    <v-form ref="form"
                                            v-model="valid"
                                            lazy-validation
                                            :class="[isSuccess ? 'addForm' : 'editForm']">
                                        <v-row>
                                            <v-col cols="4">
                                                <v-text-field
                                                    label="Название"
                                                    :rules="requiredText('Название')"
                                                    v-model="editedItem.title"
                                                ></v-text-field>
                                                <v-autocomplete
                                                    v-model="editedItem.category_id"
                                                    item-value="id"
                                                    item-text="name_ru"
                                                    :items="categories"
                                                    label="Категория"
                                                    :rules="requiredList('Категория')"
                                                ></v-autocomplete>
                                                <v-autocomplete
                                                        v-model="editedItem.language_id"
                                                        item-value="id"
                                                        item-text="name"
                                                        :items="languages"
                                                        label="Тип языка"
                                                        :rules="requiredList('Тип языка')"
                                                ></v-autocomplete>
                                                <v-file-input
                                                        accept="image/*"
                                                        ref="newsCover"
                                                    label="Обложка"
                                                    @change="coverUploadhandler"
                                                    :rules="requiredImage('Обложка')"
                                                    :placeholder="editedIndex>-1?'Заменить обложку':''"
                                                ></v-file-input>

                                                <p class="radioBtnTitle primary--text">Расположение</p>
                                                <v-radio-group v-model="editedItem.disposition_id">
                                                    <v-row>
                                                        <v-col
                                                            v-for="(disposition,i) in dispositions"
                                                            :key="i">
                                                            <v-radio
                                                                :label="disposition.name"
                                                                color="success"
                                                                hide-details
                                                                class="checkboxBtn"
                                                                :value="disposition.id"
                                                            ></v-radio>
                                                        </v-col>
                                                    </v-row>
                                                </v-radio-group>

                                                <v-col cols="4 foreverSwitch">
                                                    <v-switch
                                                        v-model="editedItem.forever"
                                                        inset
                                                        label="На вечно"
                                                    ></v-switch>
                                                </v-col>

                                                <div v-show="!editedItem.forever">
                                                    <div v-show="showLimitList">
                                                        <p class="radioBtnTitle primary--text">Тип лимита</p>
                                                        <v-radio-group v-model="editedItem.limit_id">
                                                            <v-row>
                                                                <v-col
                                                                    v-for="(limit,i) in limits"
                                                                    :key="i">
                                                                    <v-radio
                                                                        :label="limit.name"
                                                                        color="success"
                                                                        hide-details
                                                                        class="checkboxBtn"
                                                                        :value="limit.id"
                                                                    ></v-radio>
                                                                </v-col>
                                                            </v-row>
                                                        </v-radio-group>
                                                    </div>
                                                    <v-text-field
                                                        v-show="showLimit"
                                                        v-model="editedItem.must_seen"
                                                        label="Лимит"
                                                        type="number"
                                                        min="0"
                                                    ></v-text-field>
                                                    <timestamp-component
                                                        :currentDate="editedItem.timestampSt"
                                                        :editedIndex="editedIndex"
                                                        @onSetTimestamp="setTimestamp('timestampSt',$event)"
                                                        v-if="dialog"
                                                    ></timestamp-component>

                                                    <timestamp-component
                                                        v-show="showDateEn"
                                                        :currentDate="editedItem.timestampEn"
                                                        :editedIndex="editedIndex"
                                                        @onSetTimestamp="setTimestamp('timestampEn',$event)"
                                                        v-if="dialog"
                                                    ></timestamp-component>
                                                </div>
                                            </v-col>
                                            <v-col cols="8" id="editor">
                                                    <editor-component
                                                            :api-key="tinymceApiKey"
                                                            :init='tinymceInit'
                                                            v-model="editedItem.text"
                                                            @onInit="editorLoad"
                                                            v-if="editorActivated"
                                                    />
                                            </v-col>
                                        </v-row>
                                    </v-form>
                                </v-container>
                            </v-card-text>
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
                >mdi-close-cir-outline
                </v-icon
                >
            </template>
        </v-snackbar>
    </div>
</template>

<script>
    import main from "../../mixins/main.js";
    import Editor from '@tinymce/tinymce-vue'
    import tinymce from "../../mixins/tinymce.js";
    import Timestamp from "../formInputs/TimestampComponent";

    export default {
        mixins: [main, tinymce],
        components: {
            'editor-component': Editor,
            'timestamp-component': Timestamp
        },
        data: () => ({
            editor:null,
            editorActivated:false,
            showLimit:false,
            showLimitList:false,
            showDateEn:true,
            categories: [],
            dispositions: [],
            limits: [],
            languages: [],
            headers: [
                {text: "Действия", value: "actions", sortable: false, width: 20},
                {text: "Заголовок", value: "title", sortable: false},
                {text: "Категория", value: "category.name_ru", sortable: false},
                {text: "Расположение", value: "disposition.name", sortable: false},
                {text: "Тип лимита", value: "limit.name", sortable: false},
                {text: "На вечно", value: "foreverStr", sortable: false},
                {text: "Дата начала", value: "date_st_str", sortable: false},
                {text: "Дата конца", value: "date_en_str", sortable: false},
                {text: "Просмотрено", value: "seen", sortable: false},
                {text: "Лимит", value: "must_seen", sortable: false},
            ],
            coverUrl: '',
            editedItem: {
                title:'',
                category_id: '',
                language_id:1,
                text:'',
                disposition_id: 1,
                timestampSt: null,
                timestampEn: null,
                seen: 0,
                must_seen: 0,
                limit_id: 1,
                limit:0,
                forever: false,
                cover: null,
                uploadedImages: []
            },
            defaultItem: {
                title:'',
                category_id: '',
                language_id:1,
                text:'',
                disposition_id: 1,
                timestampSt: null,
                timestampEn: null,
                seen: 0,
                must_seen: 0,
                limit_id: 1,
                limit:0,
                forever: false,
                cover: null,
                uploadedImages: []
            },
        }),
        created() {
            this.index();
            this.getCategories();
            this.getDispositions();
            this.getLimits();
            this.getLanguages();
            this.setTinymceImageUploaderConfig();
        },
        mounted(){
            this.activateEditor();
        },
        watch: {
            'editedItem.date_st': function (val) {
                this.dateStFormatted = this.formatDate(val);
            },
            'editedItem.date_en': function (val) {
                this.dateEnFormatted = this.formatDate(val);
            },
            'editedItem.disposition_id':function (val) {
                if(val===1){
                    this.showLimit=false;
                    this.showLimitList=false;
                    this.showDateEn=true;
                }else{
                    this.showLimitList=true;
                }
            },
            'editedItem.limit_id':function (val) {
                if(val===2){
                    this.showDateEn=false;
                }else{
                    this.showDateEn=true;
                }
                if (val===1){
                    this.showLimit=false;
                }else{
                    this.showLimit=true;
                }
            },
            dialog(val){
                if(!val){
                    this.$refs.newsCover.reset();
                }
            }
        },
        methods: {
            index() {
                axios
                    .get('/api/v1/news')
                    .then((response) => {
                        this.data = response.data.data;
                        this.skeleton = false;
                    })
                    .catch(function (error) {
                    });
            },
            getCategories() {
                axios.get('/api/v1/categories')
                    .then((response) => {
                        this.categories = response.data.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            getDispositions() {
                axios.get('/api/v1/dispositions')
                    .then((response) => {
                        this.dispositions = response.data.dispositions;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            getLimits() {
                axios.get('/api/v1/limits')
                    .then((response) => {
                        this.limits = response.data.limits;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            getLanguages() {
                axios.get('/api/v1/languages')
                    .then((response) => {
                        this.languages = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            editorLoad($event, editor) {
                this.editor = editor;
            },
            store() {
                var validate = this.$refs.form.validate();
                if (validate) {
                    axios.post('/api/v1/news', this.editedItem)
                        .then((response) => {
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
                console.log(this.editedItem);
                axios
                    .put('/api/v1/news/' + this.editedItem.id, this.editedItem)
                    .then((response) => {
                        this.showSnack("success", "Данные успешно изменены!");
                        Object.assign(this.data[this.editedIndex], response.data.data);
                        this.close();
                    })
                    .catch((error)=>{
                        this.showSnack("error", "Ошибка при изменении данных!");
                    });
            },
            deleteItem() {
                axios
                    .delete('/api/v1/news/' + this.editedItem.id)
                    .then((response) => {
                        this.data.splice(this.editedIndex, 1);
                        this.showSnack("success", "Данные успешно удалены !");
                        this.close();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            editItem(item) {
                this.editedIndex = this.data.indexOf(item);
                this.editedItem = {
                    id: item.id,
                    title: item.title,
                    cover: item.cover,
                    disposition_id: item.disposition.id,
                    language_id: item.language_id,
                    limit_id: item.limit.id,
                    category_id: item.category.id,
                    text: item.text,
                    seen: item.seen,
                    must_seen: item.must_seen,
                    forever: item.forever,
                    timestampSt: {
                        date: item.date_st,
                        time: item.date_st
                    },
                    timestampEn: {
                        date: item.date_en,
                        time: item.date_en
                    },
                    uploadedImages: []
                };
                this.dialog = true;
            },
            setTimestamp(paramName, timestamp) {
                this.editedItem[paramName] = {
                    date: timestamp.date,
                    time: timestamp.time
                };
            },
            coverUploadhandler(image) {
                let formData = new FormData();
                formData.append('file', image);
                axios.post('/api/v1/news/image?_method=PUT', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((response) => {
                    let path = response.data.path;
                    this.editedItem.uploadedImages.push({'path': path});
                    this.editedItem.cover = path;
                    //Ищем обложку в теле новости
                    var editor = document.querySelector('iframe').contentDocument.body;
                    let cover = editor.querySelector('#cover');
                    //Если обложка существует то заменяем её
                    if (cover !== null) {
                        this.updateCoverForAllLngEditors();
                    }
                    //Если не существует создаём новую
                    else {
                        this.setCoverForAllLngEditors();
                    }
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            setTinymceImageUploaderConfig() {
                this.tinymceInit.images_upload_handler = this.imageUploadhandler;
            },
            imageUploadhandler(blobInfo, success, failure, progress) {
                let formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                axios.post('/api/v1/news/image?_method=PUT', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((response) => {
                    let path = response.data.path;
                    this.editedItem.uploadedImages.push({'path': path});
                    success('/storage/' + path);
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            closeDialog(){
                if(this.editedItem.uploadedImages.length!==0){
                    this.deleteUploadedImagesOfNotCreatedNews();
                }
                this.dialog=false;
            },
            deleteUploadedImagesOfNotCreatedNews() {
                axios.post('/api/v1/news/image?_method=DELETE', {
                    uploadedImages:this.editedItem.uploadedImages
                })
                    .then((response) => {
                    let path = response.data.path;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            setCoverForAllLngEditors(){
                let newCoverPath=this.editedItem.cover;
                    this.editor.execCommand('mceInsertContent', false, '</br>' +
                        '<img src="/storage/' + newCoverPath + '" id="cover" height="250px" width="350px"></img>');
                    this.editedItem.text = this.editor.getContent();
            },
            updateCoverForAllLngEditors(){
                let updatedCoverPath=this.editedItem.cover;
                this.editor.dom.setAttribs(
                    this.editor.dom.select('#cover'), {'src': '/storage/' + updatedCoverPath}
                );
                this.editedItem.text = this.editor.getContent();
            },
            activateEditor(){
                this.editorActivated=true;
            }
        }
    };
</script>

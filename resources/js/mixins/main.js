export default {
    data: () => ({
      data: [],
      cover:null,
      coverUrl:null,
      isSuccess:false,
      valid: true,
      skeleton: true,
      editedIndex: -1,
      dialog: false,
      deleteDialog: false,
      snackbar: {
        show: false,
        color: "",
        text: "",
        time: 2000,
      },
      search: "",
    }),
    computed: {
      formTitle() {
        if(this.editedIndex===-1){
          this.isSuccess=true;
          return "Добавление данных";
        }else{
          this.isSuccess=false;
          return "Изменение данных";
        }
      },
    },
    watch: {
      dialog(val) {
        val || this.close();
      },
      cover(newVal){
            if(typeof(newVal)==='string'){
                this.cover = null;
                this.$nextTick(() => {
                    this.coverUrl='/storage/'+newVal;
                });
            }else if(newVal instanceof File){
                this.coverUrl= URL.createObjectURL(newVal)
                if(this.editedIndex>-1){
                    this.editedItem.updatedCover=newVal;
                }else{
                    this.editedItem.cover=newVal;
                }
            }else if(newVal===undefined){
                if(this.editedIndex>-1){
                  this.coverUrl='/storage/'+this.editedItem.cover;
                  delete this.editedItem.updatedCover;
                }else{
                  this.coverUrl=null;
                }
            }
      },
      'editedItem.cover':function(val){
        this.cover=val;
      }
    },
    methods: {
      requiredText(name) {
        return [(v) => !!v || name + " не заполнено!"];
      },
      requiredNumber(name) {
        return [
          (v) => !!v || name + " не заполнено!",
          (v) => Number.isInteger(Number(v)) || name + " должен быть числом!",
        ];
      },
      requiredImage(name) {
        return [(v) => !!v || name + " не загружена!"];
      },
      requiredCover(name) {
        if(this.editedIndex===-1){
          return this.requiredImage(name);
        }
      },
      requiredList(name) {
        return [(v) => !!v || name + " не выбрана!"];
      },
      editItem(item) {
            this.editedIndex = this.data.indexOf(item);
            this.editedItem = Object.assign(this.editedItem, item);
            this.dialog = true;
        },
      showDeleteDialog(item) {
        this.editedIndex = this.data.indexOf(item);
        this.editedItem = Object.assign(this.editedItem, item);
        this.deleteDialog = true;
      },
      showSnack(color, msg, time = 2000) {
        this.snackbar.show = true;
        this.snackbar.color = color;
        this.snackbar.text = msg;
        this.snackbar.time = time;
      },
      close() {
        this.dialog = false;
        this.deleteDialog = false;
        this.coverUrl=null;
        this.cover=null;
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        });
        this.$refs.form.resetValidation();
      },
      save() {
        if (this.editedIndex > -1) {
          this.update();
        } else {
          this.store();
        }
      },
      getName(id, options) {
        for (var key in options) {
          if (options[key].id == id) {
            return options[key].name;
          }
        }
      },
        formatDate(date){
            if (!date) return null;
            const [year, month, day] = date.split('-');
            return `${day}.${month}.${year}`;
        }
    },
  };

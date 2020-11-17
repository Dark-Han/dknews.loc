export default {
    data: () => ({
      data: [],
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
        return this.editedIndex === -1 ? "Добавление данных" : "Изменение данных";
      },
    },
    watch: {
      dialog(val) {
        val || this.close();
      },
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
        return [(v) => !!v || "'" + name + "' не загружена!"];
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
    },
  };
  
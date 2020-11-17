require("./bootstrap");
window.Vue = require("vue");

import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
import VueRouter from "vue-router";

Vue.use(Vuetify);
Vue.use(VueRouter);

const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/admin/categories",
      component: require("./components/admin/CategoryComponent.vue").default,
    },
  ],
});

Vue.component(
  "layout-component",
  require("./components/admin/LayoutComponent.vue").default
);

const app = new Vue({
  el: "#adminPanel",
  vuetify: new Vuetify(),
  router,
});

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
    {
      path: "/admin/news",
      component: require("./components/admin/NewsComponent.vue").default,
    },
      {
          path: "/admin/links",
          component: require("./components/admin/LinkComponent.vue").default,
      },
      {
          path: "/admin/newspapers",
          component: require("./components/admin/NewspaperComponent.vue").default,
      },
      {
          path: "/admin/journals",
          component: require("./components/admin/JournalComponent.vue").default,
      },
      {
          path: "/admin/banners_web",
          component: require("./components/admin/BannerWebComponent.vue").default,
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

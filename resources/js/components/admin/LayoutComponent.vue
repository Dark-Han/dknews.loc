<template>
  <v-app id="inspire">
    <v-app id="inspire">
      <v-navigation-drawer v-model="drawer" app clipped class>
        <v-list dense>
          <v-list-item to="/admin/categories">
            <v-list-item-content>Категории</v-list-item-content>
          </v-list-item>
          <v-list-item to="/admin/news">
            <v-list-item-content>Новости</v-list-item-content>
          </v-list-item>
            <v-list-item to="/admin/links">
                <v-list-item-content>Ссылки</v-list-item-content>
            </v-list-item>
        </v-list>
      </v-navigation-drawer>

      <v-app-bar app clipped-left>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>Админ панель</v-toolbar-title>
      </v-app-bar>

      <v-main>
        <router-view></router-view>
      </v-main>
    </v-app>
  </v-app>
</template>

<script>
export default {
  mounted() {},
  data: () => ({
    drawer: null,
  }),

  created() {},
};
</script>

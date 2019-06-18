<template>
      <v-content>
      <v-navigation-drawer
        :clipped="clipped" v-model="drawer" enable-resize-watcher :hide-overlay=false app dark class="primary lighten-3"
      >
        <v-list class="pt-0" dense>
          <v-divider></v-divider>
          <v-list-tile
            v-for="item in menu"
            :key="item.title"
            :to="item.link"
          >
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-navigation-drawer>
    <v-toolbar status fixed app :clipped-left="clipped">
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-toolbar-title >Gestion d'élèves</v-toolbar-title>
    </v-toolbar>
      </v-content>
</template>

<script>

  export default {
    data() {
    return {
      drawer: true,
      clipped: false,
      menu: [
        { icon: "home", title: "Home", link: "/" },
        { icon: "info", title: "About", link: "/about" },
        { icon: "warning", title: "Link C" }
            ]
        };
    },

    methods: {
        menuItems() {
        return this.menu;
        }
    }
  }
</script>

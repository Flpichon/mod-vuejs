<template>
    <v-toolbar status>
        <v-toolbar-title >Gestion d'élèves</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-sm-and-down">
            <v-btn color="grey" v-for="item in menu" :key="item.icon" :to="item.link">
                {{item.title}}
            </v-btn>
        </v-toolbar-items>
        <v-menu class="hidden-md-and-up">
          <v-toolbar-side-icon slot="activator"></v-toolbar-side-icon>
          <v-list>
            <v-list-tile v-for="item in menu" :key="item.icon" :to="item.link">
              <v-list-tile-content>
                <v-list-tile-title>{{ item.title }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
        </v-menu>
    </v-toolbar>
</template>

<script>
  export default {
    data() {
    return {
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

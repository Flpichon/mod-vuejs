<template>
      <v-container class="hidden-md-and-up">
        <v-layout left>
        <v-btn fab dark color="teal" @click.stop="drawer = !drawer">
          <v-icon dark>list</v-icon>
        </v-btn>
      </v-layout>
      <v-navigation-drawer 
        v-model="drawer"
        app
        absolute
        temporary
      >
        <v-toolbar flat class="transparent">
          <v-list class="pa-0">
            <v-list-tile avatar>
              <v-list-tile-avatar>
                <img src="https://randomuser.me/api/portraits/men/85.jpg">
              </v-list-tile-avatar>
  
              <v-list-tile-content>
                <v-list-tile-title>truc</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
        </v-toolbar>
  
        <v-list class="pt-0" dense>
          <v-divider></v-divider>
  
          <v-list-tile
            v-for="item in items"
            :key="item.title"
            :to="item.to"
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
      </v-container>
</template>

<script>
  export default {
    data() {
    return {
      drawer: true,
      items: [
        { icon: "home", title: "Home", to: "/" },
        { icon: "info", title: "About", to: "/about" },
        { icon: "warning", title: "Link C", to: "/about" }
            ]
        };
        
    },

    methods: {
        menuItems() {
        return this.items;
        }
    }
  }
</script>
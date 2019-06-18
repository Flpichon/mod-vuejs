<template>
      <v-navigation-drawer class="hidden-sm-and-down"
        v-model="drawer"
        app
        
      >
        <v-toolbar flat class="transparent">
          <v-list class="pa-0">
            <v-list-tile avatar>
              <v-list-tile-avatar>
                <img src="https://randomuser.me/api/portraits/men/85.jpg">
              </v-list-tile-avatar>
  
              <v-list-tile-content>
                <v-list-tile-title>John Leider</v-list-tile-title>
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
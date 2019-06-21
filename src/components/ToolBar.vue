<template>
      <v-content>
      <v-navigation-drawer
        :clipped="clipped" v-model="drawer" enable-resize-watcher :hide-overlay=false app dark
      >
              <v-toolbar flat class="transparent">
          <v-list class="pa-0">
            <v-list-tile avatar>
              <v-list-tile-avatar>
                <img src="https://randomuser.me/api/portraits/men/85.jpg">
              </v-list-tile-avatar>
            </v-list-tile>
          </v-list>
        </v-toolbar>
          <v-divider></v-divider>
          <v-list-tile class="slow-transition m-2 btn"
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
<style lang="scss">

   .v-list__tile__title
   {
     font-size: 15px;
   }
   .v-navigation-drawer{
     background-image: url(/src/assets/8196.jpg);
    background-size:auto;
    text-align: center;
   }

.slow-transition {
	box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0);
	transition: all 500ms;
} 
.slow-transition:hover {
	box-shadow: 0 10px 50px 0 rgba(0, 0, 0, 0.3);
}
.btn{
  background-color: #E8513C;
  width: 85%;
  color : #ffffff !important;
  text-decoration: none !important;
}
.btn:hover{
    background-color:#FF8050;
    width: 90%;
}
</style>

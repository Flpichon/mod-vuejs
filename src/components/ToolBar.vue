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
        </v-toolbar >
          <v-divider></v-divider>
          <v-list-tile class="slow-transition m-2 btn"
            v-for="item in menu"
            :key="item.title"
            @click="Redirect(item.link)"
          >
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
      </v-navigation-drawer>
    <v-toolbar status fixed app :clipped-left="clipped"  class="deep-purple darken-2">
        <v-toolbar-side-icon class="white--text" @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-toolbar-title class="white--text font-weight-thin">Gestion d'élèves</v-toolbar-title>
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
        { icon: "info", title: "Eleves", link: "/eleve" }
            ]
        };
    },

    methods: {
        menuItems() {
        return this.menu;
        },
        Redirect(link) {
          this.$router.push(link) 
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
      background-size:400%;
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
  background-color: rgba(142, 93, 182, 0.664);
  width: 85%;
  color : #ffffff !important;
  text-decoration: none !important;
}
.btn:hover{
    background-color:rgba(179, 165, 243, 0.513);;
    width: 90%;
}
</style>

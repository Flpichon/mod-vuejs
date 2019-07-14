<template>
      <v-content>
        <v-navigation-drawer :class="theme.src" :clipped="clipped" v-model="drawer" enable-resize-watcher :hide-overlay=false app dark>
          <v-toolbar flat class="transparent">
            <v-list v-model="currentImg" class="">
                  <img  @click="changeImg()" class="avatar" :src="currentImg">
            </v-list>
          </v-toolbar >
            <v-divider class="mt-5"></v-divider>
            <v-list-tile :style="{'background':$store.getters['themeColor']}" class="slow-transition m-2 btn"
              v-for="item in menu"
              :key="item.title"
              @click="Redirect(item.link)"
            >
              <v-list-tile-action>
                <v-icon medium>{{ item.icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ item.title }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
        </v-navigation-drawer>
        <v-toolbar status fixed app :clipped-left="clipped" :scroll-off-screen="true" :class="theme.color" :color="$store.getters['themeColor']" >
            <v-toolbar-side-icon class="white--text" @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title class="white--text font-weight-thin">Klass ~ Gestion d'élèves</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-menu :nudge-width="50">
          <template v-slot:activator="{ on }">
            <v-toolbar-title v-on="on">
              <span class="white--text font-weight-thin">thème</span>
              <v-icon dark>arrow_drop_down</v-icon>
            </v-toolbar-title>
          </template>
         <colorChoice/>
        </v-menu>
        </v-toolbar>
      </v-content>
</template>

<script>
  import colorChoice from './colorChoice'
  export default {
    components : {
      colorChoice
    },
    data() {
    return {
      theme:{nom:"default2" , color: "colorviolets", btnmenu: "btn",src:"v-navigation-violet"},
      toto:[],
      i:0,
      currentImg:"",
      drawer: true,
      clipped: false,
      img: [
      {img: '/src/assets/klass-blue-png.png'},
      {img: '/src/assets/klass-green-png.png'},
      {img: '/src/assets/klass-red-png.png'}
      ],
      menu: [
        { icon: "meeting_room", title: "Classes", link: "/" },
        { icon: "school", title: "Eleves", link: "/eleve" },
        { icon: "event_note", title: "Matières", link: "/matiere" },
            ]
        };
    },
    mounted() {
      this.toto = this.$store.state.theme1
      this.currentImg = this.changeImg();
    },
    methods: {
        select(item){
          this.theme = item;
          this.$store.commit('setTheme', {
            item
          })
        },
        menuItems() {
        return this.menu;
        },
        Redirect(link) {
          this.$router.push(link) 
        },
        imgList(){
        return this.img;
        },
        changeImg(){
          let oldImg = this.currentImg;
          let rand = Math.random();
          let totalImg = this.img.length;
          let randIndex = Math.floor(rand * totalImg);
          let randomImg = this.img[randIndex].img;
          let i = 0;
          if (randomImg === oldImg)
            {
              if (randIndex !== this.img.length-1) {
                randomImg = this.img[randIndex + 1].img;
              } else {
                randomImg = this.img[0].img;
              }
            }
          this.i ++;
          this.currentImg = randomImg;
            if (this.i >= 5)
            {
              this.currentImg = "/src/assets/truc.gif";
            }
          return randomImg;
        }
    }
  }
</script>
<style lang="scss">

   .v-list__tile__title
   {
     font-size: 15px;
   }
   .v-navigation-violet{
     background-image: url(/src/assets/8196.jpg);
      background-size:400%;
      text-align: center;
   }

   .v-navigation-orange{
     background-image: url(/src/assets/6530.jpg);
      background-size:300%;
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
 // background-color: rgba(142, 93, 182, 0.664);
  width: 85%;
  color : #ffffff !important;
  text-decoration: none !important;
}
.btn:hover{
  //  background-color:rgba(165, 124, 199, 0.664);
    width: 90%;
}
.btnazur{
  background-color: rgba(240, 92, 24, 0.664)!important;

}
.btnazur:hover{
    background-color:rgba(231, 119, 67, 0.664)!important;

}
.colororange{
  background-color: rgb(212, 81, 20)!important;
}
.colorviolet {
  background-color: #512DA8 !important;
}
.avatar {
  width: 150px !important;
  height: auto !important;
  margin-top: 0px;
  margin-left: 0px;
}
</style>

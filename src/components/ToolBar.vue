<template>
      <v-content>
      <v-navigation-drawer
        :clipped="clipped" v-model="drawer" enable-resize-watcher :hide-overlay=false app dark
      >
        <v-toolbar flat class="transparent">
          <v-list v-model="currentImg" class="">
                <img  @click="changeImg()" class="avatar" :src="currentImg">
          </v-list>
        </v-toolbar >
          <v-divider class="mt-5"></v-divider>
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
        { icon: "home", title: "Accueil", link: "/" },
        { icon: "info", title: "Eleves", link: "/eleve" },
        { icon: "info", title: "Matières", link: "/matiere" },
        { icon: "info", title: "About", link: "/about" }
            ]
        };
    },
    mounted() {
      this.currentImg = this.changeImg();
    },
    methods: {

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
            
            console.log(this.i);
          this.currentImg = randomImg;
            if (this.i >= 28)
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
.avatar {
  width: 150px !important;
  height: auto !important;
  margin-top: 0px;
  margin-left: 0px;
}
</style>

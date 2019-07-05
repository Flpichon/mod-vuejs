<template>
  <div id="app" class="background-img">
    <v-app light id="inspire">
        <notifications group="app" />
        <ToolBar/>
        <v-content class="min-padding">
          <v-container fluid>
            <router-view></router-view>
          </v-container>
        </v-content>
      <Footer/>
    </v-app>
  </div>
</template>

<script>
import ToolBar from './components/ToolBar'
import Footer from './components/Footer'

export default {
  name: 'App',
  components: {
    ToolBar,
    Footer
  },
  data () {
    return {
      //
    }
  }
}
</script>
<style>
.background-img {
  background-image: url("/src/assets/1511.jpg");
  min-height: 500px; 
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
#inspire {
  background: none;
}
.min-padding {
  padding-top: 0px !important;
}
.success{
  width: 300px;
  height: 120px;
  font-size: 17px !important;
  text-align: center !important;
  border-radius: 3%;
  border-top-right-radius: 0% !important;
}
.border {
  border-radius: 5%;
}
.purple-color {
   background-color: rgba(142, 93, 182, 0.664) !important; 
   color: #FFFFFF !important;
}
.width100{
  width: 100%;
}
.w150{
  width: 150px;
}
.iconsmall{
  width: 30px;
  height: 30px;
}
.textbold{
  font-weight: bold;
}
</style>


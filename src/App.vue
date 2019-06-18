<template>
  <div id="app">
    <v-app id="inspire">
      <v-parallax class="parallax" src="/src/assets/1511.jpg">
        <Drawer/>
        <ToolBar/>
        <v-content>
        <notifications group="app" />
        <router-view></router-view>
        </v-content>
      </v-parallax>
      <Footer/>
    </v-app>
  </div>
</template>

<script>
//import HelloWorld from './components/HelloWorld'
import Drawer from './components/Drawer'
import ToolBar from './components/ToolBar'
import Footer from './components/Footer'
console.log(Drawer);

export default {
  name: 'App',
  components: {
    Drawer,
    ToolBar,
    Footer,
  },
  data () {
    return {
      //
    }
  }
}
</script>
<style>
.parallax {
  height: 100% !important
}
</style>


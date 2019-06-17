<template>
  <div id="app">
    <v-app id="inspire">
        
      <v-parallax class="parallax" src="/src/assets/1511.jpg">
                <Drawer/>
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
import Footer from './components/Footer'

export default {
  name: 'App',
  components: {
    Drawer,
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
.parallax {
  height: 100% !important
}
</style>


<template>
  <div id="app">
    <v-app id="inspire">
      <v-parallax class="parallax" src="/src/assets/1511.jpg">
          <ToolBar/>
        <v-content>
        <router-view></router-view>
        </v-content>
      </v-parallax>
      <Footer/>
    </v-app>
  </div>
</template>

<script>
//import HelloWorld from './components/HelloWorld'
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
.parallax {
  height: 100% !important
}
</style>


<template>
  <div id="app">
    <v-app id="inspire">
      <v-parallax src="/src/assets/back.jpg">
      <v-content>
        <ToolBar/>
      </v-content>
        <router-view></router-view>
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

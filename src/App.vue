<template>
  <div id="app">
    <v-app light id="inspire">
<<<<<<< HEAD
              <ToolBar/>
      <v-parallax class="parallax" src="/src/assets/6530.jpg">
        <v-content>
        <v-container>
=======
>>>>>>> 7a7ee029eb33410fb47c7e971fd0241d026505c4
        <notifications group="app" />
        <ToolBar/>
        <v-parallax class="parallax" src="/src/assets/1511.jpg">
        <v-content>
            <router-view></router-view>
        </v-content>
      </v-parallax>
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
.parallax {
  height: 100% !important
}
</style>


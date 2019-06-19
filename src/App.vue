<template>
  <div id="app">
    <v-app light id="inspire">
        <notifications group="app" />
        <ToolBar/>
        <v-parallax class="parallax" src="/src/assets/1511.jpg">
        <v-content>
          <v-container>
            <router-view></router-view>
          </v-container>
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


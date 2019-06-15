<template>
  <div id="app">
    <v-app id="inspire">
      <v-parallax src="https://cdn.vuetifyjs.com/images/parallax/material.jpg">
      <v-content>
        <ToolBar/>
      </v-content>
      <router-view/>
      </v-parallax>
    </v-app>
  </div>
</template>

<script>
//import HelloWorld from './components/HelloWorld'
import ToolBar from './components/ToolBar'

export default {
  name: 'App',
  components: {
    ToolBar
  },
  data () {
    return {
      //
    }
  }
}
</script>

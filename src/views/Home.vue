<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <HelloWorld msg="Welcome to Your Vue.js App"/>
    <button @click="GetListe()" type="button">click</button>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'

export default {
  name: 'home',
  components: {
    HelloWorld
  },
  methods: {
    	GetListe() {
      var scope = this;
      console.log(window.location.pathname);
      axios
      .post("/api/api.php?cas=toto")
      .then(res => console.log(res));
		},
  },
}
</script>

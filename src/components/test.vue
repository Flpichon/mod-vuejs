<template>
  <v-container>
      <v-btn @click="GetListe()">Hello</v-btn>
  </v-container>
</template>

<script>
  export default {
    methods: {
    	GetListe() {
      var scope = this;
      axios
      .post("/api/api.php?cas=toto")
      .then(res => console.log(res));
		},
  },
  }
</script>
    

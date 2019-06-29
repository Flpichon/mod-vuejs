<template>
  <v-container>
    <DisplayEleveNotes/>
    <DisplayEleves/>
  </v-container>
</template>
<script>
  import DisplayEleves from '../components/DisplayEleves'
  import DisplayEleveNotes from '../components/DisplayEleveNotes'
  export default {
    components : {
      DisplayEleves,
      DisplayEleveNotes
    }
  }
</script>
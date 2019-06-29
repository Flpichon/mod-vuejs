<template>
    <v-container>
    <div>yolo</div>
    <div>{{eleveDisplay.nom}}</div>
    </v-container>
</template>

<script>
export default {
    data: () => {
        return {
            eleve: {}
        }
    },
    computed: {
        eleveDisplay() {
            return this.$store.state.eleve;
            this.eleve = this.$store.state.eleve;
        }
    },
    mounted() {
        
    }
}
</script>
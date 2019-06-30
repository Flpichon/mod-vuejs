<template>
    <v-container>
        <v-card v-show="isEleve===true">
            <v-btn @click="hideEleve">x</v-btn>
            <v-card-title>
                <h3 class="headline mb-0">{{eleveDisplay.nom | Majuscules}} {{eleveDisplay.prenom | Majuscules}}</h3>
            </v-card-title>
            <v-card-actions>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
export default {
    data: () => {
        return {
            eleve: {},
            isEleve: false
        }
    },
    computed: {
        eleveDisplay() {
            if (typeof this.$store.state.eleve !== 'undefined') {
            this.eleve = this.$store.state.eleve;
            if (typeof this.eleve.nom !== "undefined") {
                this.isEleve = true;
            }
            return this.$store.state.eleve;
            } 
            return {nom: 'null', prenom: 'null'}
        }
    },
    mounted() {
    },
    methods: {
        hideEleve() {
            this.isEleve = false;
            this.$store.commit('setEleve', {
             });
        }
    }
}
</script>
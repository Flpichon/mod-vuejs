<template>
    <v-container>
        <v-card v-show="isEleve===true">
            <v-btn @click="hideEleve">x</v-btn>
            <v-card-title>
                <h3 class="headline mb-0">{{eleveDisplay.nom | Majuscules}} {{eleveDisplay.prenom | Majuscules}}</h3>
            </v-card-title>
            <v-toolbar>
                <v-toolbar-items :item="matiere" class="hidden-sm-and-down">
                <v-btn 
                    v-for="item in matiere"
                    :key="item.id"
                    flat
                    @click="GetNotes(item.id)"
                >{{item.intitule}}</v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <v-list>
                <v-list-tile
                v-for="item in notes"
                :key="item.id"
                >
                <v-list-tile-action>
                <v-icon v-if="item.id" color="pink">star</v-icon>
                </v-list-tile-action>
                 <v-list-tile-content>
                <v-list-tile-title>Note</v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-content>
                <v-list-tile-title v-text="item.valeur"></v-list-tile-title>
                </v-list-tile-content>
                </v-list-tile>
            </v-list>
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
            isEleve: false,
            matiere: [],
            notes: []
        }
    },
    computed: {
        eleveDisplay() {
            if (typeof this.$store.state.eleve !== 'undefined') {
                this.eleve = this.$store.state.eleve;
                if (typeof this.eleve.nom !== "undefined") {
                    this.isEleve = true;
                    axios
                    .post(`/api/api.php?cas=getmatiereeleve&ideleve=${this.$store.state.eleve.id}`)
                    .then(res => {
                        this.matiere = res.data;
                    });
                }
                return this.$store.state.eleve;
            } 
        return {nom: 'null', prenom: 'null'}
        },
        getEleveMatiere() {
            if (typeof this.$store.state.eleve !== 'undefined') {
               return axios
                .post(`/api/api.php?cas=getmatiereeleve&ideleve=${this.$store.state.eleve.id}`)
                .then(res => {
                    this.matiere = res.data;
                    console.log(res.data);
                    console.log(this.matiere);
                    return res.data
                });
            }
        }
    },
    mounted() {
    },
    methods: {
        GetNotes(matiereId) {
        axios
            .post(`/api/api.php?cas=getnotesmatiereeleve&ideleve=${this.eleve.id}&idmatiere=${matiereId}`)
            .then(res => {
                this.notes = res.data;
                console.log(this.notes)
            });
        },
        hideEleve() {
            this.isEleve = false;
            this.$store.commit('setEleve', {
             });
        }
    }
}
</script>
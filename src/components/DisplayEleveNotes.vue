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
                <v-data-table
                :headers="headers"
                :items="notes"
                class="elevation-1"
                >
                    <template v-slot:items="props">
                        <td>{{ props.item.valeur }}</td>
                        <td>{{ props.item.coefficient }}</td>
                        <td>{{ props.item.description }}</td>
                    </template>
                </v-data-table>
            <v-card-actions>
                <v-btn></v-btn>
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
            headers: [
                {
                    text: 'Note',
                    align: 'left',
                    value: 'valeur'
                },
                { text: 'Coefficient', align: 'left', value: 'coefficient' },
                { text: 'Description', align: 'left', value: 'description' }
            ],
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
                        this.matiere.map(mat => this.GetNotes(mat.id));
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
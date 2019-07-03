<template>
    <v-container>
        <v-card v-show="isEleve===true">
            <v-btn @click="hideEleve">x</v-btn>
            <v-card-title>
                <h3 class="headline mb-0">{{eleveDisplay.nom | Majuscules}} {{eleveDisplay.prenom | Majuscules}}</h3>
            </v-card-title>
            <v-dialog v-model="dialog" max-width="500px" persistent>
          <template v-slot:activator="{ on }">
            <v-btn round class="purple-color mb-2" v-on="on">Ajouter une note</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">Nouvelle note</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedNote.valeur" label="valeur"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedNote.coefficient" label="coefficient"></v-text-field>
                  </v-flex>
                    <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedNote.description" label="description"></v-text-field>
                  </v-flex>
                  <!-- <v-flex xs12 sm6 md4>
                    <v-menu
                    v-model="menu1"
                    :close-on-content-click="false"
                    full-width
                    max-width="290"
                    >
                <template v-slot:activator="{ on }">
                <v-text-field
                  :value="computedDateFormattedMomentjs"
                  clearable
                  label="date de naissance"
                  v-on="on"
                ></v-text-field>
              </template>
                <v-date-picker
                locale='fr'
                v-model="editedNote.date_naissance"
                @change="menu1 = false"
                ></v-date-picker>
              </v-menu>
                  </v-flex> -->
                  <v-flex xs12 sm6 md4>
                    <v-select  :items="tabs" item-text="intitule" item-value="id" v-model="editedNote.matiere" label="matière"></v-select>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click="Close">Annuler</v-btn>
              <v-btn v-if="editedNote.onEdit !== true" color="blue darken-1" flat @click="Add(editedNote)">Enregistrer</v-btn>
               <v-btn v-else color="blue darken-1" flat @click="Modif(editedNote)">Modifer</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
            <v-tabs
            v-model="activeTab"
            light
            show-arrows
            >
                <v-tabs-slider color="blue"></v-tabs-slider>
            <v-tab
            v-for="item in matiere"
            :key="item.numero"
            flat
             @click="GetNotes(item.id)"
            >
            {{item.intitule}}
            </v-tab>
            </v-tabs>
                <v-data-table
                :headers="headers"
                :items="notes"
                class="elevation-1"
                >
                    <template v-slot:items="props">
                        <td>{{ props.item.valeur }}</td>
                        <td>{{ props.item.coefficient }}</td>
                        <td>{{ props.item.description }}</td>
                        <td>{{ props.item.intitule }}</td>
                    </template>
                </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
export default {
    data: () => {
        return {
            eleve: {},
            menu1: false,
            dialog : false,
            isEleve: false,
            activeTab:0,
            headers: [
                {
                    text: 'Note',
                    align: 'left',
                    value: 'valeur'
                },
                { text: 'Coefficient', align: 'left', value: 'coefficient' },
                { text: 'Description', align: 'left', value: 'description' },
                { text: 'Matière', align: 'left', value: 'matière' }
            ],
            matiere: [],
            tabs: [],
            notes: [],
            editedNote: {
                'valeur' : 0,
                'coefficient': 0,
                'description': ''
            }
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

                        this.GetNotes(-1);
                        this.tabs = res.data;
                        let numero = 0;
                        this.tabs.map(tab =>  {
                            tab.num = numero;
                            numero++;
                        })
                        this.tabs.unshift({
                            id :0,
                            intitule: 'Toutes',
                        })
                        this.activeTab = 0;
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
                    return res.data
                });
            }
        }
    },
    mounted() {
    },
    methods: {
        Add(note) {
            note.id_eleve = this.eleve.id;
            axios
                .post(`/api/api.php?cas=addNote`, note)
                .then(res => { 
                this.Close();
                this.GetNotes(note.matiere);
                console.log(this.note);
                })
        },
        Close () {
        this.dialog = false;
        setTimeout(() => {
          this.editedNote.valeur = 0;
          this.editedNote.coefficient = 0;
          //this.editedNote.date_naissance = new Date().toISOString().substr(0, 10);
          this.editedNote.matiere = 0;
          this.editedNote.description = '';
          this.editedNote.onEdit = false;
          this.editedMatiere = -1;
        }, 300)
        },
        GetNotes(matiereId) {
            if (matiereId !== -1) {
            axios
            .post(`/api/api.php?cas=getnotesmatiereeleve&ideleve=${this.eleve.id}&idmatiere=${matiereId}`)
            .then(res => {
                this.notes = res.data;
            });
            } else {
                axios
            .post(`/api/api.php?cas=getallnotesmatiereeleve&ideleve=${this.eleve.id}`)
            .then(res => {
                this.notes = res.data;
            });
            }
        },
        hideEleve() {
            this.isEleve = false;
            this.$store.commit('setEleve', {
             });
             this.notes = [];
        }
    }
}
</script>
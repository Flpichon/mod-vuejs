<template>
    <v-container>
        <v-card v-show="isEleve===true">
            <v-btn @click="hideEleve">x</v-btn>
            <v-card-title>
                <h3 class="headline mb-0">{{eleveDisplay.nom | Majuscules}} {{eleveDisplay.prenom | Majuscules}}</h3>
                <v-spacer></v-spacer>
                  <div big> Moyenne : {{getMoyenne}}</div>
            </v-card-title>
            <v-dialog v-model="dialog" max-width="500px" persistent>
          <template v-slot:activator="{ on }">
            <v-btn round class="purple-color mb-2" v-on="on">Ajouter une note</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span v-if="!editedNote.onEdit" class="headline">Nouvelle note</span>
              <span v-else class="headline">Modifier Note</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field type="number" v-model="editedNote.valeur" label="valeur"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field type="number" v-model="editedNote.coefficient" label="coefficient"></v-text-field>
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
                  <v-flex xs12 sm6 md4 v-if="!editedNote.onEdit">
                    <v-select :items="matieres" item-text="intitule" item-value="id" v-model="editedNote.matiere" label="matière"></v-select>
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
            v-for="item in tabs"
            :key="item.numero"
            flat
             @click="GetNotes(item.id)"
            >
            {{item.intitule}}
            </v-tab>
            </v-tabs>
              <template>
            <v-text-field
              v-model="search"
              append-icon="search"
              label="Recherche"
              single-line
              hide-details
              class="w150 ml-2"
            ></v-text-field>
            </template>
                <v-data-table
                :headers="headers"
                :items="notes"
                :search="search"
                :rows-per-page-items="rowsPerPageItems"
                :rows-per-page-text="rowPageText"
                class="elevation-1"
                >
                    <template v-slot:items="props">
                        <td>{{ props.item.valeur }}</td>
                        <td>{{ props.item.coefficient }}</td>
                        <td>{{ props.item.description }}</td>
                        <td>{{ props.item.intitule }}</td>
                        <td class="justify-center">
                          <v-icon color="primary"
                          @click="modifForm(props.item)"
                          small
                          class="mr-2"
                          >
                          edit
                          </v-icon>
                          <v-icon color="red"
                          @click="Delete(props.item)"
                          small
                          >
                          delete
                          </v-icon>
                        </td>
                    </template>
                    <template v-slot:no-data>
                      <v-alert :value="true" color="warning" icon="warning">
                        Aucune note saisie dans cette catégorie.
                      </v-alert>
                    </template>
                            <template v-slot:no-results>
        <v-alert :value="true" color="warning" icon="warning">
          Aucun résultat trouvé :(
        </v-alert>
      </template>
                </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
export default {
    data: () => {
        return {
            search:'',
            moyenne:0,
            eleve: {},
            menu1: false,
            dialog : false,
            isEleve: false,
            activeTab:0,
             rowPageText: 'éléments par page:',
          rowsPerPageItems: [8, 24, 32,  { text: "$vuetify.dataIterator.rowsPerPageAll", value: -1 }],
            headers: [
                {
                    text: 'Note',
                    align: 'left',
                    value: 'valeur'
                },
                { text: 'Coefficient', align: 'left', value: 'coefficient' },
                { text: 'Description', align: 'left', value: 'description' },
                { text: 'Matière', align: 'left', value: 'intitule' },
                { text: 'Actions', value: 'name', sortable: false },
            ],
            matieres: [],
            tabs: [],
            notes: [],
            editedNote: {
                'valeur' : 0,
                'coefficient': 0,
                'description': '',
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
                        this.matieres = res.data;
                        this.GetNotes(999);
                        this.tabs = [...this.matieres];
                        let numero = 0;
                        this.tabs.map(tab =>  {
                            tab.num = numero;
                            numero++;
                        })
                        this.tabs.unshift({
                            id :999,
                            intitule: 'Toutes',
                        })
                        this.activeTab = 0;
                        this.editedNote.matiere = this.matieres[0].id;
                    });
                }
                return this.$store.state.eleve;
            } 
        return {nom: 'null', prenom: 'null'}
        },
        getMoyenne() {
          return this.CalculMoyenne();  
        },
        getEleveMatiere() {
            if (typeof this.$store.state.eleve !== 'undefined') {
               return axios
                .post(`/api/api.php?cas=getmatiereeleve&ideleve=${this.$store.state.eleve.id}`)
                .then(res => {
                    this.matieres = res.data;
                    return res.data
                });
            }
        }
    },
    mounted() {  
    },
    methods: {
      CalculMoyenne() {
        let moyenne = 0;
        let coefficient = 0;
        if (this.notes.length) {
        this.notes.map(note => {
          moyenne += (note.valeur * note.coefficient);
          coefficient += parseInt(note.coefficient);
          });
        moyenne = moyenne / coefficient;
        return moyenne.toFixed(2);
        } 
        return 'pas de notes';
      },
        Add(note) {
            note.id_eleve = this.eleve.id;
            axios
                .post(`/api/api.php?cas=addNote`, note)
                .then(res => { 
                this.Close();
                this.GetNotes(999);
                })
        },
        Close () {
        this.dialog = false;
        setTimeout(() => {
          this.editedNote.valeur = 0;
          this.editedNote.coefficient = 0;
          //this.editedNote.date_naissance = new Date().toISOString().substr(0, 10);
          this.editedNote.matiere =  this.matieres[0].id;
          this.editedNote.description = '';
          this.editedNote.onEdit = false;
          this.editedMatiere = -1;
        }, 300)
        },
        GetNotes(matiereId) {
            if (matiereId !== 999) {
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
        getMatiereByIntitule(intitule) {
          let matiereClone = [...this.matieres];
          return matiereClone.find(matiere => matiere.intitule === intitule);
        },
        hideEleve() {
            this.isEleve = false;
            this.$store.commit('setEleve', {
             });
             this.notes = [];
        },
        modifForm(note) {
          this.editedNote = Object.assign({}, note);
          this.dialog = true;
          this.editedNote.onEdit = true;
        },
        Modif(note) {
          let matiere = this.getMatiereByIntitule(note.intitule);
            axios
            .post(`/api/api.php?cas=editnote`, note)
            .then(res => {
              this.Close();
              this.GetNotes(999);
            })
        },
        Delete(note) {
       this.$dialog.confirm({
          text: 'Voulez vous vraiment supprimer cette note ?',
          title: 'Attention',
      })
      .then(conf => {
        if (conf) {
          let matiere = this.getMatiereByIntitule(note.intitule);
          axios
          .post(`/api/api.php?cas=deletenote`,note)
            .then(res => {
              this.GetNotes(999);
              this.$notify({
                  group: 'app',
                  type: 'success',
                  width : 800,
                  title: 'Suppression Effectuée',
                  text: "La note a été supprimée"
                });
            })
        }
      })
        }
    }
}
</script>
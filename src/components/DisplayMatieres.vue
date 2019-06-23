<template>
      <v-container fluid grid-list-md>
       <v-btn @click="AddRow()">Ajouter une matière</v-btn>
      <v-data-iterator
        :items="items"
        :rows-per-page-items="rowsPerPageItems"
        :rows-per-page-text="rowPageText"
        :pagination.sync="pagination"
        content-tag="v-layout"
        row
        wrap
      >
        <template v-slot:item="props">
          <v-flex
            xs12
            sm6
            md4
            lg3
          >
            <v-card :dark=props.item.isNew>
                <v-card-title ><h4>{{ props.item.intitule | Majuscules }}</h4>
                <v-spacer></v-spacer>
                <v-flex xs12 sm12>
                  <v-btn  small v-if="props.item.isNew !== true" @click="ModifMatiere(props.item)" fab dark  color="cyan">
                    <v-icon dark>edit</v-icon>
                  </v-btn>
                  <v-btn  small v-else @click="AddMatiere(props.item)" fab dark  color="green">
                    <v-icon dark>add</v-icon>
                  </v-btn>
                  <v-btn small @click="GetMatieres()" v-if="props.item.isNew !== true" fab dark color="cyan">
                    <v-icon >autorenew</v-icon>
                  </v-btn>
                  <v-btn small @click="DeleteMatiere(props.item)" v-if="props.item.isNew !== true"  fab dark color="red">
                    <v-icon >delete</v-icon>
                  </v-btn>
                </v-flex>
              </v-card-title>
              <v-divider></v-divider>
              <v-list dense>
                <v-list-tile>
                  <v-list-tile-content>Identifiant:</v-list-tile-content>
                  <v-list-tile-content class="align-end">{{ props.item.id }}</v-list-tile-content>
                </v-list-tile>
                <v-list-tile>
                  <v-list-tile-content>Libellé:</v-list-tile-content>
                  <v-list-tile-content class="align-end"><input v-model="props.item.intitule"></v-list-tile-content>
                </v-list-tile>
              </v-list>
            </v-card>
          </v-flex>
        </template>
      </v-data-iterator>
    </v-container>
</template>
<script>
export default {
     data: () => {
         return {
        rowPageText: 'éléments par page:',
        rowsPerPageItems: [8, 24, 32,  { text: "$vuetify.dataIterator.rowsPerPageAll", value: -1 }],
        pagination: {
        rowsPerPage: 8
        },
        items:[],
        }
     },
       mounted(){
        this.GetMatieres();
    },
    methods:{
        AddRow() {
          let data = {};
          data.intitule = 'à définir';
          data.isNew = true;
          this.items.unshift(data);
        },
        GetMatieres() {
            axios
            .post("/api/api.php?cas=getMatiere")
            .then(res => {
                this.items = (res.data);
            });
        },
        AddMatiere(matiere) {
            let data = {};
            data["intitule"] = matiere.intitule;
             axios
            .post(`/api/api.php?cas=addmatiere`, data)
                .then(res => {
                let type = res.data === -1 ? 'error' : 'success';
                let title = res.data === -1 ? 'Echec' : 'Succès';
                let text = res.data === -1 ? "Echec de l'ajout" : "Classe ajoutée"; 
                    this.GetMatieres(); 
                    this.$notify({
                    group: 'app',
                    type,
                    width : 800,
                    title,
                    text
                    });
                })
        },

        DeleteMatiere(matiere) {
            let matiereId = matiere.id;
            this.$dialog.confirm({
                text: 'Voulez vous vraiment supprimer cette matière ?',
                title: 'Attention',
            })
            .then(conf => {
                if (conf) {
                axios
                .post(`/api/api.php?cas=deletematiere&idmatiere=${matiereId}`)
                    .then(res => {
                    this.GetMatieres();
                    this.$notify({
                        group: 'app',
                        type: 'success',
                        width : 800,
                        title: 'Suppression Effectuée',
                        text: "La matière : "+res.data+" a été supprimée"
                        });
                    })
                }
            })
        },
        ModifMatiere(matiere) {
            let matiereId = matiere.id
            let data = {};
            data["intitule"] = matiere.intitule;
            axios
            .post(`/api/api.php?cas=editmatiere&idmatiere=${matiereId}`, data)
            .then(res => {
                this.GetMatieres();
                this.$notify({
                  group: 'app',
                  type: 'success',
                  width : 800,
                  title: 'Modifcations effectuées',
                  text: 'Les informations de la matière : '+res.data+' ont été modifiées'
                });
            });
        }
    },
}
</script>

 
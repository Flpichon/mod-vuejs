<template>
     <v-container fluid grid-list-md>
       <v-btn @click="AddRow()">Ajouter une classe</v-btn>
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
                <v-card-title ><h4>{{ props.item.libelle | Majuscules }} {{ props.item.numero }}</h4>
                <v-spacer></v-spacer>
                <v-flex xs12 sm12>
                  <v-btn  small v-if="props.item.isNew !== true" @click="ModifClasse(props.item)" fab dark  color="cyan">
                    <v-icon dark>edit</v-icon>
                  </v-btn>
                  <v-btn  small v-else @click="AddClasse(props.item)" fab dark  color="green">
                    <v-icon dark>add</v-icon>
                  </v-btn>
                  <v-btn small @click="GetClasses()" v-if="props.item.isNew !== true" fab dark color="cyan">
                    <v-icon >autorenew</v-icon>
                  </v-btn>
                  <v-btn small @click="DeleteClasse(props.item)" v-if="props.item.isNew !== true"  fab dark color="red">
                    <v-icon >delete</v-icon>
                  </v-btn>
                </v-flex>
              </v-card-title>
              <v-divider></v-divider>
              <v-list dense>
                <v-list-tile>
                  <v-list-tile-content>Numéro:</v-list-tile-content>
                  <v-list-tile-content class="align-end"><input type="number" :min=0 v-model="props.item.numero"></v-list-tile-content>
                </v-list-tile>
                <v-list-tile>
                  <v-list-tile-content>Libellé:</v-list-tile-content>
                  <v-list-tile-content class="align-end"><input v-model="props.item.libelle"></v-list-tile-content>
                </v-list-tile>
                <v-list-tile>
                  <v-list-tile-content>Nombre d'élèves:</v-list-tile-content>
                  <v-list-tile-content class="align-end">{{ props.item.nb_eleve }}</v-list-tile-content>
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
        this.GetClasses();
    },
    methods:{
        Close () {
        this.dialogo = false;
        setTimeout(() => {
          this.editedClasse.numero = 0;
          this.editedClasse.libelle = "";
          this.editedClasse = -1
        }, 300)
        },
        AddRow() {
          let data = {};
          data.libelle = 'à définir';
          data.numero = 0;
          data.nb_eleve = 0;
          data.isNew = true;
          this.items.unshift(data);
        },
        AddClasse(item) {
          let scope = this;
          let data = {};
          data["libelle"] = item.libelle;
          data["numero"] = item.numero;
          axios
          .post(`/api/api.php?cas=addclasse`, data)
            .then(res => {
              let type = res.data === -1 ? 'error' : 'success';
              let title = res.data === -1 ? 'Echec' : 'Succès';
              let text = res.data === -1 ? "Echec de l'ajout" : "Classe ajoutée"; 
                scope.GetClasses(); 
                this.$notify({
                  group: 'app',
                  type,
                  width : 800,
                  title,
                  text
                });
            })
        },
        GetClasses() {
			      var scope = this;
            axios
            .post("/api/api.php?cas=getclasse")
            .then(res => {
                scope.items = (res.data);
            });
        },
        ModifClasse(item) {
            let scope = this;
            let itemId = item.id
            let data = {};
            data["libelle"] = item.libelle;
            data["numero"] = item.numero;
            axios
            .post(`/api/api.php?cas=editclasse&idclasse=${itemId}`, data)
            .then(res => {
                scope.GetClasses();
                this.$notify({
                  group: 'app',
                  type: 'success',
                  width : 800,
                  title: 'Modifcations effectuées',
                  text: 'Les informations de la classe : '+res.data+' ont été modifiées'
                });
            });

        },
        DeleteClasse(item) {
        let scope = this;
        let itemId = item.id;
        this.$dialog.confirm({
          text: 'Voulez vous vraiment supprimer cette classe ?',
          title: 'Attention',
        })
        .then(conf => {
          if (conf === true) {
            axios
            .post(`/api/api.php?cas=deleteclasse&idclasse=${itemId}`)
            .then(res => {
                if (res.data !== 0) {
                scope.GetClasses();
                this.$notify({
                  group: 'app',
                  type: 'success',
                  width : 800,
                  title: 'Suppression Effectuée',
                  text: 'La classe : '+res.data+' a été supprimée'
                });
                } else {
                  this.$notify({
                  group: 'app',
                  type: 'error',
                  width : 800,
                  title: 'Echec de le suppression',
                  text: 'La classe ne peut pas être supprimée : il reste encore des élèves attachés'
                });
                }
            })
          }
        })
    }
    }
  }
</script>

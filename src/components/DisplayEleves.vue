<template>
    <div>
      <v-toolbar flat color="white">
        <v-toolbar-title :color="$store.getters['themeColor']" class="lighten-2">Gestion des élèves</v-toolbar-title>
        <v-divider
          class="mx-2"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
              <v-text-field
              v-model="search"
              append-icon="search"
              label="Recherche"
              single-line
              hide-details
            ></v-text-field>
        <v-dialog v-model="dialog" max-width="500px" persistent>
          <template v-slot:activator="{ on }">
            <v-btn round :color="$store.getters['themeColor']" class="white--text mb-2" v-on="on">Ajouter un élève</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{editedEleve.nom }} {{editedEleve.prenom}}</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedEleve.nom" label="nom"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedEleve.prenom" label="prenom"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
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
                v-model="editedEleve.date_naissance"
                @change="menu1 = false"
                ></v-date-picker>
              </v-menu>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-select  :items="classes" item-text="complet" item-value="id" v-model="editedEleve.classe" label="classe"></v-select>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click="Close">Annuler</v-btn>
              <v-btn v-if="editedEleve.onEdit !== true" color="blue darken-1" flat @click="Add(editedEleve)">Enregistrer</v-btn>
               <v-btn v-else color="blue darken-1" flat @click="Modif(editedEleve)">Modifer</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
      <v-data-table
        :headers="headers"
        :items="items"
        :search="search"
        :rows-per-page-items="rowsPerPageItems"
        :rows-per-page-text="rowPageText"
        class="elevation-1 m-2"
      >
        <template v-slot:items="props">
          <td class="text-xs purple--text lighten-2">{{ props.item.id }}</td>
          <td class="text-xs">{{ props.item.nom }}</td>
          <td class="text-xs">{{ props.item.prenom }}</td>
          <td class="text-xs">{{ props.item.date_naissance }}</td>
          <td class="text-xs">{{ props.item.classeLibelle }}</td>
          <td class="text-xs">{{ props.item.classeNumero }}</td>
          <td class="justify-center layout px-0 m-2">
            <v-icon color="primary"
              @click="Send(props.item)"
              small
              class="mr-2"
            >
              visibility
            </v-icon>
          <td class="justify-center">
            <v-icon color="primary"
              @click="Modifier(props.item)"
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
          Aucun élève renseigné
        </v-alert>
      </template>
        <template v-slot:no-results>
        <v-alert :value="true" color="warning" icon="warning">
          Aucun résultat trouvé :(
        </v-alert>
      </template>
      </v-data-table>
      
</div>
</template>
<script>
import moment, { localeData } from 'moment'
moment.locale('fr');
export default {
  data: () => {
        return {
          search: '',
          rowPageText: 'éléments par page:',
          rowsPerPageItems: [8, 24, 32,  { text: "$vuetify.dataIterator.rowsPerPageAll", value: -1 }],
          menu1: false,
          dialog: false,
          classes: [],
          headers: [
            {
              text: 'Eleve',
              align: 'left',
              value: 'id'
            },
            { text: 'nom', value: 'nom' },
            { text: 'prenom', value: 'prenom' },
            { text: 'date de naissance', value: 'date_naissance' },
            { text: 'classe', value: 'classeLibelle' },
            { text: 'numero', value: 'classeNumero'},
            { text: 'Notes', value: 'eleve', sortable: false },
            { text: 'Actions', value: 'name', sortable: false },
          ],
          items: [],
          editedEleve: {
            "nom": "Nouvel",
            "prenom": "Eleve",
            "date_naissance": new Date().toISOString().substr(0, 10),
          },
        }
  },
  computed: {
    computedDateFormattedMomentjs () {
      return this.editedEleve.date_naissance ? moment(this.editedEleve.date_naissance).format('L') : ''
    },
  },
  mounted() {
    this.GetEleves();
    this.GetClasses();
  },
  methods: {
    Send(eleve) {
      this.$store.commit('setEleve', {
        eleve
      });
    },
    Add(data) {
       axios
          .post(`/api/api.php?cas=addeleve`, data)
            .then(res => { 
              this.Close();
              let type = res.data === -1 ? 'error' : 'success';
              let title = res.data === -1 ? 'Echec' : 'Succès';
              let text = res.data === -1 ? "Echec de l'ajout" : "élève ajoutée"; 
                    this.GetEleves();
                    this.$notify({
                    group: 'app',
                    type,
                    width : 800,
                    title,
                    text
                    });
             })
    },
    Modif(eleve) {
       axios
            .post(`/api/api.php?cas=editeleve&id=${eleve.id}`, eleve)
            .then(res => {
              this.Close();
              this.GetEleves();
              this.$notify({
                group: 'app',
                type: 'success',
                width : 800,
                title: 'Modifcations effectuées',
                text: "Les informations de l'èleve ont été modifiées"
              });
            })
    },
    GetClasses() {
    let scope = this;
    axios
    .post("/api/api.php?cas=getclasse")
    .then(res => {
      res.data.map(data => data.complet = data.libelle+' '+data.numero);
      scope.classes = (res.data);
      this.editedEleve.classe= scope.classes[0].id;
    });
    },
     Close () {
       let scope = this;
        this.dialog = false;
        setTimeout(() => {
          this.editedEleve.nom = "Nouvel";
          this.editedEleve.prenom = "Eleve";
          this.editedEleve.date_naissance = new Date().toISOString().substr(0, 10);
          this.editedEleve.classe = this.classes[0].id;
          this.editedEleve.onEdit = false;
          this.editedClasse = -1
        }, 300)
        },
    Modifier(item) {
      let dateok = moment(item.date_naissance, "DD-MM-YYYY").toDate();
      this.editedEleve.nom = item.nom;
      this.editedEleve.prenom = item.prenom;
      this.editedEleve.date_naissance = dateok.toISOString().substr(0, 10);
      this.editedEleve.classe = item.classeId;
       this.editedEleve.id = item.id;
      this.dialog = true;
      this.editedEleve.onEdit = true;
    },
    GetEleves() {
        let scope = this;
        axios
        .post("/api/api.php?cas=geteleve")
        .then(res => {
            res.data.map(eleve => eleve.date_naissance = moment(eleve.date_naissance).format('L'));
            scope.items = (res.data);
        });
  },
  Delete(eleve) {
      let eleveId = eleve.id;
       this.$dialog.confirm({
          text: 'Voulez vous vraiment supprimer cet élève ?',
          title: 'Attention',
      })
      .then(conf => {
        if (conf) {
          axios
          .post(`/api/api.php?cas=deleteeleve&ideleve=${eleveId}`)
            .then(res => {
              this.GetEleves();
              this.$notify({
                  group: 'app',
                  type: 'success',
                  width : 800,
                  title: 'Suppression Effectuée',
                  text: "L'élève : "+res.data+" a été supprimé"
                });
            })
        }
      })
  }
}
}
</script>

 
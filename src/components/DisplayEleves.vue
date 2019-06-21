<template>
    <div>
      <v-toolbar flat color="white">
        <v-toolbar-title>Gestion des élèves</v-toolbar-title>
        <v-divider
          class="mx-2"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">Nouvel élève</v-btn>
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
              <v-btn color="blue darken-1" flat @click="Add(editedEleve)">Enregistrer</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
      <v-data-table
        :headers="headers"
        :items="items"
        class="elevation-1"
      >
        <template v-slot:items="props">
          <td class="text-xs">{{ props.item.id }}</td>
          <td class="text-xs">{{ props.item.nom }}</td>
          <td class="text-xs">{{ props.item.prenom }}</td>
          <td class="text-xs">{{ props.item.date_naissance }}</td>
          <td class="text-xs">{{ props.item.classeLibelle }}</td>
          <td class="text-xs">{{ props.item.classeNumero }}</td>
          <td class="justify-center layout px-0">
            <v-icon
              small
              class="mr-2"
            >
              edit
            </v-icon>
            <v-icon
              small
            >
              delete
            </v-icon>
          </td>
        </template>
        <template v-slot:no-data>
          <v-btn color="primary">Reset</v-btn>
        </template>
      </v-data-table>
</div>
</template>
<script>
import moment from 'moment'
moment.locale('fr');
export default {
  data: () => {
        return {
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
            { text: 'Actions', value: 'name', sortable: false }
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
    Add(data) {
       axios
          .post(`/api/api.php?cas=addeleve`, data)
            .then(res => { 
              this.Close();
              this.GetEleves();
             })
    },
    GetClasses() {
    let scope = this;
    axios
    .post("/api/api.php?cas=getclasse")
    .then(res => {
      res.data.map(data => data.complet = data.libelle+' '+data.numero);
      scope.classes = (res.data);
    });
    },
     Close () {
        this.dialog = false;
        setTimeout(() => {
          this.editedEleve.nom = "Nouvel";
          this.editedEleve.prenom = "Eleve";
          this.editedEleve.date_naissance = new Date().toISOString().substr(0, 10);
          this.editedEleve.classe = 0;
          this.editedClasse = -1
        }, 300)
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
}
}
</script>
<template>
    <div id="app">
  <v-app id="inspire">
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
              <span class="headline">toto</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedEleve.nom" label="nom"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedEleve.nom" label="prenom"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedEleve.nom" label="date de naissance"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedEleve.nom" label="classe"></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
  
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click="Close">Cancel</v-btn>
              <v-btn color="blue darken-1" flat @click="Close">Save</v-btn>
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
  </v-app>
</div>
</template>
<script>
import moment from 'moment'
moment.locale('fr');
export default {
  data: () => {
        return {
          dialog: false,
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
          classes: [],
          items: [],
          editedEleve: {
            "nom": "",
            "prenom": "",
            "date_naissance": "",
          },
        }
  },
  mounted() {
    this.GetEleves();
  },
  methods: {
     Close () {
        this.dialog = false;
        setTimeout(() => {
          this.editedClasse.numero = 0;
          this.editedClasse.libelle = "";
          this.editedClasse = -1
        }, 300)
        },
    GetEleves() {
        let scope = this;
        axios
        .post("/api/api.php?cas=geteleve")
        .then(res => {
            res.data.map(eleve => eleve.date_naissance = moment(eleve.date_naissance).format('L'));
            console.log(res.data);
            scope.items = (res.data);
        });
  },
}
}
</script>
<template>
    <div id="app">
  <v-app id="inspire">
    <div>
      <v-toolbar flat color="white">
        <v-toolbar-title>My CRUD</v-toolbar-title>
        <v-divider
          class="mx-2"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.name" label="nom"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.calories" label="prenom"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.fat" label="date de naissance"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.carbs" label="classe"></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
  
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
      <v-data-table
        :headers="headers"
        :items="desserts"
        class="elevation-1"
      >
        <template v-slot:items="props">
          <td>{{ props.item.name }}</td>
          <td class="text-xs-right">{{ props.item.id }}</td>
          <td class="text-xs-right">{{ props.item.nom }}</td>
          <td class="text-xs-right">{{ props.item.prenom }}</td>
          <td class="text-xs-right">{{ props.item.dateNaissance }}</td>
          <td class="text-xs-right">{{ props.item.classe.libelle }}</td>
          <td class="text-xs-right">{{ props.item.classe.numero }}</td>
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
export default {
  data: () => {
        return {
          dialog: false,
          classes: [],
          items: [],
        }
  },
  methods: {
    GetEleves() {
        let scope = this;
        axios
        .post("/api/api.php?cas=geteleve")
        .then(res => {
            console.log(res.data);
            scope.items = (res.data);
        });
  },
}
</script>


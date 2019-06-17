<template>
     <v-container fluid grid-list-md>
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
            <v-card>
              <v-card-title><h4>{{ props.item.id }}</h4>
                <v-btn @click="ModifClass(props.item)" fab small dark color="cyan">
                <v-icon dark>edit</v-icon>
              </v-btn>
               <v-btn @click="GetClasses()" fab small dark color="cyan">
                <v-icon >autorenew</v-icon>
              </v-btn>
              </v-card-title>
              <v-divider></v-divider>
              <v-list dense>
                <v-list-tile>
                  <v-list-tile-content>Numéro:</v-list-tile-content>
                  <v-list-tile-content class="align-end"><input v-model="props.item.numero"></v-list-tile-content>
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
        rowsPerPageItems: [4, 8, 12,  { text: "$vuetify.dataIterator.rowsPerPageAll", value: -1 }],
        pagination: {
        rowsPerPage: 4
        },
        items:[]
        }
    },
    mounted(){
        this.GetClasses();
    },
    methods:{
        GetClasses() {
			var scope = this;
            axios
            .post("/api/api.php?cas=getclasse")
            .then(res => {
                scope.items = (res.data);
            });
        },
        ModifClass(item) {
            let itemId = item.id

            axios
            .post(`/api/api.php?cas=editclasse&idclasse=${itemId}`, {itemId})
            .then(res => {
                console.log(res.data);
            });
        }
    }
  }
</script>

import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    eleve: {},
    theme: {ok : 'ok'},
    theme1 : [
      {nom:"orange" , color: "colororange", btnmenu:"btnazur",src:"v-navigation-orange"},
      {nom:"violet" , color: "colorviolet", btnmenu: "btn-violet",src:"v-navigation-violet"},
    ],
  },
  mutations: {
    setEleve(state, payload) {
      state.eleve = payload.eleve;
    },
    setTheme(state, payload) {
      state.theme = payload.theme
    }
  },
  actions: {

  }
})

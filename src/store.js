import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    eleve: {},
  },
  mutations: {
    setEleve(state, payload) {
      state.eleve = payload.eleve;
    }
  },
  actions: {

  }
})

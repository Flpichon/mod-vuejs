import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    eleve: {},
    theme: '',
    theme1 : [
      {nom:"orange" , color: "colororange", btnmenu:"btnazur",src:"v-navigation-orange"},
      {nom:"violet" , color: "colorviolet", btnmenu: "btn-violet",src:"v-navigation-violet"},
    ],
    themeColor: '#512DA8'
  },
  mutations: {
    setEleve(state, payload) {
      state.eleve = payload.eleve;
    },
    setTheme(state, payload) {
      state.theme = payload.theme
    },
    setThemeColor(state, color, img) {
      state.themeColor = color;
      state.theme = img;
    }

  },
  getters: {
    themeColor: state => state.themeColor
  },
  actions: {

  }
})

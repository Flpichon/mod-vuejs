import Vue from "vue"
Vue.filter("Majuscules", str => {
    if (typeof str !== 'undefined') {
        return str.toUpperCase()
    }
});
// vue.config.js
module.exports = {
    // vue.config.js
    devServer: {
        proxy: 'http://localhost/mod-vuejs/',
      },

    pluginOptions: {
      moment: {
        locales: [
          'fr'
        ]
      }
    }
}

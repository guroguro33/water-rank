module.exports = {
  pages: {
    index: {
      entry: './src/main.js',
      title: '全国水道料金ランキング',
    }
  },
  css: {
    loaderOptions: {
      scss: {
        prependData: '@import "./src/assets/sass/prepends.scss";'
      }
    }
  },
  publicPath: '/water-rank/'
};
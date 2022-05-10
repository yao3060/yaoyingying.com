const path = require('path')

module.exports = {
  devtool: 'source-map',
  entry: {
    bundle: path.resolve(__dirname, 'src-pwa/app.js'),
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'sw.js',
    clean: true,
  },
  plugins: [
  ]
}

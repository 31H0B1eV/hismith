
var ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
  entry: ['./views/assets/js/app.js', './views/assets/scss/app.scss'],
  output: {
    filename: './public/assets/js/app.js'
  },
  module: {

    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['env']
          }
        }
      },
      {
        test: /\.css$/,
        loader: ExtractTextPlugin.extract({
          loader: 'css-loader?importLoaders=1'
        })
      },
      {        test: /\.(sass|scss)$/,
        loader: ExtractTextPlugin.extract(['css-loader', 'sass-loader'])
      }
    ]
  },
  plugins: [
    new ExtractTextPlugin({
      filename: './public/assets/css/app.css',
      allChunks: true
    })
  ]
};
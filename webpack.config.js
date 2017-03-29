
var ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
  entry: ['./views/assets/js/app.js', './views/assets/scss/app.scss'],
  output: {
    filename: './public/assets/js/app.js'
  },
  module: {

    rules: [
      /*
       your other rules for JavaScript transpiling go in here
       */
      { // regular css files
        test: /\.css$/,
        loader: ExtractTextPlugin.extract({
          loader: 'css-loader?importLoaders=1'
        })
      },
      { // sass / scss loader for webpack
        test: /\.(sass|scss)$/,
        loader: ExtractTextPlugin.extract(['css-loader', 'sass-loader'])
      }
    ]
  },
  plugins: [
    new ExtractTextPlugin({ // define where to save the file
      filename: './public/assets/css/app.css',
      allChunks: true
    })
  ]
};
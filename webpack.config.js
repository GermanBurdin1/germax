const path = require('path');

module.exports = {
  entry: './public/js/main.js', 

  module: {
    rules: [
      {
        test: /\.css$/i,
        use: ['style-loader', 'css-loader'],
      },
    ],
  },

  output: {
    path: path.resolve(__dirname, 'dist'), 
    filename: 'bundle.js',
  },

  devtool: 'inline-source-map',

  devServer: {
    static: './dist', 
    open: true, 
    hot: true
  }
};

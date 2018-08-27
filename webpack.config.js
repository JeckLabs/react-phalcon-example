const path = require('path');

module.exports = {
  mode: 'development',
  watch: true,
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: ['babel-loader']
      }
    ]
  },
  resolve: {
    extensions: ['*', '.js', '.jsx']
  },
  entry: './app/frontend/index.js',
  output: {
    path: path.resolve(__dirname, 'public/dist'),
    filename: 'app.bundle.js'
  }
};

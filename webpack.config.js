const path = require('path');

module.exports = {
  entry: './src/index.js', // Your entry point
  output: {
    path: path.resolve(__dirname, 'dist'), // Output directory
    filename: 'bundle.js', // Output bundle
  },
  module: {
    rules: [
      {
        test: /\.css$/, // Target CSS files
        use: [
          'style-loader', // Injects CSS into the DOM
          'css-loader', // Interprets @import and url() like import/require()
          {
            loader: 'postcss-loader', // Process CSS with PostCSS
            options: {
              postcssOptions: {
                plugins: [
                  require('autoprefixer'), // Automatically add vendor prefixes
                  // Add other PostCSS plugins here as needed
                ],
              },
            },
          },
        ],
      },
      {
        test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/, // For font files
        type: 'asset/resource',
        generator: {
          filename: 'fonts/[name][ext]', // Output fonts to fonts/ directory
        },
      },
    ],
  },
};

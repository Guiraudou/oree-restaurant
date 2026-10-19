const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	mode: 'production',
	entry: './js/main.js',
	output: {
		path: path.resolve(__dirname, 'dist'),
		filename: 'app.js',
		clean: true,
	},
	module: {
		rules: [
			{test: /\.css$/, use: [MiniCssExtractPlugin.loader, 'css-loader']},
		],
	},
	plugins: [
		// CSS des librairies (Bootstrap), chargé avant css/style.css
		new MiniCssExtractPlugin({filename: 'vendor.css'}),
	],
};
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	mode: 'production',
	entry: {
		app: './js/main.js',
		admin: './js/admin.js',
	},
	output: {
		path: path.resolve(__dirname, 'dist'),
		filename: '[name].js',
		clean: true,
	},
	module: {
		rules: [
			// sideEffects: true keeps CSS imports (e.g. core-js style.css), which core-js does not declare as side-effect free
			{test: /\.css$/, sideEffects: true, use: [MiniCssExtractPlugin.loader, 'css-loader']},
		],
	},
	plugins: [
		// CSS des librairies (Bootstrap), chargé avant css/style.css
		new MiniCssExtractPlugin({filename: 'vendor.css'}),
	],
};
/*
* * Компилятор LESS файлов versions 2.5.0 * *
* */
const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const CopyWebpackPlugin = require('copy-webpack-plugin');

module.exports = {
    // Настраиваем путь исходника;
    context: path.join(__dirname, 'src'),
    mode: 'production',
    // Указываем гл скрипт для хранение конфиг веппака
    entry: {
        app: ['./js/app','./less/styles.less'],  // путь откуда берет js
    },

    // Куда собираем проект;
    output: {
        path: path.join(__dirname, '../build'),
        filename: './js/[name].js',
    },

    devtool: "source-map",

    module: {
        rules: [
            {
                test: /\.(less)$/,
                include: path.resolve(__dirname, 'src/less'),
                use: ExtractTextPlugin.extract({
                    use: [{
                        loader: "css-loader",
                        options: {
                            sourceMap: true,
                            minimize: true,
                            url: false
                        }
                    },
                        {
                            loader: "less-loader",
                            options: {
                                sourceMap: true
                            }
                        }
                    ]
                })
            },
        ]
    },

    plugins: [
        // don't output the css.js and index.js bundles
        new ExtractTextPlugin({
            filename: './css/style.bundle.css',
            allChunks: true,
        }),
        new CopyWebpackPlugin([{
            from: './fonts',
            to: './fonts'
        },
        ]),
    ]
};
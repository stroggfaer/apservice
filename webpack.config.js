const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');



module.exports = {
    //production
    mode: 'development',

    // Настраиваем путь исходника;
    context: path.join(__dirname, 'src'),


    // Указываем гл скрипт для хранение конфиг веппака
     entry: {
         app: './app',  // путь откуда берет js
         //less: './less/styles.less' // путь откуда берет less
     },

    node: {
        fs: 'empty',
        net: 'empty'
    },

    // Куда собираем проект;
    output: {
        path: path.join(__dirname, 'src'),
        filename: './js/[name].js',
    },
    //Подключаем модули;
    module: {
        rules: [
            {
                test: /\.less$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: ['css-loader', 'postcss-loader', 'less-loader']
                }),

            },
            {
                test: /\.(png|jpg|jpeg|svg|gif)$/,
                include: [
                    path.resolve(__dirname, './images/')  // а тут надо прописать имя папки откуда будет брать все картинки
                ],
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: './src/images/[hash].[ext]',
                    }
                }]
            },
            {
                test: /\.(ttf|eot|woff|woff2|png|jpg|jpeg|svg|gif)$/,
                loader: 'url-loader'
            },

        ],
    },

    // Подключаем плагины;
    plugins: [

        new HtmlWebpackPlugin({
            title: 'Main',
            hash: true,
            template: './index-dev.html', // Где компилируется;
            filename: './index.html',
        }),
        new HtmlWebpackPlugin({
            title: 'Trainers',
            hash: true,
            template: './trainers-dev.html', // Где компилируется;
            filename: './trainers.html',
        }),
        new HtmlWebpackPlugin({
            title: 'Catalog',
            hash: true,
            template: './catalog-dev.html', // Где компилируется;
            filename: './catalog.html',
        }),
        new HtmlWebpackPlugin({
            title: 'Basket',
            hash: true,
            template: './basket-dev.html', // Где компилируется;
            filename: './basket.html',
        }),
        new HtmlWebpackPlugin({
            title: 'Basin',
            hash: true,
            template: './basin-dev.html', // Где компилируется;
            filename: './basin.html',
        }),
        new HtmlWebpackPlugin({
            title: 'ЛК',
            hash: true,
            template: './my-dev.html', // Где компилируется;
            filename: './my.html',
        }),


        new ExtractTextPlugin({
            filename: './css/styles.css',
            allChunks: true
        }),


      //  new webpack.HotModuleReplacementPlugin()

    ],
     devServer: {
         contentBase: "./src",
     }
};

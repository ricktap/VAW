var elixir = require('laravel-elixir');
var vendorDir = __dirname + '/resources/assets/vendor/';
var lessPaths = [
    vendorDir + 'bootstrap/less'
];

elixir(function(mix) {
    mix.less('app.less', 'public/css', { paths: lessPaths })
        .scripts([
            'jquery/dist/jquery.min.js',
            'bootstrap/dist/js/bootstrap.min.js'
        ], 'public/js/vendor.js', vendorDir)
        .copy('resources/assets/js/app.js', 'public/js/app.js')
        .copy(
            'node_modules/socket.io/node_modules/socket.io-client/socket.io.js',
            'public/js/socket.io.js')
        .copy(
            vendorDir + 'jquery/dist/jquery.min.map',
            'public/js/jquery.min.map');
});

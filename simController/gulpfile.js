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
       .copy('resources/assets/js/app.js', 'public/js/app.js');
});

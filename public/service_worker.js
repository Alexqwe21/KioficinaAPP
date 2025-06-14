// EVENTO PARA A INSTALAÇÃO DO SW COLOCANDO OS ARQUIVOS EM CACHE
self.addEventListener('install', function (event) {

    event.waitUntil(

        caches.open('v1').then(function (cache) {
            return cache.addAll([

                'index.php',
                '../app/view/template/head.php',
                '../app/view/login.php',
                'assets/css/estilo.css',
                'assets/img/logo-preto.png',
                'assets/img/logo-kioficina.png'


            ]);
        })

    );

});

// REQUISIÇÃO DOS ARQUIVOS QUE ESTAO EM CACHE 

self.addEventListener('fetch', function(event){
    event.respondWith(
        caches.match(event.request).then(function(response){
            return response || fetch(event.request);
        })
    )
})


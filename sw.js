const cacheName = 'trofhee';
const staticAssets = [
    './',
    './index.php',
    './manifest.json',
    './place.php',
    './style.css'
]

self.addEventListener('install', function(e) {
    e.waitUntil(
        caches.open('twibbonin').then(function(cache){
            return cache.addAll([
                './',
                './css/bootstrap.min.css',
                './img/hero.svg',
                './twibbon.png',
                './js/bootstrap.min.js',
                './index.js',
                './index.php',
                './manifest.json',
                './place.php',
                './style.css'
            ]);
        })
    );
});

self.addEventListener('fetch', function(e) {
    console.log(e.request.url);
    e.respondWith(
        caches.match(e.request).then(function(response){
            return response || fetch (e.request);
        })
    )
})
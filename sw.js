const CACHE_NAME = 'vitamins-site-v1';
const urlsToCache = [
  '/',
  '/index.html',
  '/feedback.php',
  '/vitamins.html',
  '/functions.html',
  '/contacts.html',
  '/style.css',
  '/logotip.png',
  '/n.webp',
  '/m.jpg',
  '/vitf.png',
  '/vit3.png',
  '/send_feedback.php'
];

self.addEventListener('install', async event => {
    const cache = await caches.open(CACHE_NAME)
    await cache.addAll(urlsToCache)

});

self.addEventListener('activate', (event) => {

console.log('Service Worker activating.');

});
  


self.addEventListener('fetch', event => {
  console.log('Fetch', event.request.url)

  event.respondWith(cacheFirst(event.request))
});

async function cacheFirst(request) {
    const cached = await caches.match(request)
    return cached ?? await fetch(request)
}

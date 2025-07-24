// Имя кэша
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

// Установка: кэшируем основные ресурсы
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        return cache.addAll(urlsToCache);
      })
  );
});

// Активация: удаляем старые кэши
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.filter(name => name !== CACHE_NAME)
                  .map(name => caches.delete(name))
      );
    })
  );
});

// Обработка запросов: сначала из кэша, иначе — сеть
self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request)
      .then((cachedResponse) => {
        // Если есть в кэше — возвращаем
        if (cachedResponse) {
          return cachedResponse;
        }
        // Иначе — делаем запрос в сеть
        return fetch(event.request);
      })
  );
});
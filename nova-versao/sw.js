'use strict';
const CACHE = 'agenda-pro-demo-v2';
const ASSETS = ['./index.html', './style.css', './app.js', './icon.svg', './manifest.webmanifest', './privacidade.html'];
const URLS = new Set(ASSETS.map(path => new URL(path, self.registration.scope).href));
self.addEventListener('install', event => {
  event.waitUntil(caches.open(CACHE).then(cache => cache.addAll(ASSETS)).then(() => self.skipWaiting()));
});
self.addEventListener('activate', event => {
  event.waitUntil((async () => {
    const keys = await caches.keys();
    await Promise.all(keys.filter(key => key.startsWith('agenda-pro-demo-') && key !== CACHE).map(key => caches.delete(key)));
    await self.clients.claim();
  })());
});
self.addEventListener('fetch', event => {
  const request = event.request;
  if (request.method !== 'GET' || request.mode === 'navigate' && !new URL(request.url).pathname.startsWith(new URL(self.registration.scope).pathname)) return;
  const url = new URL(request.url);
  if (url.origin !== self.location.origin || !URLS.has(url.href)) return;
  event.respondWith((async () => {
    const cache = await caches.open(CACHE);
    try {
      const response = await fetch(request);
      if (response.ok && response.type === 'basic') {
        await cache.put(request, response.clone());
      }
      return response;
    } catch {
      const cached = await cache.match(request);
      if (cached) return cached;
      return Response.error();
    }
  })());
});

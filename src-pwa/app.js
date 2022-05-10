import { clientsClaim, skipWaiting } from 'workbox-core'
import { CacheableResponsePlugin } from 'workbox-cacheable-response'
import { NetworkFirst, CacheFirst, StaleWhileRevalidate } from 'workbox-strategies'
import { registerRoute, NavigationRoute, setCatchHandler } from 'workbox-routing'
import { ExpirationPlugin } from 'workbox-expiration'
import { precacheAndRoute, matchPrecache } from 'workbox-precaching'

// Get Started https://developers.google.com/web/tools/workbox/guides/get-started
// See https://developers.google.com/web/tools/workbox/guides/route-requests#handling_a_route_with_a_custom_callback

self.skipWaiting()
clientsClaim()

// Cache Pages
registerRoute(new NavigationRoute(new NetworkFirst({
  cacheName: 'pages',
  plugins: [
    // Ensure that only requests that result in a 200 status are cached
    new CacheableResponsePlugin({
      statuses: [200],
    }),
    new ExpirationPlugin({ maxEntries: 100 }),
  ],
})))

// Cache Ajax
registerRoute(
  /wp-json/, // Change to match your endpoint URL.
  new StaleWhileRevalidate({
    cacheName: 'wp-api',
    plugins: [
      new ExpirationPlugin({ maxAgeSeconds: 60 }),
    ],
  }),
)

// Cache Google Fonts
// Cache Google Fonts with a stale-while-revalidate strategy, with
// a maximum number of entries.
registerRoute(
  ({ url }) => url.origin === 'https://fonts.googleapis.com' || url.origin === 'https://fonts.gstatic.com',
  new StaleWhileRevalidate({
    cacheName: 'google-fonts',
    plugins: [
      new ExpirationPlugin({ maxEntries: 20 }),
    ],
  }),
)

// Cache CSS, JS, and Web Worker requests with a Stale While Revalidate strategy
registerRoute(
  // Check to see if the request's destination is style for stylesheets, script for JavaScript, or worker for web worker
  ({ request }) =>
    request.destination === 'style' ||
    request.destination === 'script' ||
    request.destination === 'worker',
  // Use a Stale While Revalidate caching strategy
  new StaleWhileRevalidate({
    // Put all cached files in a cache named 'assets'
    cacheName: 'assets',
    plugins: [
      // Ensure that only requests that result in a 200 status are cached
      new CacheableResponsePlugin({
        statuses: [200],
      }),
    ],
  }),
)

// Cache Images
registerRoute(
  ({ request }) => request.destination === 'image',
  new CacheFirst({
    cacheName: 'image-assets',
    plugins: [
      new CacheableResponsePlugin({
        statuses: [0, 200],
      }),
      new ExpirationPlugin({
        maxEntries: 1000,
        maxAgeSeconds: 60 * 60 * 24 * 30, // 30 Days
      }),
    ],
  }),
)

// Offline Fallback
// Ensure your build step is configured to include /offline.html as part of your precache manifest.
precacheAndRoute([
  { url: '/', revision: '1' },
  { url: '/pwa/offline.html', revision: null },
])

// Catch routing errors, like if the user is offline
setCatchHandler(async ({ event }) => {
  // Return the precached offline page if a document is being requested
  if (event.request.destination === 'document') {
    return matchPrecache('/pwa/offline.html')
  }

  return Response.error()
})

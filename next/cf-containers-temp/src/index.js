/**
 * Cloudflare Worker - E-Devlet Aidat Sistemi
 * PHP Container'a request'leri yönlendirir
 */

import { Container } from '@cloudflare/containers';

/**
 * PHP Container sınıfı
 */
export class PHPContainer extends Container {
  // Apache/PHP container 80 portunda çalışacak
  defaultPort = 80;
  
  // 10 dakika boşta kaldıktan sonra uyut
  sleepAfter = '10m';
  
  // Container'a environment variables geç
  envVars = {
    DB_HOST: 'your-mysql-host',
    DB_USERNAME: 'dayko_aidat',
    DB_PASSWORD: '5Nl?0l9j1',
    DB_DATABASE: 'dayko_aidat',
  };

  /**
   * Container başladığında çalışır
   */
  override onStart() {
    console.log('PHP Container başlatıldı');
  }

  /**
   * Container durdurulduğunda çalışır
   */
  override onStop() {
    console.log('PHP Container durduruldu');
  }

  /**
   * Container hata verdiğinde çalışır
   */
  override onError(error) {
    console.error('PHP Container hatası:', error);
  }
}

/**
 * Worker'ın ana fetch handler'ı
 */
export default {
  async fetch(request, env, ctx) {
    const url = new URL(request.url);
    const pathname = url.pathname;

    // Health check endpoint
    if (pathname === '/health') {
      return new Response('OK', { status: 200 });
    }

    // Container status endpoint
    if (pathname === '/status') {
      return new Response(JSON.stringify({
        status: 'running',
        container: 'PHPContainer',
        timestamp: new Date().toISOString()
      }), {
        headers: { 'Content-Type': 'application/json' }
      });
    }

    try {
      // Tüm istekleri PHP container'a yönlendir
      const container = env.PHP_CONTAINER.idFromName('main-php-instance');
      const stub = env.PHP_CONTAINER.get(container);
      
      // Request'i container'a forward et
      return await stub.fetch(request);
      
    } catch (error) {
      console.error('Container hatası:', error);
      
      return new Response(JSON.stringify({
        error: 'Container hatası',
        message: error.message,
        hint: 'Container başlatılıyor olabilir, lütfen birkaç dakika bekleyin'
      }), {
        status: 503,
        headers: { 'Content-Type': 'application/json' }
      });
    }
  },
};

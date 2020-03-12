<?php namespace Extend\Session;

use Illuminate\Support\ServiceProvider;

class SessionMemcacheServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registryMemcache();
    }

    protected function registryMemcache()
    {
        $this->app['session']->extend('memcache', function($app)
        {
            $memcache = new \Memcache;

            $servers = $app['config']['cache.memcached'];

            foreach ($servers as $server)
            {
                $memcache->addServer($server['host'], $server['port'], $server['weight']);
            }

            if ($memcache->getVersion() === false)
            {
                throw new \RuntimeException("Could not establish Memcache connection.");
            }

            $prefix = $app['config']['cache.prefix'];

            // Return implementation of SessionHandlerInterface
            $options = [
                'prefix'     => 'amo_ss_',
                'expiretime' => $app['config']['session.lifetime'] * 60
            ];

            return new \Extend\Session\MemcacheSessionHandler($memcache, $options);
        });
    }
}
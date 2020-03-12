<?php namespace Extend\Session;

class MemcacheSessionHandler implements \SessionHandlerInterface
{
    /**
     * @var \memcache memcache driver.
     */
    private $memcache;

    /**
     * @var integer Time to live in seconds
     */
    private $ttl;

    /**
     * @var string Key prefix for shared environments.
     */
    private $prefix;

    /**
     * Constructor.
     *
     * List of available options:
     *  * prefix: The prefix to use for the memcache keys in order to avoid collision
     *  * expiretime: The time to live in seconds
     *
     * @param \memcache $memcache A \memcache instance
     * @param array      $options   An associative array of memcache options
     *
     * @throws \InvalidArgumentException When unsupported options are passed
     */
    public function __construct(\Memcache $memcache, array $options = array())
    {
        $this->memcache = $memcache;

        if ($diff = array_diff(array_keys($options), array('prefix', 'expiretime'))) {
            throw new \InvalidArgumentException(sprintf(
                'The following options are not supported "%s"', implode(', ', $diff)
            ));
        }

        $this->ttl = isset($options['expiretime']) ? (int) $options['expiretime'] : 86400;
        $this->prefix = isset($options['prefix']) ? $options['prefix'] : 'sf2s';
    }

    /**
     * {@inheritDoc}
     */
    public function open($savePath, $sessionName)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function close()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function read($sessionId)
    {
        return $this->memcache->get($this->prefix.$sessionId) ?: '';
    }

    /**
     * {@inheritDoc}
     */
    public function write($sessionId, $data)
    {
        return $this->memcache->set($this->prefix.$sessionId, $data, 0, time() + $this->ttl);
    }

    /**
     * {@inheritDoc}
     */
    public function destroy($sessionId)
    {
        return $this->memcache->delete($this->prefix.$sessionId);
    }

    /**
     * {@inheritDoc}
     */
    public function gc($lifetime)
    {
        // not required here because memcache will auto expire the records anyhow.
        return true;
    }

    /**
     * Return a memcache instance
     *
     * @return \memcache
     */
    protected function getmemcache()
    {
        return $this->memcache;
    }
}
<?php

/**
 * @see       https://github.com/laminas/laminas-cache for the canonical source repository
 * @copyright https://github.com/laminas/laminas-cache/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-cache/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Cache\Storage\Adapter;

use Laminas\Cache;

/**
 * @group      Laminas_Cache
 * @covers Laminas\Cache\Storage\Adapter\Apc<extended>
 */
class ApcTest extends AbstractCommonAdapterTest
{
    /**
     * Restore 'apc.use_request_time'
     *
     * @var mixed
     */
    protected $iniUseRequestTime;

    public function setUp(): void
    {
        try {
            new Cache\Storage\Adapter\Apc();
        } catch (Cache\Exception\ExtensionNotLoadedException $e) {
            $this->markTestSkipped($e->getMessage());
        }

        // needed on test expirations
        $this->iniUseRequestTime = ini_get('apc.use_request_time');
        ini_set('apc.use_request_time', 0);

        $this->options = new Cache\Storage\Adapter\ApcOptions();
        $this->storage = new Cache\Storage\Adapter\Apc();
        $this->storage->setOptions($this->_options);

        parent::setUp();
    }

    public function tearDown(): void
    {
        if (function_exists('apc_clear_cache')) {
            apc_clear_cache('user');
        }

        // reset ini configurations
        ini_set('apc.use_request_time', $this->iniUseRequestTime);

        parent::tearDown();
    }

    public function getCommonAdapterNamesProvider()
    {
        return [
            ['apc'],
            ['Apc'],
        ];
    }
}

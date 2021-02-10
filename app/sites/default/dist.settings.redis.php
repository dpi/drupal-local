<?php

// Rename to settings.redis.php to enable.

declare(strict_types = 1);

$settings['cache']['default'] = 'cache.backend.redis';
$settings['redis.connection'] = [
  'host' => 'redis',
  'port' => 6379,
  'interface' => 'PhpRedis',
  'persistent' => TRUE,
];

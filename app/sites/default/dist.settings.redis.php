<?php

// Rename to settings.redis.php to enable.

declare(strict_types = 1);

// Prevent Redis from loading in PHPUnit tests.
if (defined('BOOTSTRAP_IS_PHPUNIT')) {
  return;
}

$settings['container_yamls'][] = __DIR__ . '/services.redis.yml';

$settings['cache']['default'] = 'cache.backend.redis';
$settings['redis.connection'] = [
  'host' => 'redis',
  'port' => 6379,
  'interface' => 'PhpRedis',
  'persistent' => TRUE,
];

<?php

declare(strict_types = 1);

// Add your own hash salt in a settings.local.php.
$settings['hash_salt'] = '';

$settings['update_free_access'] = FALSE;
$settings['container_yamls'][] = __DIR__ . '/services.yml';
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];
$settings['entity_update_batch_size'] = 50;
$settings['entity_update_backup'] = TRUE;
$settings['migrate_node_migrate_type_classic'] = FALSE;

foreach (glob(__DIR__ . '/settings.*.php') as $filename) {
  include_once $filename;
}

$settings['config_sync_directory'] = DRUPAL_ROOT . '/../config';

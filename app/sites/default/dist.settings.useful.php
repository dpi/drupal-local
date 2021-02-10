<?php

declare(strict_types = 1);

/**
 * @file
 * Useful settings.
 *
 * Rename this file or copy contents to settings.local.php.
 */

// More services:
//$settings['container_yamls'][] = __DIR__ . '/services.local.yml';

// PHP.
ini_set('display_errors', 1);
ini_set('memory_limit','512M');
\Drupal\Component\Assertion\Handle::register();
assert_options(ASSERT_ACTIVE, TRUE);

$settings['trusted_host_patterns'][] = '^localhost$';
$settings['trusted_host_patterns'][] = '^[a-z\-0-9]{1,32}\.localhost$';

$settings['extension_discovery_scan_tests'] = TRUE;
$settings['skip_permissions_hardening'] = TRUE;

$config['field_ui.settings']['field_prefix'] = '';

$config['system.logging']['error_level'] = 'verbose';
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

$config['views.settings']['skip_cache'] = TRUE;
$config['views.settings']['ui']['show']['sql_query']['enabled'] = TRUE;

// Caches.
//$settings['cache']['default'] = 'cache.backend.null';
//$settings['cache']['bins']['render'] = 'cache.backend.null';
//$settings['cache']['bins']['page'] = 'cache.backend.null';
//$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

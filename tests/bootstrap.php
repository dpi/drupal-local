<?php

declare(strict_types=1);

require __DIR__ . '/../app/core/tests/bootstrap.php';

use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->usePutenv()->loadEnv(__DIR__ . '/../.env');

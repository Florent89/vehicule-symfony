<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';
//serveur distant
//require_once dirname(__DIR__) . '/symfony/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

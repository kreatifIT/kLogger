<?php

namespace Kreatif\KLogger;

use rex;
use rex_config;
use rex_logger;
use Rollbar\Rollbar;
use Rollbar\Payload\Level;
use rex_extension_point;

class Logger
{
    public static function init()
    {
        $accessToken = rex_config::get('klogger', 'rollbar_access_token');
        if (!$accessToken) {
            rex_logger::logError(E_WARNING, 'KLogger: Rollbar access token not set', __FILE__, __LINE__);
            return;
        }
        $settings = [
            'access_token' => $accessToken,
            'environment' => rex::getProperty('debug')['enabled'] ? 'testing' : 'production',
        ];
        Rollbar::init($settings);
    }

    /**
     * @param rex_extension_point $ep
     * @return void
     */
    public static function ext__handleCronjobError(rex_extension_point $ep): void
    {
        self::init();
        $throwable = $ep->getSubject();
        Rollbar::log(Level::ERROR, $throwable->getMessage());
    }
}

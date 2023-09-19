<?php

use Kreatif\KLogger\Logger;

Logger::init();
rex_extension::register('KCRONJOB_ERROR', [Logger::class, 'ext__handleCronjobError']);

<?php

use Monolog\Logger;

return array(
    'hosts' => array(
        'http://87.230.22.205:9200'
    ),
    'logPath' => storage_path() . '/logs/elasticsearch-' . php_sapi_name() . '.log',
    'logLevel' => Logger::INFO
);
<?php

return array(
    // define proper endpoint
    'endpoint' => array(
        'localhost' => array(
            'host' => '127.0.0.1',
            'port' => 8983,
            'path' => '/solr/laravel(demo)/',
            // only add these if Solr is setup up to use basic auth
            // 'username' => '',
            // 'password' => '',
        ),
    ),
);
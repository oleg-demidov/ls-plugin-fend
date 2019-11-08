<?php

$config['$root$']['router']['page']['category'] = 'PluginFend_ActionCategory';

$config['$root$']['block']['settingsCategory'] = array(
    'action' => array(
        'category' => [
            '{category_settings}'
        ]
    ),
    'blocks' => array(
        'left' => array(
            'menuSettings'     => array('priority' => 100)
            
        )
    )
);

return $config;
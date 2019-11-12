<?php

$config['$root$']['router']['page']['category'] = 'PluginFend_ActionCategory';
$config['$root$']['router']['page']['people'] = 'PluginFend_ActionPeople';
$config['$root$']['router']['page']['company'] = 'PluginFend_ActionPeople';

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

$config['$root$']['block']['searchPeople'] = array(
    'action' => array(
        'people',
        'company'
    ),
    'blocks' => array(
        'top' => array(
            'search'     => array('priority' => 100, 'params' => ['plugin' => 'fend'])
            
        )
    )
);

$config['counе_allow_branch'] = 1; //Максимальное количество направлений профессий

return $config;
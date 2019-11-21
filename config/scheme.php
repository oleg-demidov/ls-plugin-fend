<?php

$config['$config_scheme$'] = array(
    
    'count_allow_branch' =>  array(
        'type'        => 'integer',
        'name'        => '1го уровня',
        'validator'   => array(
            'type'   => 'Number',
            'params' => array(
                'min'        => 0,
                'max'        => 5000,
                'allowEmpty' => true,
            ),
        ),
    ),
    
    'count_allow_way' =>  array(
        'type'        => 'integer',
        'name'        => '2го уровня',
        'validator'   => array(
            'type'   => 'Number',
            'params' => array(
                'min'        => 0,
                'max'        => 5000,
                'allowEmpty' => true,
            ),
        ),
    ),
    
    'count_allow' =>  array(
        'type'        => 'integer',
        'name'        => '3го уровня',
        'validator'   => array(
            'type'   => 'Number',
            'params' => array(
                'min'        => 0,
                'max'        => 5000,
                'allowEmpty' => true,
            ),
        ),
    ),
);

$config['$config_sections$'] = array(
    
   
    
    array(
        /**
         * Название раздела
         */
        'name' => 'Максимальное количество категорий',
        /**
         * Список параметров для отображения в разделе
         */
        'allowed_keys' => array(
                'count_allow_branch',
                'count_allow_way',
                'count_allow'
        ),
        /**
         * Список параметров для исключения из раздела

        'excluded_keys' => array(
                'other.two',
        ),*/
    )
);


return $config;


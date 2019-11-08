<?php

class PluginFend_ModuleUser_EntityUser extends PluginFend_Inherits_ModuleUser_EntityUser
{
        
    protected $aBehaviors = [
        'geo' => [
            'class' => 'PluginGeo_ModuleGeo_BehaviorEntity',
            'target_type' => 'user_geo'
        ]
    ];
}
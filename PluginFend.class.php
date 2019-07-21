<?php
/**
 * 
 * @author Oleg Demidov
 *
 */

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attempt!');
}

class PluginFend extends Plugin
{
        
    protected $aInherits = [
        'entity' => [
            'ModuleUser_EntityUser' => '_ModuleUser_EntityUser'
        ],
//        'module' => [
//            'ModuleUser' => '_ModuleUser'
//        ]
    ];
    
    public function Init()
    {
//        $this->Lang_AddLangJs([
//            'plugin.subscribe.subscribe.text.subscribe',
//            'plugin.subscribe.subscribe.text.unsubscribe'
//        ]);

//        $this->Component_Add('subscribe:subscribe');
        
        
    }

    public function Activate()
    {
        $this->PluginProperty_Property_CreateTargetType('contacts', [
            'name' => 'Контакты'
        ]);
        
        $aFields = array(
            array(
                'data'=>array(
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_VARCHAR,
                    'title'=>'Сайт',
                    'code'=>'site',
                    'sort'=>100
                ),
                'validate_rule'=>array(
                    'min'=>3,
                    'max'=>200
                ),
                'params'=>array(
                    'icon' => "link:s",
                    'placeholder' => 'Сайт'
                ),
                'additional'=>array()
            ),
            array(
                'data'=>array(
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_VARCHAR,
                    'title'=>'ВКонтакте',
                    'code'=>'vkontakte',
                    'sort'=>100
                ),
                'validate_rule'=>array(
                    'min'=>3,
                    'max'=>200
                ),
                'params'=>array(
                    'icon' => "vk:b",
                    'placeholder' => 'ВКонтакте'
                ),
                'additional'=>array()
            ),
            array(
                'data'=>array(
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_VARCHAR,
                    'title'=>'Facebook',
                    'code'=>'facebook',
                    'sort'=>100
                ),
                'validate_rule'=>array(
                    'min'=>3,
                    'max'=>200
                ),
                'params'=>array(
                    'icon' => "facebook-f:b",
                    'placeholder' => 'Facebook'
                ),
                'additional'=>array()
            ),
            array(
                'data'=>array(
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_VARCHAR,
                    'title'=>'Instagram',
                    'code'=>'instagram',
                    'sort'=>100
                ),
                'validate_rule'=>array(
                    'min'=>3,
                    'max'=>200
                ),
                'params'=>array(
                    'icon' => "instagram:b",
                    'placeholder' => 'Instagram'
                ),
                'additional'=>array()
            ),
            array(
                'data'=>array(
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_VARCHAR,
                    'title'=>'Twitter',
                    'code'=>'twitter',
                    'sort'=>100
                ),
                'validate_rule'=>array(
                    'min'=>3,
                    'max'=>200
                ),
                'params'=>array(
                    'icon' => "twitter:b",
                    'placeholder' => 'Twitter'
                ),
                'additional'=>array()
            ),
            array(
                'data'=>array(
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_VARCHAR,
                    'title'=>'Youtube',
                    'code'=>'youtube',
                    'sort'=>100
                ),
                'validate_rule'=>array(
                    'min'=>3,
                    'max'=>200
                ),
                'params'=>array(
                    'icon' => "youtube:b",
                    'placeholder' => 'Youtube'
                ),
                'additional'=>array()
            )
        );
        $this->PluginProperty_Property_CreateDefaultTargetPropertyFromPlugin($aFields, 'contacts');
        return true;
    }

    public function Deactivate()
    {
        
        return true;
    }
    
    public function Remove()
    {
        
        return true;
    }
}
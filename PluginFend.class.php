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
            'ModuleUser_EntityUser' => '_ModuleUser_EntityUser',
            'ModuleCategory_EntityCategory' => '_ModuleCategory_EntityCategory'
        ],
        'module' => [
            'ModuleUser' => '_ModuleUser',
            'ModuleCategory' => '_ModuleCategory'
        ]
    ];
    
    public function Init()
    {
        $this->Lang_AddLangJs([
            'plugin.fend.category.msg.allow_count_branch'
        ]);

        $this->Component_Add('fend:category');
        $this->Component_Add('fend:search');
        $this->Viewer_AppendScript(Plugin::GetTemplatePath(__CLASS__) . 'assets/js/init.js');
        
        
    }

    public function Activate()
    {
        $this->PluginProperty_Property_CreateTargetType('contacts', [
            'name' => 'Контакты'
        ]);
        
        $aFields = array(
            array(
                'data'=>array(
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_URL,
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
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_URL,
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
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_URL,
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
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_URL,
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
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_URL,
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
                    'type'=>PluginProperty_ModuleProperty::PROPERTY_TYPE_URL,
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
        
        $this->Category_CreateTargetType('user_category', 'Люди');
        $this->Category_CreateTargetType('company_category', 'Компании');
        
        $this->PluginSeo_Seo_AddRule(
            'Поиск людей и компаний',
            'people',
            [
                'city_title',
                'city_description',
                'city_keywords',
                'category_title',
                'category_description',
                'category_keywords'
            ]
        );
        
        
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
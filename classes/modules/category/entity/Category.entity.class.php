<?php
/*
 * LiveStreet CMS
 * Copyright © 2013 OOO "ЛС-СОФТ"
 *
 * ------------------------------------------------------
 *
 * Official site: www.livestreetcms.com
 * Contact e-mail: office@livestreetcms.com
 *
 * GNU General Public License, version 2:
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * ------------------------------------------------------
 *
 * @link http://www.livestreetcms.com
 * @copyright 2013 OOO "ЛС-СОФТ"
 * @author Maxim Mzhelskiy <rus.engine@gmail.com>
 *
 */

/**
 * Сущность категории
 *
 * @package application.modules.category
 * @since 2.0
 */
class PluginFend_ModuleCategory_EntityCategory extends PluginFend__Inherits_ModuleCategory_EntityCategory
{

    protected $aBehaviors = [
        'seo' => [
            'class'     => 'PluginSeo_ModuleSeo_BehaviorEntity',
            'target_type' => 'category_seo',
            'field'     => 'category[seo]',
            'validate'  => false
        ]
    ];
    
    public function Init(){
        $this->aValidateRules[] = [
            'seo', 'seo'
        ];
        parent::Init();
        
        
    }
    
    public function ValidateSeo($mValue) {        
        return $this->seo->ValidateSeoCheck($mValue);
    }
}
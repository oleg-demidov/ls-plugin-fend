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
 * @author Oleg Demidov
 *
 */

/**
 * Модуль управления дополнительными полями
 *
 * @package application.modules.fend
 * @since 2.0
 */
class PluginFend_ModuleUser extends PluginFend__Inherits_ModuleUser
{
    
    public function Init()
    {
        $this->aBehaviors['geo'] = [
            'class' => 'PluginGeo_ModuleGeo_BehaviorModule',
            'target_type' => 'user_geo'
        ];
        
        $this->aBehaviors['user_category'] = [
            'class' => 'ModuleCategory_BehaviorModule',
            'target_type' => 'user_category'
        ];
        
        $this->aBehaviors['company_category'] = [
            'class' => 'ModuleCategory_BehaviorModule',
            'target_type' => 'company_category'
        ];
        
        parent::Init();
        
    }

    public function GetUserItemsByFilter($aFilter) {
        
        return parent::GetUserItemsByFilter($aFilter);
        
    }
}
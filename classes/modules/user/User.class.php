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
        
        $entity = Engine::GetEntity('User_User');
        
        $sJoin = "LEFT JOIN (SELECT count(*) as rescount, `target_id` FROM " . Config::Get('db.table.talk_response') . " WHERE `target_type` = 'user' AND `type` = 'response' GROUP BY `target_id`) res ON
                    t.`{$entity->_getPrimaryKey()}` = res.target_id ";
                    
        $aFilter['#join'][$sJoin] = [];
        
        $sJoin = "LEFT JOIN (SELECT count(*) as count_vote, `target_id`, (SUM(`vote`) / count(*)) as rating  FROM " . Config::Get('db.table.rating_vote') . " GROUP BY `target_id`) vote ON
                    t.`{$entity->_getPrimaryKey()}` = vote.target_id ";
                    
        $aFilter['#join'][$sJoin] = [];

        $aFilter['#select'] = ['distinct t.*','res.rescount', 'vote.rating'];
        
        $aFilter = $this->RewriteFilter($aFilter);
        
        return parent::GetUserItemsByFilter($aFilter);
        
    }
    
    public function GetCountFromUsers($aFilter) { 
        
        $aFilter = $this->RewriteFilter($aFilter);
        
        return parent::GetCountFromUserByFilter($aFilter);
    }

    public function RewriteFilter($aFilter) 
    {
        $entity = Engine::GetEntity('User_User');
           
        
        if (array_key_exists('#geo', $aFilter)) {
            
            
            
            $sJoin = "LEFT JOIN " . Config::Get('db.table.geo_geo_target') . " gt ON
                    t.`{$entity->_getPrimaryKey()}` = gt.target_id and
                    gt.target_type = '{$entity->geo->getParam('target_type')}'"
                    . " JOIN " . Config::Get('db.table.property_property') . " pr ON"
                    . " pr.code = 'geo_all_city' "
                    . " LEFT JOIN  " . Config::Get('db.table.property_property_value') . " pv ON"
                    . " pv.property_id = pr.id AND pv.target_id = t.id ";
                     
            $aFilter['#join'][$sJoin] = [];
            
            $sKey = '';
            $aGeo = [];
            
            if (isset($aFilter['#geo']['country'])) 
            {
                $sKey .= " gt.country_id = ?d  ";
                $aGeo[] = $aFilter['#geo']['country'];
            } 
            
            if (isset($aFilter['#geo']['region'])) 
            {
                if (isset($aFilter['#geo']['country'])) 
                {
                    $sKey .= " and";
                } 
                $sKey .= " gt.region_id = ?d  ";
                $aGeo[] = $aFilter['#geo']['region'];
            }
            
            if (isset($aFilter['#geo']['city'])) 
            {
                if (isset($aFilter['#geo']['region']) or isset($aFilter['#geo']['country'])) 
                {
                    $sKey .= " and";
                } 
                $sKey .= " gt.city_id = ?d ";
                $aGeo[] = $aFilter['#geo']['city'];
            }            
            
            $sKey = "(({$sKey}) OR pv.value_int = 1)";
            
            $aFilter['#where'][$sKey] = $aGeo;
            
            unset($aFilter['#geo']);
        }
        
        if(array_key_exists('#query', $aFilter)){
            $aFilter['#where'] = [
                '(t.login LIKE ? OR t.mail LIKE ? OR t.about LIKE ? OR t.name LIKE ?)' => [
                    '%'.getRequest('text').'%',
                    '%'.getRequest('text').'%',
                    '%'.getRequest('text').'%',
                    '%'.getRequest('text').'%'
                ]
            ];
        }
        
         
         
        return $aFilter;
    }
    

      
    
    
}
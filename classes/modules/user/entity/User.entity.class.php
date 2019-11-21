<?php

class PluginFend_ModuleUser_EntityUser extends PluginFend_Inherits_ModuleUser_EntityUser
{
        
    
    
    public function Init() {
        $this->aBehaviors['geo'] = [
            'class' => 'PluginGeo_ModuleGeo_BehaviorEntity',
            'target_type' => 'user_geo',
            'require' => false
        ];
        
        $this->aBehaviors['user_category'] = [
            'class'         => 'ModuleCategory_BehaviorEntity',
            'target_type'   => 'user_category',
            'form_field'    => 'user_categories',
            'multiple'      => true,
            'validate_on'   => ['change_category', 'profile_settings'],
            'validate_max'                   => 5000
        ];
        
        $this->aBehaviors['company_category'] = [
            'class'         => 'ModuleCategory_BehaviorEntity',
            'target_type'   => 'company_category',
            'form_field'    => 'company_categories',
            'multiple'      => true,
            'validate_on'   => ['change_category', 'profile_settings'],
            'validate_max'                   => 5000
        ];
        
        $this->aBehaviors['contacts'] = [
            'class' => PluginProperty_ModuleProperty_BehaviorEntity::class,
            'target_type' => 'contacts'
        ];
        
        $this->aValidateRules[] = [
            'company_categories user_categories',
            'category',
            'on' => ['change_category']
        ];
                
        parent::Init();
        
    }
    
    public function getCats() {
        if($this->isRole('user')){
            return $this->user_category->getCategories();
        }else{
            return $this->company_category->getCategories();
        }
    }
    
    public function ValidateCategory($aCategory) {
        if(!$aCategory){
            return true;
        }
        
        list($aCategory, $aCategory1, $aCategory2) = $this->Category_GetWithParents($aCategory);
                
        $aCategoryRoot = $this->Category_GetCategoryItemsByFilter([
            'pid' => null,
            '#index-from' => 'id'
        ]); 

        if(count($aCategory) > Config::Get('plugin.fend.count_allow_branch')){
            return $this->Lang_Get(
                'plugin.fend.category.msg.allow_count_branch', 
                ['count' => Config::Get('plugin.fend.count_allow_branch')]
            );
        }

        if(count($aCategory1) > Config::Get('plugin.fend.count_allow_way')){
            return $this->Lang_Get(
                'plugin.fend.category.msg.allow_count_way', 
                ['count' => Config::Get('plugin.fend.count_allow_way')]
            );
        }

        if(count($aCategory2) > Config::Get('plugin.fend.count_allow')){
            return $this->Lang_Get(
                'plugin.fend.category.msg.allow_count', 
                ['count' => Config::Get('plugin.fend.count_allow')]
            );
        }
        
        return true;
    }
        
}

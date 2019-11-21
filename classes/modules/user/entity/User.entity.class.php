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
            'validate_on'   => ['change_category', 'profile_settings']
        ];
        
        $this->aBehaviors['company_category'] = [
            'class'         => 'ModuleCategory_BehaviorEntity',
            'target_type'   => 'company_category',
            'form_field'    => 'company_categories',
            'multiple'      => true,
            'validate_on'   => ['change_category', 'profile_settings']
        ];
        
        $this->aBehaviors['contacts'] = [
            'class' => PluginProperty_ModuleProperty_BehaviorEntity::class,
            'target_type' => 'contacts'
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
        
}

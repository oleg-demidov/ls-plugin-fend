<?php

class PluginFend_ModuleUser_EntityUser extends PluginFend_Inherits_ModuleUser_EntityUser
{
        
    
    
    public function Init() {
        parent::Init();
        
        $this->AttachUserBehavior();
    }
    
    public function AttachUserBehavior() {
        $this->AttachBehavior('contacts', [
            'class' => PluginProperty_ModuleProperty_BehaviorEntity::class,
            'target_type' => 'contacts'
        ]);
        
    }
    
    public function AttachCategoryBehavior() {
        if($this->Rbac_IsRole($this, 'user')){
            $this->AttachBehavior('category', [
                'class'         => 'ModuleCategory_BehaviorEntity',
                'target_type'   => 'user_category',
                'form_field'    => 'categories',
                'multiple'      => true
            ]);
        }else{
            $this->AttachBehavior('category', [
                'class'         => 'ModuleCategory_BehaviorEntity',
                'target_type'   => 'company_category',
                'form_field'    => 'categories',
                'multiple'      => true
            ]);
        }
    }
}

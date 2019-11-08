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
        
        
        if($this->isRole('user')){
            $this->AttachBehavior('category', [
                'class' => 'ModuleCategory_BehaviorEntity',
                'target_type' => 'user_category'
            ]);
        }else{
            $this->AttachBehavior('category', [
                'class' => 'ModuleCategory_BehaviorEntity',
                'target_type' => 'company_category'
            ]);
        }
    }
}

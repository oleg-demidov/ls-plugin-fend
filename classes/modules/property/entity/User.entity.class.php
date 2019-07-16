<?php

class PluginFend_ModuleUser_EntityUser extends PluginFend_Inherits_ModuleUser_EntityUser
{
        
    
    
    public function Init() {
        parent::Init();
        
        $this->PluginProperty_Property_AttachUserBehavior($this);
    }
}
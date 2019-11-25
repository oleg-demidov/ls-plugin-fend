<?php

class PluginFend_HookProfileSettings extends Hook {
    
    /**
     * Регистрируем хуки
     */
    public function RegisterHook() {
        $this->AddHook('menu_before_prepare', 'Menu');
        
        $this->AddHook('template_profile_settings_geo', 'SettingsGeo', null, 1000);
        $this->AddHook('template_profile_settings_geo', 'SettingsGeoAllCity', null, 999);
    }

    public function Menu($aParams) { 
        
        if($aParams['menu']->getName() != 'settings'){
            return false;
        }
        
        if(!$oUser = $this->User_GetUserByLogin(Router::GetActionEvent())){
            return false;
        }
        
        $aParams['menu']->appendChild(Engine::GetEntity("ModuleMenu_EntityItem", [
            'name' => 'category',
            'title' => 'plugin.fend.category.menu_item',
            'url' => 'category/'.$oUser->getLogin(). '/settings'
        ]));
        
        
    }
    
    public function SettingsGeo($aParams) { 

        return smarty_insert_block([
            'block' => 'geo',
            'params' => [
                'plugin' => 'geo',
                'target' => $aParams['oUser'],
                'target_type' => 'user_geo',
                'entity' => 'User_User'
            ],
            
        ], $nll);
        
    }
    
    public function SettingsGeoAllCity($aParams) { 

        return smarty_insert_block([
            'block' => 'propertyUpdate',
            'params' => [
                'plugin' => 'property',
                'target' => $aParams['oUser'],
                'target_type' => 'field',
                'entity' => 'User_User'
            ],
            
        ], $nll);
        
    }
}

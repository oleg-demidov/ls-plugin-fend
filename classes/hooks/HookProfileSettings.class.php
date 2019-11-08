<?php

class PluginFend_HookProfileSettings extends Hook {
    
    /**
     * Регистрируем хуки
     */
    public function RegisterHook() {
        $this->AddHook('menu_before_prepare', 'Menu');
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
}
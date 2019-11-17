<?php

class PluginFend_HookModeration extends Hook {
    
    /**
     * Регистрируем хуки
     */
    public function RegisterHook() {
        
        $this->AddHook('template_moderation_profile_end', 'SettingsCategory', null, 1000);
    }

    
    public function SettingsCategory($aParams) { 

        return smarty_insert_block([
            'block' => 'fieldCategory',
            'params' => [
                'plugin' => 'fend',
                'user' => $aParams['oUser']
            ]
            
        ], $nll);
        
    }
}

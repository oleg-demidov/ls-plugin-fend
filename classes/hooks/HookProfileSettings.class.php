<?php

class PluginFend_HookProfileSettings extends Hook {
    
    /**
     * Регистрируем хуки
     */
    public function RegisterHook() {
        /**
         * Хук на отображение админки
         */
        $this->AddHook('template_profile_settings_end"', 'SettingsGeo');
    }

    public function SettingsGeo($aParams) { 
        $this->Logger_Notice(__METHOD__);
        return smarty_insert_block([
            'block' => 'geo',
            'plugin' => 'geo',
            'target' => $aParams['oUserProfile'],
            'target_type' => 'user_geo'
        ], null);
        
    }
}
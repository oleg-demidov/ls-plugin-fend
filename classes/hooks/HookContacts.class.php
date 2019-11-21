<?php

/**
 * Description of HookContacts
 *
 * @author oleg
 */
class PluginFend_HookContacts extends Hook {
    //put your code here
    public function RegisterHook() {
        $this->AddHook('template_profile_settings_end', 'FieldsContacts');
        $this->AddHook('template_profile_contacts', 'Contacts');        
    }

    public function FieldsContacts($aParams) {
        $this->Viewer_Assign('oUser', $aParams['oUser']);
        return $this->Viewer_Fetch('component@fend:contacts.input');
    }
    
    public function Contacts($aParams) {
        $aProperties = $this->PluginProperty_Property_GetEntityPropertyList($aParams['oUser'], $aParams['oUser']->contacts);
        
        $this->Viewer_Assign('aProperties', $aProperties);
        return $this->Viewer_Fetch('component@fend:contacts.output');
    }
}

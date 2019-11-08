<?php

/**
 * Description of HookContacts
 *
 * @author oleg
 */
class PluginFend_HookSocialityUrl extends Hook {
    //put your code here
    public function RegisterHook() {
        $this->AddHook('sociality_create_relation', 'AddUrl');
    }

    public function AddUrl($aParams) {
        
        
        $oProperty = $this->PluginProperty_Property_GetEntityPropertyValueObject(
            $aParams['oUser'], 
            $aParams['oUser']->contacts, 
            strtolower($aParams['provider'])
        );
        
        
        if (!$oProperty) {
            return;
        }
        
        $aParams['oUser']->setProperties([$oProperty->getId() => $aParams['oProfileData']->profileURL]);
        $aParams['oUser']->_Validate();
        $res = $aParams['oUser']->Save();
    }
    
}

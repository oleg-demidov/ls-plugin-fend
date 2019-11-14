<?php

/**
 * Description of HookContacts
 *
 * @author oleg
 */
class PluginFend_HookSeo extends Hook {
    //put your code here
    public function RegisterHook() {
        $this->AddHook('template_category_form_end', 'FieldsSeo');
    }

    public function FieldsSeo($aParams) {
        
        $this->Viewer_Assign('entity', $aParams['entity']);
        $this->Viewer_Assign('target', $aParams['category']);
        
        return $this->Viewer_Fetch('component@fend:seo');
        
    }
    
}

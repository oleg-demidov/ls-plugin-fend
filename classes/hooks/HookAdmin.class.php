<?php

class PluginFend_HookAdmin extends Hook
{

    public function RegisterHook()
    {
        $this->AddHook('admin_delete_content_after', 'UserContentDelete', __CLASS__, 10);
    }
    
    public function UserContentDelete(&$aParams) {
        $this->Talk_DeleteMessageItemsByFilter(['user_id' => $aParams['oUser']->getId()]);
        $this->Talk_DeleteMessageItemsByFilter([
            'target_id' => $aParams['oUser']->getId(), 
            'target_type' => $aParams['oUser']->getId()
        ]);
        
    }
}
<?php

/*
 * OLeg Demidov
 * ------------------------------------------------------
 * Contact e-mail: end-fin@yandex.ru
 *
 * GNU General Public License, version 2:
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * ------------------------------------------------------
 *
 * @link https://vk.com/u_demidova
 * @author Oleg Demidov <end-fin@yandex.ru>
 *
 */

/**
 * Description of PluginFend_ActionCategory
 *
 * @author oleg
 */
class PluginFend_ActionCategory extends Action{

    protected function RegisterEvent() {
        $this->AddEventPreg('/^[\w_-]+$/i', ['EventSettings', 'category_settings']);
    }

    protected $oUserProfile = null;

    public function Init()
    {
        $this->oUserProfile = $this->User_GetUserByLogin(Router::GetActionEvent());
    }

    public function EventSettings() {
        if(!$this->oUserProfile ){
            return $this->EventNotFound();
        }
        
        
        
        $this->Menu_Get('settings')->setActiveItem('category');
        $this->SetTemplateAction('category');      
        
        
    }
    
    public function EventShutdown() {
        $this->Viewer_Assign('userProfile', $this->oUserProfile);
        $this->Viewer_Assign('behavior', $this->oUserProfile->category);
    }
}

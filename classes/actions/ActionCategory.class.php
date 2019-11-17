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

    public function EventSettings() 
    {
        if(!$this->oUserProfile ){
            return $this->EventNotFound();
        }
        
        if($this->Rbac_IsRole($this->oUserProfile, 'user')){
            $behavior = $this->oUserProfile->user_category;
        }else{
            $behavior = $this->oUserProfile->company_category;
        } 
       
        $this->Menu_Get('settings')->setActiveItem('category');
        $this->SetTemplateAction('category');
        $this->Viewer_Assign('behavior', $behavior);
        
        if (!isPost()) {
            return;
        }
        
        $this->oUserProfile->_setValidateScenario('change_category');
        
        $this->oUserProfile->_setData([$behavior->getParam('form_field') => getRequest($behavior->getParam('form_field'))]); 
        
        if($this->oUserProfile->_Validate([$behavior->getParam('form_field')])){
            if($this->oUserProfile->Save()){ 
                $this->Message_AddNotice($this->Lang_Get('common.success.save'));
            }
        }else{
            $this->Message_AddError($this->oUserProfile->_getValidateError());
        }
        
        
    }
    
    public function EventShutdown() 
    {
        
        
        $this->Viewer_AssignJs('countAllowBranch', Config::Get('plugin.fend.counе_allow_branch'));
        $this->Viewer_Assign('userProfile', $this->oUserProfile);
    }
}

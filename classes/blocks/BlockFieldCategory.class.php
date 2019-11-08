<?php
/*
 * LiveStreet CMS
 * Copyright © 2013 OOO "ЛС-СОФТ"
 *
 * ------------------------------------------------------
 *
 * Official site: www.livestreetcms.com
 * Contact e-mail: office@livestreetcms.com
 *
 * GNU General Public License, version 2:
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * ------------------------------------------------------
 *
 * @link http://www.livestreetcms.com
 * @copyright 2013 OOO "ЛС-СОФТ"
 * @author Maxim Mzhelskiy <rus.engine@gmail.com>
 *
 */

/**
 * Обработка блока с редактированием категорий объекта
 *
 * @package application.blocks
 * @since   2.0
 */
class PluginFend_BlockFieldCategory extends Block
{
    /**
     * Запуск обработки
     */
    public function Exec()
    {
        
        $user = $this->GetParam('user');

        if($this->Rbac_IsRole($user, 'user')){
            $user->AttachBehavior('category', [
                'class' => 'ModuleCategory_BehaviorEntity',
                'target_type' => 'user_category'
            ]);
        }else{
            $user->AttachBehavior('category', [
                'class' => 'ModuleCategory_BehaviorEntity',
                'target_type' => 'company_category'
            ]);
        }
        
        $oBehavior = $user->category;
        
        /**
         * Нужное нам поведение - получаем список текущих категорий
         */
        $this->Viewer_Assign('categoriesSelected', $oBehavior->getCategories(), true);
        /**
         * Загружаем параметры
         */
        $aParams = $oBehavior->getParams();
        $this->Viewer_Assign('params', array_merge($aParams, $this->GetParam('params', [])));
        /**
         * Загружаем список доступных категорий
         */
        $categoryType = $this->Category_GetTypeByTargetType($oBehavior->getCategoryTargetType());

        $aCategories = $this->Category_LoadTreeOfCategory(array('type_id' => $categoryType->getId()));

        $this->Viewer_Assign('aCategories', $aCategories );


        $this->SetTemplate('component@fend:category.input');
    }
}
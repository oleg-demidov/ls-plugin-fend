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
class PluginFend_BlockCategoryFilter extends Block
{
    /**
     * Запуск обработки
     */
    public function Exec()
    {
        
        $sEntity = $this->GetParam('entity');
        $oTarget = $this->GetParam('target');
        $sTargetType = $this->GetParam('target_type');
        $aCategory = $this->GetParam('category');

        if (!$oTarget) {
            $oTarget = Engine::GetEntity($sEntity);
        }      
        
        $aBehaviors = $oTarget->GetBehaviors();
        foreach ($aBehaviors as $oBehavior) {
            if ($oBehavior instanceof ModuleCategory_BehaviorEntity) {
                if ($oBehavior->getParam('target_type') != $sTargetType) {
                    continue;
                }
                
                $this->Viewer_Assign('category', $aCategory);

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


                $this->SetTemplate('component@fend:category.filter');
                break;
            }
        }
        
        
    }
}
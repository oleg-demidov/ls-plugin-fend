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
        $oBehavior = $this->GetParam('behavior');
        
        /**
         * Нужное нам поведение - получаем список текущих категорий
         */
        $this->Viewer_Assign('categoriesSelected', $oBehavior->getCategories(), true);
        /**
         * Загружаем параметры
         */
        $aParams = $oBehavior->getParams();
        $this->Viewer_Assign('params', array_merge($aParams, $this->GetParam('params', [])), true);
        /**
         * Загружаем список доступных категорий
         */
        
        $categoryType = $this->
        $aCategories = $this->Category_GetCategoryItemsByFilter(
                
                $oBehavior->getCategoryTargetType()
                );

        $this->Viewer_Assign('categories', $aCategories , true);


        $this->SetTemplate('component@fend:category.input');
    }
}
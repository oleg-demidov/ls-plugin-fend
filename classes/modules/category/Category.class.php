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
 * Модуль управления универсальными категориями
 *
 * @package application.modules.category
 * @since 2.0
 */
class PluginFend_ModuleCategory extends PluginFend__Inherits_ModuleCategory
{
    protected $aBehaviors = [
        'seo' => [
            'class' => 'PluginSeo_ModuleSeo_BehaviorModule',
            'target_type' => 'category_seo'
        ]
    ];

}
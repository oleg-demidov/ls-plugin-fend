/**
 * Media
 *
 * @module ls/uploader
 *
 * @license   GNU General Public License, version 2
 * @copyright 2013 OOO "ЛС-СОФТ" {@link http://livestreetcms.com}
 * @author    Oleg Demidov
 */

(function($) {
    "use strict";

    $.widget( "livestreet.fendCategory", $.livestreet.lsComponent, {
        /**
         * Дефолтные опции
         */
        options: {
            // Ссылки
            urls: {
                
               
            },
            
            // Селекторы
            selectors: {
                
                branch:     '[data-category-branch]'
                
            },
            // Классы
            classes: {
                
                
            },
            
            multiple: true,
            
            countAllowBranch:1,
            

            i18n: {
                countAllow: "@plugin.fend.category.msg.allow_count_branch"
            },

            // Доп-ые параметры передаваемые в аякс запросах
            params: {}
            

        },

        /**
         * Конструктор
         *
         * @constructor
         * @private
         */
        _create: function () {
            this._super();
            
            this.elements.branch.fendCategoryBranch();
            
            this._on(this.elements.branch, {change: 'change'});
            
            this.elements.branch.fendCategoryBranch('calcBadge');
            
        },
                
        change: function(eventBranch){
            let target = eventBranch.originalEvent.target;

            if(this.getActiveBranch().length > this.option('countAllowBranch')){
                $(target).prop('checked', false);
                this.elements.branch.fendCategoryBranch('calcBadge');
                ls.msg.error(this._i18n('countAllow', {count: this.option('countAllowBranch')}));
            }
        },
        
        getActiveBranch: function(){
            return this.elements.branch.filter(function(i, el){
                return $(el).fendCategoryBranch('isActive');
            })
        }
        
    });
})(jQuery);
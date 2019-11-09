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
            
            countAllowBranch:3,
            

            i18n: {
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
            
            this.elements.branch.on( 'onchange', this.change.bind(this));
            
            this.elements.branch.fendCategoryBranch('calcBadge');
            
        },
                
        change: function(e, event){
            console.log(event)
            console.log(this.getActiveBranch().length)
            event.stopPropagation()
        },
        
        getActiveBranch: function(){
            return this.elements.branch.filter(function(i, el){
                return $(el).fendCategoryBranch('isActive');
            })
        }
        
    });
})(jQuery);
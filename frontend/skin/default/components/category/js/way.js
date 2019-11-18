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

    $.widget( "livestreet.fendCategoryWay", $.livestreet.lsComponent, {
        /**
         * Дефолтные опции
         */
        options: {
            // Ссылки
            urls: {
                
               
            },
            
            // Селекторы
            selectors: {
                badge:              '[data-badge]',
                checkboxes:         'input[type="checkbox"]'
                
            },
            // Классы
            classes: {
                
                
            },
            
            multiple: true,
            

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
            
            this._on(this.elements.checkboxes, {change: 'change'});
        },
        
        change: function(event)
        {
            this._trigger('change', event);
        },
        
        getActiveCheckboxes: function(){
            return this.elements.checkboxes.filter(function(i, el){
                return el.checked;
            });
        },
        
        isActive: function(){
            return (this.getActiveCheckboxes().length > 0);
        }
        
    });
})(jQuery);
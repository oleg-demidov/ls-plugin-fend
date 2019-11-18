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

    $.widget( "livestreet.fendCategoryBranch", $.livestreet.lsComponent, {
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
                ways:               '[data-category-way]'
            },
            // Классы
            classes: {
                
                
            },
            
            multiple: true,
            countAllowWay:3,
            

            i18n: {
                countAllowWay: null
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
                        
            this.elements.ways.fendCategoryWay({
                change:this.change.bind(this)
            });
            
        },
        
        change: function(event){

            this._trigger('change', event);
            
            let target = event.currentTarget;
            
            if(this.getActiveWays().length > this.option('countAllowWay')){
                $(target).prop('checked', false);
                ls.msg.error(this._i18n('countAllowWay', {count: this.option('countAllowWay')}));
                return false;
            }
            
            this.calcBadge();
        },
        
        calcBadge: function(){
            let aActiveCheckboxes = this.getActiveCheckboxes();
            
            this.elements.badge.text(aActiveCheckboxes.length);
            
            if(aActiveCheckboxes.length > 0){
                this.elements.badge.show();
            }else{
                this.elements.badge.hide();
            }
        },
        
        getActiveCheckboxes: function(){
            let $checkboxes = $();
            
            $.each(this.elements.ways, function(i, way){
                $checkboxes = $checkboxes.add( $(way).fendCategoryWay('getActiveCheckboxes') );
            });
            
            return $checkboxes;
        },
        
        isActive: function(){
            return (this.getActiveCheckboxes().length > 0);
        },
        
        getActiveWays: function()
        {
            return this.elements.ways.filter(function(i, el){
                return $(el).fendCategoryWay('isActive');
            })
        }
        
    });
})(jQuery);
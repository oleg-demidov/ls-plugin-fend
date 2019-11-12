/**
 * Category filter
 *
 * @module ls/uploader
 *
 * @license   GNU General Public License, version 2
 * @copyright 2013 OOO "ЛС-СОФТ" {@link http://livestreetcms.com}
 * @author    Oleg Demidov
 */

(function($) {
    "use strict";

    $.widget( "livestreet.fendCategoryFilter", $.livestreet.lsComponent, {
        /**
         * Дефолтные опции
         */
        options: {
            
            // Селекторы
            selectors: {
                input:         '[data-category-input]',
                links:         '[data-category-link]',
                value:         '[data-category-value]',
                clear:         '[data-btn-clear]'
            }
           

        },

        /**
         * Конструктор
         *
         * @constructor
         * @private
         */
        _create: function () {
            this._super();
            
            this._on(this.elements.links, {click: 'change'});
            this._on(this.elements.clear, {click: 'clear'});
            
            if(this.elements.input.val()){
                this.elements.clear.removeClass('d-none');
            }
        },
        
        change: function(event)
        {
            this.elements.input
                    .val($(event.target).data('title'))
                    .change();
            this.elements.value
                    .val($(event.target).data('id'))
                    .removeAttr('disabled').change();

            this.elements.clear.removeClass('d-none');
        },
        
        clear: function(event){
            this.elements.value.val('').change();
            this.elements.input.val('').change();
            this.elements.clear.addClass('d-none');
        }
        
    });
})(jQuery);
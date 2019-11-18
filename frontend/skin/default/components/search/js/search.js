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

    $.widget( "livestreet.fendSearch", $.livestreet.lsComponent, {
        /**
         * Дефолтные опции
         */
        options: {
            // Ссылки
            urls: {
                count: aRouter.people + 'count'               
            },
            
            // Селекторы
            selectors: {
                text:              '[data-text-input]',
                geo:               '[data-city] input',
                category:          '[data-category-input]',
                count:             '[data-count-find]',
                countWrapper:      '[data-count-wrapper]',
                results:           '@[data-people-results]'
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
            
            this.elements.geo = $(this.option('selectors.geo'));
            
            this._on(this.elements.text, {keyup: "change"});
            this._on(this.elements.geo, {change: "change"});
            this._on(this.elements.category, {change: "change"});
            
            this.mark();
            
            this.elements.results.fendResults();
        },
        
        mark: function(){
            $.each(this.elements, function(key, $el){
                if($el.val()){
                    $el.addClass('border-warning');
                }else{
                    $el.removeClass('border-warning');
                }
            })
        },
        
        change: function(event){
            this.mark();
            setTimeout(this.getCount.bind(this), 200);
        },
        
        getCount: function(){
            this._submit('count', this.element, function(response){
                if(response.count > 0){ 
                    this.elements.countWrapper.find('.btn').removeClass('d-none');
                }else{
                    this.elements.countWrapper.find('.btn').addClass('d-none');
                }
                this.elements.countWrapper.addClass('d-flex');
                this.elements.count.text(response.count)
            }, {showProgress:false, lock:false})
        }
        
       
    });
})(jQuery);
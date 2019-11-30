/**
 *
 * @license   GNU General Public License, version 2
 * @copyright 2013 OOO "ЛС-СОФТ" {@link http://livestreetcms.com}
 * @author    Oleg Demidov
 */

(function($) {
    "use strict";

    $.widget( "livestreet.fendResults", $.livestreet.lsComponent, {
        /**
         * Дефолтные опции
         */
        options: {
            // Ссылки
            urls: {
                load: aRouter.people + 'ajax-load'               
            },
            
            // Селекторы
            selectors: {
                pagination:           '[data-people-pagination]'
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
                        
            this.initPagination();
            
        },
        
        goPage: function(event, url){
            
            this._load('load', { url: url}, function(result){
                this.element.html(result.html);
                
                $(".rateYo", this.element).each(function (i, rateYo) {
                    let $rateYo = $(rateYo);
                    let rating = $rateYo.data('value');
                    rating = rating && rating.replace(",", ".");

                    $rateYo.rateYo({
                        rating: rating,
                        starWidth: $rateYo.data('starWidth') + "px",
                        normalFill: "#A0A0A0",
                        ratedFill: "#ffc107",
                        readOnly: true,
                        spacing: $rateYo.data('spacing') + "px",
                    });
                })
                
                this.initPagination();
            }.bind(this))
        },
                
        initPagination: function(){
            $(this.option('selectors.pagination')).bsPagination({
                goPage: this.goPage.bind(this)
            });
        }
       
    });
})(jQuery);
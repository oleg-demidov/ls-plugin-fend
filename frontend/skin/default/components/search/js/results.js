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
                load: aRouter.people.replace('people', 'people/') + 'ajax-load'               
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

            this.option('urls.load', url.replace('people', 'people/ajax-load'));
            
            this._load('load', {}, function(result){
                this.element.html(result.html);
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
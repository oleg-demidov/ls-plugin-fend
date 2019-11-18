
jQuery(document).ready(function($){
    $('[data-category]').fendCategory({
        countAllowBranch: ls.registry.get('countAllowBranch'),
        countAllowWay   : ls.registry.get('countAllowWay')
    });

    $('[data-category-filter]').fendCategoryFilter();
    
    $('[data-city]').lsAutocomplete({
        noResultsText:ls.lang.get('plugin.geo.no_results_text')
    });
    
    $('[data-search-form]').fendSearch();
});


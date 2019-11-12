
jQuery(document).ready(function($){
    $('[data-category]').fendCategory({
        countAllowBranch: ls.registry.get('countAllowBranch')
    });

    $('[data-category-filter]').fendCategoryFilter();
    
    $('[data-city]').lsAutocomplete({
        noResultsText:ls.lang.get('plugin.geo.no_results_text')
    });
    
    $('[data-search-form]').fendSearch();
});


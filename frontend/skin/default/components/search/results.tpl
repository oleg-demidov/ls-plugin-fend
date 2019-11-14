<div class="mt-5">
    {foreach $aUsers as $oUser}
        {component "fend:search.item" oUser=$oUser}
    {/foreach}

    {if !$aUsers}
        {component "blankslate" text=$aLang.search.people.blankslate.text}
    {/if}

</div>
{component 'bs-pagination' 
    attributes  = [ "data-people-pagination" => true]
    total       = $aPaging['iCountPage'] 
    padding     = 2
    showPager   = true
    classes     = "mt-3"
    current     = $aPaging['iCurrentPage']  
    url         = "{$aPaging['sBaseUrl']}{$aPaging['sGetParams']}&page=__page__" }
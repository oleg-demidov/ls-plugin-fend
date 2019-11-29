<div class="mt-5">
    
    <div class="row d-xl-flex d-none pb-3">
        <div class="col-3">
            <strong>Имя, логин</strong>
        </div>
        <div class="col-3">
            <strong>Рейтинг</strong>
        </div>
        <div class="col-2">
            <strong>Город</strong>
        </div>
        <div class="col-4">
            <strong>Деятельность, услуги, навыки</strong>
        </div>
    </div>
    {foreach $aUsers as $oUser}
        {component "fend:search.item" oUser=$oUser}
    {/foreach}

    {if !$aUsers}
        {component "blankslate" text=$aLang.plugin.fend.search.blankslate}
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
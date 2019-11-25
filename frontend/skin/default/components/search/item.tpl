

{component_define_params params=[ 'oUser', 'url' , 'classes']}

<div class="row align-items-center">
    <div class="col-xl-3 col-sm-6 col-8">
        <div class="media {$classes}">
            <img style="width:50px;" class="mr-3 rounded-circle" src="{$oUser->getProfileAvatar()}" alt="{$oUser->getLogin()}">
            <div class="media-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <u><a href="{$url|default:$oUser->getProfileUrl()}" >{$oUser->getLogin()}</a></u><br>
                        <span class="text-truncate">{$oUser->getName()}</span>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-4 align-self-start align-self-xl-center">
        {$fRating = $oUser->getRating()}
        {$iRated = $oUser->getCountRated()}

        <div class="row" {if $textColor}style="color:{$textColor}!important;"{/if}>
            <div class=" align-self-end d-none d-sm-block"><strong>{$fRating}</strong> из 5</div>
            <div class="px-2">
                {component "rating.stars" value=$oUser->getRating()}
            </div>
            <div class="align-self-end  d-none d-sm-block" style="line-height: 1.4rem;">
                {$iRated} {pluralize {lang "user.profile.counts.responses"} count=$iRated}
            </div>
        </div>
    </div>
    <div class="col-xl-2  col-4 text-success pl-xl-3 pl-4 pt-2">
        {if $oUser->geo->city()}
            {$oUser->geo->city()->getName()}
        {else}
            Город не выбран
        {/if}
    </div>
    <div class="col-xl-4 col-8">
        {if $oUser->isRole('user')}
            {$sRole = 'people'}
        {else}
            {$sRole = 'company'}
        {/if}

        
        {foreach $oUser->getCats() as $category name="cats"}
            {if $smarty.foreach.cats.iteration > Config::Get('plugin.fend.count_categories_item')}
                {break}
            {/if}
            {if in_array($category->getId(), $aCategoryRootIds)}
                {$categoryLevel = 0}
            {/if}
            
            {if in_array($category->getPid(), $aCategoryRootIds)}
                {$categoryLevel = 1}
            {/if}
            
            {component "bs-button" 
                classes     = "bg-category-level{$categoryLevel} ml-1"
                text        = $category->getTitle()
                url         = {router page="{$sRole}/all-city/{$category->getUrlFull()}"}
            }
        {/foreach}
    </div>
</div>
<hr>
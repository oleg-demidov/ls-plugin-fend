    
{foreach $aProperties as $property}
    {if !$property->getValue()->getValueForDisplay()}
        {continue}
    {/if}
    {if $property->getCode() == "site"}
        {$site = $property->getValue()->getValueForDisplay()}
        {continue}
    {/if}
    <div class="mr-3 ">
        <a class="link" href="{$property->getValue()->getValueForDisplay()}">
            {component "bs-icon" icon=$property->getParam('icon')}
        </a>
    </div>
{/foreach}

{if $site} 
    <div class="mr-3 ">
        <a class="link text-muted" href="{$site}">
            {component "bs-icon" icon="link:s"} {$site}
        </a>
    </div>
{/if}



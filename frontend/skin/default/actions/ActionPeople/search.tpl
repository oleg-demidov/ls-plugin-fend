{**
 * Главная
 *}
{extends 'layouts/layout.base.tpl'}

{block 'layout_page_title' }
    {$aLang.plugin.fend.search.title.{$sRole}}
{/block}

{block 'layout_content'}
    <div data-people-results>
        {component "fend:search.results"}
    </div>
{/block}
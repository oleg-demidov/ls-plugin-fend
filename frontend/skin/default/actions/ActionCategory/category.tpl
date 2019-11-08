{**
 * Настройка категорий
 *}
{extends 'layouts/layout.base.tpl'}

{block 'layout_page_title'}
    <h2>
        {$aLang.plugin.fend.category.title}
    </h2>
{/block}

{block 'layout_content'}
    
   
        {insert name="block" block="fieldCategory" params=[
            plugin   => 'fend',
            user     => $userProfile
        ]}
    
{/block}



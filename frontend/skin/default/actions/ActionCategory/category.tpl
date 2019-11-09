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
    
    <form method="POST">
        {insert name="block" block="fieldCategory" params=[
            plugin   => 'fend',
            user     => $userProfile
        ]}
        
        {component "bs-button"
            type    = "submit"
            bmods   = "primary"
            classes = "mt-2"
            text    = {lang "common.save"}
        }
    </form>
{/block}



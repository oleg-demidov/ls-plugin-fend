
{extends "component@bs-form.field"}

{block name="field_options"}
    {component_define_params params=['categories']}
    {$label = "Категория"}
{/block}  

{block name="field_input"}
    {foreach $categories as $category}
        {$category.entity->getTitle()}
    {/foreach}

        
{/block}

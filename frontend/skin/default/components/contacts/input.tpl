
{extends "component@bs-form.field"}

{block name="field_options"}
    {$label = "Контакты"}
{/block}  

{block name="field_input"}
    {insert name='block' block='propertyUpdate' params=[
        'plugin'      => 'property',
        'target'      => $oUser,
        'entity'      => 'ModuleUser_EntityUser',
        'target_type' => "contacts"
    ]}
        
{/block}

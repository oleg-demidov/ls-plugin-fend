 

{$itemsAccordeon = []}

{foreach $aCategories as $category}
    {capture name="item_content"}
        <div class="d-flex">
            {foreach $category->getChildren() as $categoryChild1}
                <div>
                    <strong>
                        {$categoryChild1->getTitle()}
                    </strong>
                    <div class="ml-2 mt-2">
                        {foreach $categoryChild1->getChildren() as $categoryChild2}
                            {component "bs-form.checkbox" 
                                custom = true
                                classesGroup = "custom-checkbox" 
                                label   = $categoryChild2->getTitle()}
                            
                        {/foreach}
                    </div>
                </div>
            {/foreach}

        </div> 
    {/capture}

    {$itemsAccordeon[] = [
        classes => "p-1",
        text => "{$category->getTitle()}{component 'bs-badge' classes='ml-1' bmods='primary' text=2}",
        content => $smarty.capture.item_content 
    ]}
{/foreach}

{component "bs-collapse.accordion" items=$itemsAccordeon}

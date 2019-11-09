 
{$itemsAccordeon = []}

{foreach $aCategories as $category}
    {capture name="item_content"}
        <div class="d-flex">
            {foreach $category->getChildren() as $categoryChild1}
                <div class="p-2">
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
        classesHeader => "p-1",
        attributes => ['data-category-branch' => true],
        text => "{$category->getTitle()}{component 'bs-badge' attributes=['data-badge'=>true] classes='ml-1' bmods='primary' text=''}",
        content => $smarty.capture.item_content 
    ]}
{/foreach}

{component "bs-collapse.accordion" attributes=['data-category'=>true] items=$itemsAccordeon}

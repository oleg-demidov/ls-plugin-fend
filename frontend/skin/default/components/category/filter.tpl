 
<div data-category-filter>
    {if $category}
        {$value = $category->getTitle()}
        {$id = $category->getId()}
    {/if}
    
    {component "bs-form.text"
        placeholder = {lang "plugin.fend.search.form.category.placeholder"}
        attributes  = [
            'data-toggle' => "modal",
            'data-target' => "#categoryModal",
            'data-category-input' => true
        ]
        value       = $value
        clear       = true
    }
    
    
    
    <input type="hidden" {if !$id}disabled{/if} name="category" data-category-value value="{$id}">

    {capture name="accordion"}

        <div class="accordion" id="accordion1">
            <ul class="list-group list-group-flush">
                {foreach $aCategories as $category}
                    <li class="list-group-item pl-1 bg-secondary d-flex justify-content-between">
                        <button class="btn btn-link text-white btn-arrow collapsed" type="button" data-toggle="collapse" data-target="#collapse{$category->getId()}" aria-expanded="true" aria-controls="collapse{$category->getId()}">
                            <strong>{$category->getTitle()}</strong>
                            {component "bs-icon" classes="ml-2" icon="chevron-right:s"}
                            {component "bs-icon" classes="ml-2" icon="chevron-down:s"}
                        </button>
                        
                        <button class="btn btn-link " type="button" aria-label="Close" data-dismiss="modal" data-category-link data-id="{$category->getId()}" data-title="{$category->getTitle()}" aria-expanded="true">
                            Все
                            {component "bs-icon" classes="ml-2" icon="angle-double-right:s"}
                        </button>
                    </li>
                    <li id="collapse{$category->getId()}" class="list-group-item collapse  p-0" aria-labelledby="headingOne" data-parent="#accordion1">
                        <ul class="accordion list-group"  id="accordion2">
                            {foreach  $category->getChildren() as $categoryChild1}
                                <li class="list-group-item pl-4 bg-light d-flex justify-content-between">
                                    <button class="btn btn-link  text-dark btn-arrow collapsed" type="button" data-toggle="collapse" data-target="#collapse{$categoryChild1->getId()}" aria-expanded="true" aria-controls="collapse{$categoryChild1->getId()}">
                                        {$categoryChild1->getTitle()}
                                        {component "bs-icon" classes="ml-2" icon="chevron-right:s"}
                                        {component "bs-icon" classes="ml-2" icon="chevron-down:s"}
                                    </button>
                                    
                                    <button class="btn btn-link" type="button" aria-label="Close" data-dismiss="modal" data-category-link data-id="{$categoryChild1->getId()}" data-title="{$categoryChild1->getTitle()}" aria-expanded="true">
                                        Все
                                        {component "bs-icon" classes="ml-2" icon="angle-double-right:s"}
                                    </button>
                                </li>
                                <li id="collapse{$categoryChild1->getId()}" class="list-group-item collapse  pl-4 p-0" aria-labelledby="headingOne" data-parent="#accordion2">
                                    <ul class="list-group p-0 border-left">
                                        {foreach $categoryChild1->getChildren() as $categoryChild2}

                                            <li class="list-group-item pl-3">
                                                <button class="btn btn-link" type="button" aria-label="Close" data-dismiss="modal" data-category-link data-id="{$categoryChild2->getId()}" data-title="{$categoryChild2->getTitle()}" aria-expanded="true">
                                                    {$categoryChild2->getTitle()}
                                                    {component "bs-icon" classes="ml-2" icon="angle-double-right:s"}
                                                </button>
                                            </li>
                                        {/foreach}

                                    </ul>
                                </li>
                            {/foreach}
                        </ul>
                    </li>

                {/foreach}
            </ul>
        </div>

    {/capture}

    <div class="modal fade" tabindex="-1" id='categoryModal' role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{lang "plugin.fend.search.form.category.modal_title"}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          {$smarty.capture.accordion}

        </div>
      </div>
    </div>
      
</div>

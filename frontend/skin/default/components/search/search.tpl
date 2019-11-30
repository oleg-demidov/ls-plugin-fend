 
<form method='get' action="/{$sAction}/submit" data-search-form>
    <div class="row">
        <div class="col-md-4">
            {component "bs-form.text"
                placeholder = "Содержит текст"
                attributes  = ['data-text-input' => true]
                name        = "text"
                value       = $sText
            }
        </div>
        <div class="col-md-4">
            {insert 'block' block='geo' params = [
                geo      => $city,
                'plugin' => 'geo',
                'entity' => 'User_User',
                'label'  => '',
                placeholder => {lang "plugin.fend.search.form.geo.placeholder"}
            ]}
        </div>
        <div class="col-md-4">
            {insert 'block' block='categoryFilter' params = [
                category    => $category,
                plugin      => 'fend',
                entity      => 'User_User',
                target_type => "{$sRole}_category"                
            ]}
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="sort">
                      {component "bs-icon" icon='sort-amount-down:s'}
                  </label>
                </div>
                <select data-sort class="custom-select" id="sort" name="order">
                    <option value="rating" {if $order == 'rating'}selected{/if}>По рейтингу</option>
                  <option value="responses" {if $order == 'responses'}selected{/if}>По количеству отзывов</option>
                </select>
            </div>
        </div>
        <div class="d-flex">
            <div data-count-wrapper class="pr-3 {if !$count}d-none{/if} align-self-center">Найдено 
                <strong data-count-find  class="pl-1">{$count}</strong>
            </div> 
            <div>
                {component "bs-button" 
                    type    = "submit"
                    bmods   = "primary" 
                    text    = {lang 'plugin.fend.search.form.submit.text'}}
            </div>
        </div>
        
    </div>
            
    <input type="hidden" name="role" value="{$sRole}">
</form>
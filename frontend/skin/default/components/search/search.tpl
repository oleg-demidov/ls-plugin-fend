 
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
    <div data-count-wrapper class="d-none justify-content-end">
        <div class="d-flex align-items-center">
            <div class="pr-3">Найдено 
                <strong data-count-find></strong>
            </div> 
            {component "bs-button" 
                type    = "submit"
                bmods   = "primary" 
                classes = "d-none"
                text    = {lang 'plugin.fend.search.form.submit.text'}}
        </div>
        
    </div>
            
    <input type="hidden" name="role" value="{$sRole}">
</form>
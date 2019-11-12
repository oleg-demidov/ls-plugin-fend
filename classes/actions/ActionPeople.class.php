<?php


class PluginFend_ActionPeople extends Action
{

    protected $sMenuHeadItemSelect = 'people';

    /**
     * Инициализация
     *
     */
    public function Init()
    {
        $this->SetDefaultEvent('');
    }

    /**
     * Регистрация евентов
     *
     */
    protected function RegisterEvent()
    { 
        $this->AddEventPreg('/^count?$/i', 'EventAjaxCount');
        
        $this->AddEventPreg( '/^submit$/i', 'EventSubmit');
        
        $this->AddEventPreg( 
            '/^([\w-]{3,100})?$/i', 
            '/^([\w-]{3,100})?$/i', 
            '/^([\w-]{3,100})?$/i', 
            '/^([\w-]{3,100})?$/i', 
            ['EventSearch' , 'people']
        );
        
    }

    public function EventSubmit() {

        $sUrlRedirect = $this->sCurrentAction . '/';
        
        $this->Logger_Notice(print_r($_REQUEST, true));
        
        if($city = $this->PluginGeo_Geo_GetCityById(getRequest('geo')['city'])){
            $sUrlRedirect .= $city->getCode();
        }else{
            $sUrlRedirect .= 'all-city';
        }
        
        if(getRequest('category')){
            $category = $this->Category_GetCategoryById(getRequest('category'));
            $sUrlRedirect .= '/' . $category->getUrlFull();
        }
        
        $aQueryParams = [];
        
        if(getRequest('text')) $aQueryParams['text'] = getRequest('text');
        if(getRequest('page')) $aQueryParams['page'] = getRequest('page');
        
        if ($aQueryParams) {
            $sUrlRedirect .= '?' . http_build_query($aQueryParams);
        }
        
        Router::LocationAction($sUrlRedirect);
    }

    public function EventSearch() {
        
        if($this->sCurrentAction == 'people'){
            $sRole = "user";
        }else{
            $sRole = 'company';
        }
        
        $iLimit = Config::Get('module.user.search.per_page');
                
        $iPage = getRequest('page');
        $iPage = $iPage?$iPage:1;
        
        $aFilter = [
            '#index-from'   => 'id',
            '#page'         => [$iPage, $iLimit],
            '#with'         => ["#{$sRole}_category", '#geo'],
            'activate'      => 1,
            'role'          => $sRole
        ];
                
        $sCodeCity = $this->sCurrentEvent;
        
        if($city = $this->PluginGeo_Geo_GetCityByCode($sCodeCity)){
            $aFilter['#geo'] = ['city' => $city->getId()];
            $this->Viewer_Assign('city', $city);
        }
        
        if($this->GetParam(0)){
            $sUrl = join('/', $this->GetParams());
            
            $category = $this->Category_GetCategoryByUrlFull($sUrl);
            
            $aFilter["#{$sRole}_category"] = [$category->getId()];
            
            $this->Viewer_Assign('category', $category);
            
        }
        
        if(getRequest('text')){
            $aFilter['#where'] = [
                '(t.login LIKE ? OR t.mail LIKE ? OR t.about LIKE ? OR t.name LIKE ?)' => [
                    '%'.getRequest('text').'%',
                    '%'.getRequest('text').'%',
                    '%'.getRequest('text').'%',
                    '%'.getRequest('text').'%'
                ]
            ];
            
            $this->Viewer_Assign('sText', getRequest('text'));
        }
        
        $aUsers = $this->User_GetUserItemsByFilter($aFilter);
                
        $aPaging = $this->Viewer_MakePaging(
                $aUsers['count'], 
                $iPage, $iLimit, 
                Config::Get('module.user.search.pagination.pages_count'), 
                Router::GetPath('people'),
                ['q' => 1]);

        $this->Viewer_Assign('sRole', $sRole);
        $this->Viewer_Assign('aPaging', $aPaging);
        $this->Viewer_Assign('aUsers', $aUsers['collection']);
        $this->Viewer_Assign('count', $aUsers['count']);
        $this->SetTemplateAction('search');
    }

    public function EventAjaxCount() {
        $this->Viewer_SetResponseAjax('json');
        
        $aFilter = [
            'activate'      => 1,
            'role'          => getRequest('role')
        ];
        
        if(getRequest('text')){
            $aFilter['#where'] = [
                '(t.login LIKE ? OR t.mail LIKE ? OR t.about LIKE ? OR t.name LIKE ?)' => [
                    '%'.getRequest('text').'%',
                    '%'.getRequest('text').'%',
                    '%'.getRequest('text').'%',
                    '%'.getRequest('text').'%'
                ]
            ];
        }
        
        if(getRequest('geo') and getRequest('geo')['city']){
            $aFilter['#geo'] = getRequest('geo');
        }
        
        if(getRequest('category')){
            $aFilter['#' . getRequest('role') . '_category'] = [getRequest('category')];
        }
        
        $iCount = $this->User_GetCountFromUserByFilter($aFilter);
        
        $this->Viewer_AssignAjax('count', $iCount);
    }
          
}
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
        $this->AddEventPreg('/^count$/i', 'EventAjaxCount');
        
        $this->AddEventPreg( '/^submit$/i', 'EventSubmit');
        
        $this->AddEventPreg( '/^ajax-load$/i', 'EventAjaxLoad');
        
        $this->AddEventPreg( 
            '/^([\w-]{1,100})?$/i', 
            '/^([\w-]{1,100})?$/i', 
            '/^([\w-]{1,100})?$/i', 
            '/^([\w-]{1,100})?$/i', 
            ['EventSearch' , 'people']
        );
        
    }

    public function EventSubmit() {

        $sUrlRedirect = $this->sCurrentAction . '/';
        
        if($city = $this->PluginGeo_Geo_GetCityById(getRequest('geo')['city'])){
            $sUrlRedirect .= $city->getCode();
        }

        if($category = $this->Category_GetCategoryById(getRequest('category'))){
            if (!$city) {
                $sUrlRedirect .= 'all-city';
            }
            $sUrlRedirect .= '/' . $category->getUrlFull();
        }
        
        $aQueryParams = [];
        
        if(getRequest('text')) $aQueryParams['text'] = getRequest('text');
        if(getRequest('page')) $aQueryParams['page'] = getRequest('page');
        if(getRequest('order')) $aQueryParams['order'] = getRequest('order');
        
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
        
        $iLimit = Config::Get('plugin.fend.search.per_page');
                
        $iPage = getRequest('page');
        $iPage = $iPage?$iPage:1;
        
        $aQueryParams = [];
        
        $aFilter = [
            '#index-from'   => 'id',
            '#page'         => [$iPage, $iLimit],
            '#with'         => ["#{$sRole}_category", '#geo'],
            'activate'      => 1,
            'role'          => $sRole
        ];
        
        if(getRequest('order') == 'responses'){
            $aFilter['#order'] = [
                'res.rescount' => 'desc'
            ];
            $aQueryParams['order'] = 'responses';
        }else{
            $aFilter['#order'] = [
                'vote.rating' => 'desc'
            ];
            $aQueryParams['order'] = 'rating';
        }  
        
        $sCodeCity = $this->sCurrentEvent;
        
        $city = $this->PluginGeo_Geo_GetCityByFilter([
            'code' => $sCodeCity
        ]);
                
        if($city)
        {
            $aFilter['#geo'] = ['city' => $city->getId()];
            $this->Viewer_Assign('city', $city);
            $this->PluginSeo_Seo_SetVar('city' , $city->getName());
            
        }elseif($sCodeCity != 'all-city' and $sCodeCity != '')
        {
            $this->PluginSeo_Seo_SetVar('city' , $this->Lang_Get('plugin.fend.search.all_city'));
            Router::LocationAction($this->sCurrentAction);
        }
        
        if($this->GetParam(0)){
            $sUrl = join('/', $this->GetParams());
            
            $category = $this->Category_GetCategoryByFilter([
                'url_full'  => $sUrl,
                '#with'     => ['#seo']
            ]);
            
            $aFilter["#{$sRole}_category"] = [$category->getId()];
            
            $this->Viewer_Assign('category', $category);
            
        }
        
        if(getRequest('text'))
        {
            $aFilter['#query'] = getRequest('text');
            
            $this->Viewer_Assign('sText', getRequest('text'));
        }
                
        $aUsers = $this->User_GetUserItemsByFilter($aFilter);       
        
                
        $aPaging = $this->Viewer_MakePaging(
                $aUsers['count'], 
                $iPage, $iLimit, 
                Config::Get('plugin.fend.search.pagination.pages_count'), 
                Router::GetPathWebCurrent(),
                $aQueryParams);
        
        $aCategoryRoot = $this->Category_GetCategoryItemsByFilter([
            'pid' => null,
            '#index-from' => 'id'
        ]);
        
        $this->Viewer_Assign('aCategoryRootIds', array_keys($aCategoryRoot));
        $this->Viewer_Assign('sRole', $sRole);
        $this->Viewer_Assign('aPaging', $aPaging);
        $this->Viewer_Assign('aUsers', $aUsers['collection']);
        $this->Viewer_Assign('count', $aUsers['count']);
        $this->Viewer_Assign('order', getRequest('order'));
        $this->SetTemplateAction('search');
        $this->Viewer_SetHtmlCanonical(Router::GetPathWebCurrent(), true);
        
        $this->Menu_Get('main')->setActiveItem($this->sCurrentAction);
    }

    public function EventAjaxCount() {
        $this->Viewer_SetResponseAjax('json');
        
        $aFilter = [
            'activate'      => 1,
            'role'          => getRequest('role')
        ];
        
        if(getRequest('text'))
        {
            $aFilter['#query'] = getRequest('text');
        }
        
        if(getRequest('geo') and getRequest('geo')['city']){
            $aFilter['#geo'] = getRequest('geo');
        }
        
        if(getRequest('category')){
            $aFilter['#' . getRequest('role') . '_category'] = [getRequest('category')];
        }
        
        $iCount = $this->User_GetCountFromUsers($aFilter);
        
        $this->Viewer_AssignAjax('count', $iCount);
    }
    
    public function EventAjaxLoad() {
        $this->Viewer_SetResponseAjax('json');
                
        $aFilter = [
            '#index-from'   => 'id',
            '#with'         => ['#geo'],
            'activate'      => 1,
        ];
        
        $aUrl = parse_url(getRequest('url'));
        
        if(!$aUrl['host']){
            return false;
        }
                
        $aRequestUrl =  explode('/', trim($aUrl['path'], '/'));

        if(!isset($aRequestUrl[0])){
            return false;
        }        
        
        if(array_shift($aRequestUrl) == 'people'){
            $aFilter['role'] = "user";
            
        }else{
            $aFilter['role'] = 'company';
        }
        
        $aFilter['#with'][] = "#{$aFilter['role']}_category";
        
        $sCodeCity = isset($aRequestUrl[0]) ? array_shift($aRequestUrl) : '';
        
        $city = $this->PluginGeo_Geo_GetCityByFilter([
            'code' => $sCodeCity
        ]);
                
        if($city)
        {
            $aFilter['#geo'] = ['city' => $city->getId()];
            
        }
        
        if(isset($aRequestUrl[0])){
            
            $category = $this->Category_GetCategoryByFilter([
                'url_full'  => join('/', $aRequestUrl)
            ]);
            
            $aFilter["#{$aFilter['role']}_category"] = [$category->getId()];
            
        }
        
        $aRequestQuery = [];
        
        parse_str($aUrl['query'], $aRequestQuery);
        
        if(array_key_exists('text', $aRequestQuery))
        {
            $aFilter['#query'] = $aRequestQuery['text'];
        }
        
        if(array_key_exists('page', $aRequestQuery))
        {
            $aFilter['#page'][] = $aRequestQuery['page'];
        }else{
            $aFilter['#page'][] = 1;
        }
        
        $aFilter['#page'][] = Config::Get('plugin.fend.search.per_page');
        
        unset($aRequestQuery['page']);
                
        $aUsers = $this->User_GetUserItemsByFilter($aFilter);
                
        $aPaging = $this->Viewer_MakePaging(
                $aUsers['count'], 
                $aFilter['#page'][0], $aFilter['#page'][1], 
                Config::Get('plugin.fend.search.pagination.pages_count'), 
                $aUrl['scheme'] . '://' . $aUrl['host'] . '/' . $aUrl['path'],
                $aRequestQuery);

        $viewer = $this->Viewer_GetLocalViewer();
        $viewer->Assign('aPaging', $aPaging);
        $viewer->Assign('aUsers', $aUsers['collection']);
        $viewer->Assign('count', $aUsers['count']);
        
        $this->Viewer_AssignAjax('html', $viewer->Fetch('component@fend:search.results'));
        
    }
    
    protected function getByFilter($param) {
        
    }
    
          
}
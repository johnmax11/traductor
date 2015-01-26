<?php
namespace admin\linguists;
class UsersRegisteredController extends \BaseController {

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function index()
    {
        /**verificamos session*/
        if(\utilidades::verifySessionRol(__NAMESPACE__) != null){
            return \utilidades::verifySessionRol(__NAMESPACE__);
        }
        
        return \View::make("admin/linguists/usersregistered");
    }
    
    public function loadUserByType(){
        try{
            $objFacUsers = new \facUsers();
            $arrDUsers = $objFacUsers->getUsers(array(
                'security_roles_id||=||'.\Input::get('typeUser'),
                'active||=||Y'
            ));
            
            $page = \Input::get('page');
            $limit = \Input::get('rows');
            $count = count($arrDUsers); 
            if( $count >0 ) { 
                $total_pages = ceil($count/$limit);
            } else {
                $total_pages = 0;
            } 
            if ($page > $total_pages){
                $page=$total_pages; 
            }
            $start = $limit*$page - $limit; 
            if($start<0){
                $start = 0;
            }
            
            /* do not put $limit*($page - 1)*/
            $response = new \stdClass();
            $response->error = false;
            $response->page = $page; 
            $response->total = $total_pages; 
            $response->records = $count;
            
            /**query datos con limites**/
            $arrDUsers = $objFacUsers->getUsers(array(
                    'security_roles_id||=||'.\Input::get('typeUser'),
                    'active||=||Y'
                ),
                null,
                array(\Input::get('sidx').'||'.\Input::get('sord')),
                array($start,$limit)
            );
            
            if(count($arrDUsers)>0){
                $i=0;
                for($i=0;$i<count($arrDUsers);$i++){

                    $response->rows[$i]['id']=$arrDUsers[$i]->id;
                    $response->rows[$i]['cell']=array(
                        $arrDUsers[$i]->id,
                        $arrDUsers[$i]->email
                    );
                }
            }
            $response->error = false;
            return \Response::json($response);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}

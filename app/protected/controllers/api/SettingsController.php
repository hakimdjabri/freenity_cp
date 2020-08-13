<?php
class SettingsController extends BaseController
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array(
                    'search',
                    'role',
                  ),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    public function actionRole($id)
    {
        $request = $this->getRequest();
        User::change($id,$request);
        return $this->success([]);
    }
    public function actionSearch()
    {
        $request = $this->getRequest();
        $limit = isset($request['limit'])?$request['limit']:100;
        $offset = isset($request['offset'])?$request['offset']:0;
        $order = isset($request['order'])?$request['order']:'updated_at DESC';
        $query_from = isset($request['query'])?$request['query']:[];
        $query = [];
        foreach($query_from as $array)
        {
            // if($array[0] == 'status' && $array[1] == 2)
            //     return $this->success(['count'=>0,'pagination'=>[],'users'=>[]]);
            if($array[0] == 'name')
            {
                $or = [];
                $or[] = ['name','%'.strtolower($array[1]).'%','like'];
                $or[] = ['login','%'.strtolower($array[1]).'%','like'];
                $or[] = ['email','%'.strtolower($array[1]).'%','like'];
                if(is_numeric($array[1]))
                    $or[] = ['id',$array[1],'='];
                $query[] = ['or',$or];
            }
            elseif($array[0] == 'role' && $array[1] != '0')
                $query[] = [$array[0],$array[1],'='];
        }
        $query[] = ['limit',$limit];
        $query[] = ['offset',$offset];
        $query[] = ['order',$order];
        $users = User::all($query);
        $count = User::model()->_count($query);
        $pagination = Pagination::model()->getPages($count,$limit,$offset);
        return $this->success(['query'=>$query,'count'=>$count,'pagination'=>$pagination,'users'=>$users]);
    }
}


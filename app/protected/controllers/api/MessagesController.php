<?php
class MessagesController extends BaseController
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array(
                    'search',
                    'deleted'
                  ),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    public function actionDeleted($id)
    {
        return $this->success(['id'=>$id]);
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
            if($array[0] == 'name')
            {
                $or = [];
                $or[] = ['title','%'.strtolower($array[1]).'%','like'];
                $or[] = ['description','%'.strtolower($array[1]).'%','like'];
                $or[] = ['comment','%'.strtolower($array[1]).'%','like'];
                if(is_numeric($array[1]))
                    $or[] = ['id',$array[1],'='];
                $query[] = ['or',$or];
            }
        }
        $query[] = ['limit',$limit];
        $query[] = ['offset',$offset];
        $query[] = ['order',$order];
        $messages = Message::all($query);
        $count = Message::model()->_count($query);
        $pagination = Pagination::model()->getPages($count,$limit,$offset);
        return $this->success(['count'=>$count,'pagination'=>$pagination,'messages'=>$messages]);
    }
}

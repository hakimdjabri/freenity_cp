<?php
class Message extends BaseModel
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'messages';
    }
    public function getID(){ return 'id'; }
    public function row()
    {
        return [//type,select,insert,update,where
            'id'=>['int',1,0,0,1],
            'user_id'=>['int',1,0,0,1],
            'title'=>['string',1,0,0,1],
            'description'=>['string',1,0,0,1],
            'comment'=>['string',1,0,0,1],
            'files'=>['string',1,0,0,1],
            'site_name'=>['string',1,0,0,1],
            'author'=>['string',1,0,0,1],
            'views'=>['string',1,0,0,1],
            'color'=>['string',1,0,0,1],
            'topic'=>['string',1,0,0,1],
            'url'=>['string',1,0,0,1],
            'date'=>['string',1,0,0,1],
            'uniqid'=>['string',1,0,0,1],
            'created_at'=>['string',1,0,0,1],
            'updated_at'=>['string',1,0,0,1],
          ];
    }
    function modelDetail($model)
    {
        $model['author'] = User::view($model['user_id']);
        $date = explode(' ',$model['created_at']);
        $model['created'] = $date[0];
        $model['created_time'] = $date[1];
        $time = explode(':',$date[1]);
        $model['created_line'] = $date[0].', '.$time[0].':'.$time[1];
        return $model;
    }
}

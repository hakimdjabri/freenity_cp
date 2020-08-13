<?php
class Settings extends BaseModel
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'settings';
    }
    public function getID(){ return 'id'; }
    public function row()
    {
        return [//type,select,insert,update,where
            'id'=>['int',1,0,0,1],
            'title'=>['string',1,0,0,1],
            'header'=>['string',1,0,0,1],
            'logo'=>['string',1,0,0,1],
			'background'=>['string',1,0,0,1],
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

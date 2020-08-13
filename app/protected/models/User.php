<?php
class User extends BaseModel
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'users';
    }
    public function getID(){ return 'id'; }
    public function row()
    {
        return [//type,select,insert,update,where
            'id'=>['int',1,0,0,1],
            'name'=>['string',1,0,0,1],
            'login'=>['string',1,0,0,1],
            'email'=>['string',1,0,0,1],
            'password'=>['string',1,0,0,0],
            'role'=>['string',1,0,1,1],
            'remember_token'=>['string',1,0,0,0],
            'created_at'=>['string',1,0,0,1],
            'updated_at'=>['string',1,0,0,1],
          ];
    }
    function modelDetail($model)
    {
        $date = explode(' ',$model['created_at']);
        $model['created'] = $date[0];
        $model['created_time'] = $date[1];
        $time = explode(':',$date[1]);
        $model['created_line'] = $date[0].', '.$time[0].':'.$time[1];
        return $model;
    }
}

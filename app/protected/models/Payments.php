<?php
class Payments extends BaseModel
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'payments';
    }
    public function getID(){ return 'id'; }
    public function row()
    {
        return [//type,select,insert,update,where
            'id'=>['int',1,0,0,1],
            'title'=>['string',1,0,0,1]
          ];
    }
    function modelDetail($model)
    {
        return $model;
    }
}

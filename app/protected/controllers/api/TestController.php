<?php
class TestController extends BaseController
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
                    'view',
                  ),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    public function actionView()
    {
        $connection = Yii::app()->db;//get connection
        $dbSchema = $connection->schema;
        //or $connection->getSchema();
        $tables = $dbSchema->getTables();//returns array of tbl schema's
        foreach($tables as $tbl)
        {
            echo $tbl->rawName, ':<br/>', implode(', ', $tbl->columnNames), '<br/>';
        }
    }
}

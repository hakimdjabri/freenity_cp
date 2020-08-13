<?php
class BaseModel extends CActiveRecord
{
    const TYPE_KEY = 0;
    const SELECT_KEY = 1;
    const INSERT_KEY = 2;
    const UPDATE_KEY = 3;
    const WHERE_KEY = 4;
    //Def.Functions
    public function existence($id)
    {
        $className = get_called_class();
        return $className::model()->view($id,$className::getID().' id') ? true : false;
    }
    static function find_change($id,$request)
    {
        $className = get_called_class();
        return $className::model()->_find_change([$className::getID(),$id],$request);
    }
    static function change($id,$request)
    {
        $className = get_called_class();
        $update = $className::defRow($className::UPDATE_KEY,$className);
        foreach($request as $row=>$value)
            $update[$row] = $value;
        return $className::model()->_change([$className::getID(),$id], $update);
    }
    static function add($request)
    {
        $className = get_called_class();
        $insert = $className::defRow($className::INSERT_KEY,$className);
        foreach($request as $row=>$value)
            $insert[$row] = $value;
        return $className::model()->_add($insert);
    }
    static function all($body = [],$select = null)
    {
        $className = get_called_class();
        $models = $className::model()->_all($body,$select);
        foreach($models as $key=>$model)
            $models[$key] = $select !== null ? $model:$className::model()->modelDetail($model);
        return $models;
    }
    static function _find($body = [],$select = null)
    {
        $className = get_called_class();
        $model = $className::model()->__find($body,$select);
        return $select !== null || !$model ? $model:$className::model()->modelDetail($model);
    }
    static function view($id,$select = null)
    {
        $className = get_called_class();
        $model = $className::model()->_view([$className::getID(),$id],$select);
        return $select !== null || !$model ? $model:$className::model()->modelDetail($model);
    }
    static function remove($id)
    {
        $className = get_called_class();
        return $className::model()->_remove([$className::getID(),$id]);
    }
    function modelDetail($model)
    {
        return $model;
    }
    //Compatibility
    public function typification($model)
    {
        $rows = $this->typeRow();
        foreach($rows as $row=>$key)
        {
            if($key == 'int' && isset($model[$row]))
                $model[$row] = (int)$model[$row];
            elseif($key == 'float' && isset($model[$row]))
                $model[$row] = (float)$model[$row];
            elseif($key == 'bool' && isset($model[$row]))
                $model[$row] = (bool)$model[$row];
        }
        return $model;
    }
    public function parseRequest($request = [], $rows = [], $exact = false)
    {
        $answer = [];
        foreach($rows as $key=>$row)
        {
            if(isset($request[$key]) && $row)
                $answer[$key] = $request[$key];
            elseif(isset($request[$key]))
                continue;
            elseif(is_array($row) && isset($request[$row[0]]))
                $answer[$row[1]] = $request[$row[0]];
            elseif(is_array($row))
                continue;
            elseif(isset($request[$row]))
                $answer[$row] = $request[$row];
        }
        return $answer;
    }
    function parseSelect($rows = [])
    {
        $select = '';
        if(!$rows)
            $rows = $this->selectRow();
        foreach($rows as $row)
        {
            $select .= !$select ? '' : ', ';
            $select .= is_array($row) ? $this->tableName().'.'.$row[0].' '.$row[1] : $this->tableName().'.'.$row;
        }
        return $select;
    }
    function toSQL($body)
    {
        $where = '';
        $params = array();
        $limit = 100;
        $offset = 0;
        $order = false;
        $rows = $this->whereRow();
        $rows = $this->valueToKey($rows);
        $operators = $this->operators();
        $operators = $this->valueToKey($operators);
        foreach($body as $key=>$param)
        {
            if(count($param) == 2 && strtoupper($param[0]) !== "OR")
            {
                ${$param[0]} = $param[1];
                continue;
            }
            elseif(strtoupper($param[0]) == "OR")
            {
                $where .= !$where ? '' : ' AND ';
                $where .= '( ';
                $newwhere = '';
                foreach($param[1] as $orkey=>$or)
                {
                    if(!isset($rows[$or[0]]))
                        continue;
                    if(!isset($operators[$or[2]]))
                        continue;
                    if(strtoupper($or[2]) == 'IN')
                    {
                        if(!isset($rows[$or[0]]))
                            continue;
                        $newwhere .= !$newwhere ? '' : ' OR ';
                        $newwhere .= '`'.$rows[$or[0]].'` '.$or[2].' ('.implode(',',$or[1]).')';
                        continue;
                    }
                    $newwhere .= !$newwhere ? '' : ' OR ';
                    $newwhere .= ''.$rows[$or[0]].' '.$or[2].' :'.$or[0].$key.$orkey;
                    $params[$or[0].$key.$orkey] = $or[1];
                }
                $where .= $newwhere.') ';
                continue;
            }
            elseif(strtoupper($param[2]) == 'IN')
            {
                if(!isset($rows[$param[0]]))
                    continue;
                $where .= !$where ? '' : ' AND ';
                $where .= '`'.$rows[$param[0]].'` '.$param[2].' ('.implode(',',$param[1]).')';
                continue;
            }
            elseif(strtoupper($param[2]) == 'NOT IN')
            {
                if(!isset($rows[$param[0]]))
                    continue;
                $where .= !$where ? '' : ' AND ';
                $where .= '`'.$rows[$param[0]].'` '.$param[2].' ('.implode(',',$param[1]).')';
                continue;
            }
            if(!isset($rows[$param[0]]))
                continue;
            if(!isset($operators[$param[2]]))
                continue;
            $where .= !$where ? '' : ' AND ';
            $where .= ''.$rows[$param[0]].' '.$param[2].' :'.$param[0].$key;
            $params[$param[0].$key] = $param[1];
        }
        return [$where,$params,$limit,$offset,$order];
    }
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $len =strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $len - 1)];
        }
        return $randomString;
    }
    function operators()
    {
        return ['=','!=','>','<','>=','<=','like','in','not in'];
    }
    //Generation rows list
    function whereRow()
    {
        return $this->otherRow(self::WHERE_KEY);
    }
    function selectRow()
    {
        return $this->otherRow(self::SELECT_KEY);
    }
    function updateRow()
    {
        return $this->otherRow(self::UPDATE_KEY);
    }
    function addRow()
    {
        return $this->otherRow(self::INSERT_KEY);
    }
    function typeRow()
    {
        $rows = $this->row();
        $type_rows = [];
        foreach($rows as $key=>$row)
        {
            if($row[self::TYPE_KEY] !== 0 && $row[self::SELECT_KEY] == 1)
                $type_rows[$key] = $row[self::TYPE_KEY];
            elseif($row[self::TYPE_KEY] !== 0 && $row[self::SELECT_KEY] !== 0)
                $type_rows[$row[self::SELECT_KEY]] = $row[self::TYPE_KEY];
        }
        return $type_rows;
    }
    function otherRow($position)
    {
        $rows = $this->row();
        $answer_row = [];
        foreach($rows as $key=>$row)
        {
            if(is_array($row[$position]))
                $row[$position] = $row[$position][0];
            if($row[$position] == 1)
                $answer_row[] = $key;
            elseif($row[$position] !== 0)
                $answer_row[] = [$key,$row[$position]];
        }
        return $answer_row;
    }
    function defRow($position,$className=__CLASS__)
    {
      $rows = $className::row();
      $answer_row = [];
      foreach($rows as $key=>$row)
      {
          if(is_array($row[$position]))
              $answer_row[$key] = $row[$position][1];
      }
      return $answer_row;
    }
    public function valueToKey($rows)
    {
        $array = [];
        foreach($rows as $row)
        {
            if(is_array($row))
                $array[$row[0]] = $row[1];
            else
                $array[$row]=$row;
        }
        return $array;
    }
    //BaseModel Realise
    function _sql($body = [])
    {
        $body[] = ['deleted',1,'!='];
        list($where,$params,$limit,$offset,$order) = $this->toSQL($body);
        $command = $this->_command('*');
        $command->where($where,$params);
        if($limit)
            $command->limit($limit);
        if($offset)
            $command->offset($offset);
        if($order)
           $command->order($order);
        $sql = $command->text;
        return $sql;
    }
    function _count($body = [])
    {
        $body[] = ['deleted',1,'!='];
        list($where,$params) = $this->toSQL($body);
        $command = $this->_command('count(*) count');
        $command->where($where,$params);
        $count = $command->queryRow();
        return !$count ? 0 : (int)$count['count'];
    }
    function _all($body = [],$select = null)
    {
        $select = !$select ? $this->parseSelect() : $select;
        $body[] = ['deleted',1,'!='];
        list($where,$params,$limit,$offset,$order) = $this->toSQL($body);
        $command = $this->_command($select);
        $command->where($where,$params);
        if($limit)
            $command->limit($limit);
        if($offset)
            $command->offset($offset);
        if($order)
            $command->order($order);
        $models = $command->queryAll();
        foreach($models as $key => $model)
            $models[$key] = $this->typification($model);
        return !$models ? [] : $models;
    }
    function _view($key,$select = null)
    {
        $select = !$select ? $this->parseSelect() : $select;
        $body = [];
        list($where,$params) = $this->toSQL($body);
        $where = $where?$where.' AND '.$key[0].' = :id':$key[0].' = :id';
        $params['id'] = $key[1];
        $command = $this->_command($select);
        $model = $command->where($where,$params)
                    ->queryRow();
        $model = $this->typification($model);
        return !$model ? null : $model;
    }
    function __find($body = [],$select = null)
    {
        $select = !$select ? $this->parseSelect() : $select;
        $body[] = ['deleted',1,'!='];
        list($where,$params,$limit,$offset,$order) = $this->toSQL($body);
        $command = $this->_command($select);
        $command->where($where,$params);
        if($order)
           $command->order($order);
        $model = $command->queryRow();
        $model = $this->typification($model);
        return !$model ? null : $model;
    }
    function _add($request)
    {
        $data = $this->parseRequest($request, $this->addRow());
        Yii::app()->db->createCommand()->insert($this->tableName(),$data);
        return 0;//Yii::app()->db->lastInsertID;
    }
    function _change($key,$request)
    {
        if(!$request = $this->parseRequest($request,$this->updateRow()))
            return 0;
        return Yii::app()->db->createCommand()
                ->update($this->tableName(),$request,$key[0].' = :id',['id'=>$key[1]]);
    }
    function _find_change($key,$request)
    {
        if(!$request = $this->parseRequest($request,$this->updateRow()))
            return 0;
        $request = $this->typification($request);
        $select = '';
        foreach($request as $row_key=>$row)
        {
            if($select)
                $select .= ', ';
            $select .= $row_key;
        }
        $where = $key[0].' = :id';
        $params['id'] = $key[1];
        $command = $this->_command($select);
        $model = $command->where($where,$params)
                    ->queryRow();
        $model = $this->typification($model);
        foreach($model as $key=>$row)
            if($row == $request[$key])
              unset($request[$key]);
        return $request;
    }
    function _delete($key){return $this->_change($key, ['deleted'=>1,'updated_at'=>time()]);}
    function _remove($key)
    {
        return Yii::app()->db->createCommand()
            ->delete($this->tableName(),$key[0].' = :id',['id'=>$key[1]]);
    }
    function _command($select)
    {
        $command = Yii::app()->db->createCommand();
        $command->select($select);
        $command->from($this->tableName());
        return $command;
    }
}

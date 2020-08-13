<?php
class BaseController extends CController
{
    public $token;
    public $user = 0;
    public $code = 404;
    public $active_menu = 'orders';
    public $time_do = 0;
    public function failure($fields = [], $code = 500)
    {
        header('Content-Type: application/json');
        header('HTTP/1.0 '.$code.' Error');
        $arr = [  'status' => 'fail',
                  'code' => $code ];
        $this->code = $code;
        foreach ($fields as $key => $value)
            $arr[$key] = $value;
        if(isset(Yii::app()->params->log))
            $arr['log'] = Yii::app()->params->log;
        if(isset($arr['error']))
            $arr['error'] = Yii::t('error',$arr['error']);
        echo json_encode($arr);
        $this->time_do = microtime(true) - $this->time_do;
        $log = ['time' => $this->time_do];
        $log['action'] = Yii::app()->controller->id.'/'.Yii::app()->controller->action->id;
        //Log::add($log);
        return false;
    }
    public function success($fields = array())
    {
        header('Content-Type: application/json');
        $arr = [  'status' => 'success',
                  'code' => 200 ];
        $this->code = 200;
        foreach ($fields as $key => $value)
            $arr[$key] = $value;
        if(isset(Yii::app()->params->log))
            $arr['log'] = Yii::app()->params->log;
        echo json_encode($arr);
        $this->time_do = microtime(true) - $this->time_do;
        $log = ['time' => $this->time_do];
        $log['action'] = Yii::app()->controller->id.'/'.Yii::app()->controller->action->id;
        //Log::add($log);
        return true;
    }
    public function validate($request = [],$rows = [], $parent = '')
    {
        $parent .= $parent ? '->':'';
        foreach($rows as $key=>$row)
        {
            if(is_array($row))
            {
                $key = explode('|',$key);
                if(!isset($request[$key[0]]))
                    return $this->failure([
                                'error' => 'Missing '.$parent.$key[0].' param',
                                'param'=>$key[0]
                            ],422);
                if(!$this->validate($request[$key[0]],$row,$parent.$key[0]))
                    return false;
                continue;
            }
            $row = explode('|',$row);
            if(!isset($request[$row[0]]))
                return $this->failure([
                            'error' => 'Missing '.$parent.$row[0].' param',
                            'param'=>$row[0]
                        ],422);
            if(isset($row[1])
                    && $row[1] == 'required'
                    && !$request[$row[0]])
                return $this->failure([
                            'error' => 'Missing '.$parent.$row[0].' param',
                            'param'=>$row[0]
                        ],422);
            elseif(isset($row[1])
                    && $row[1] == 'array'
                    && !is_array($request[$row[0]]))
                return $this->failure([
                            'error' => 'Error '.$parent.$row[0].' param',
                            'param'=>$row[0]
                        ],422);
        }
        return true;
    }
    public function getRequest()
    {
        $arr = $this->getBody();
        if( count($_POST) > 0 )
            return $_POST;
        elseif( count($arr) > 0 )
            return $arr;
        elseif( count($_REQUEST) > 0)
            return $_REQUEST;
        elseif( count( $_GET ) > 0 )
            return $_GET;
        else
            return [];
    }
    function getToken($role = 'guest')
    {
        return 0;
        $token = $this->getBearerToken();
        if(!$token && isset($_GET['token']))
            $token = $_GET['token'];
        elseif(!$token && isset($_POST['token']))
            $token = $_POST['token'];
        elseif(!$token && isset($_REQUEST['token']))
            $token = $_REQUEST['token'];
        elseif(! Yii::app()->user->isGuest )
        {
            $token = Token::model()->_find([['uid',Yii::app()->user->id,'=']],'token');
            $token = $token['token'];
        }
        if(!$token)
            return $this->failure([
                        'error' => 'Missing "token" param'
                    ],434);
        $uid = Token::model()->_find([['token',$token,'=']],'uid,tid,language');
        $this->user = User::model()->_find([['uid',$uid['uid'],'=']],'uid,role,email');
        if(!$this->user)
            return $this->failure([
                        'error' => 'Invalid "token" param'
                    ],434);
        User::model()->change($uid['uid'],['last_visited'=>time()]);
        $this->user['token'] = $token;
        if($uid['language'] != Yii::app()->language)
            Token::change($uid['tid'],['language'=>Yii::app()->language]);
        $this->user['tid'] = $uid['tid'];
        if($this->user['role'] == 'provider')
        {
            $provider = Provider::model()->view($this->user['provider_id']);
            $this->user['first_name'] = $provider['name'];
        }
        // if($this->user['banned'] == 1 && Yii::app()->user->isGuest)
        //     return $this->failure([
        //                 'error' => 'This user banned'
        //             ],435);
        Yii::app()->params->user = $this->user;
        return true;//$this->role($role);
    }
    //protected
    protected function role($role)
    {
        $roles = Yii::app()->params->roles[Yii::app()->params->user['role']] & Yii::app()->params->masks[$role];
        if($roles !== Yii::app()->params->masks[$role])
            return $this->failure([
                        'error' => 'Access Denied'
                    ],434);
        return true;
    }
    public function __construct($id,$module=null)
    {
        parent::__construct($id,$module);
        $this->time_do = microtime(true);
        $params = explode('/',$_SERVER['REQUEST_URI']);
        //$headers = apache_request_headers();
        if(isset($_GET['language']) && ($_GET['language'] == 'ru' || $_GET['language'] == 'en' || $_GET['language'] == 'iw')) {
            Yii::app()->language = $_GET['language'];
            Yii::app()->user->setState('language', $_GET['language']);
            $cookie = new CHttpCookie('language', $_GET['language']);
            $cookie->expire = time() + (60*60*24*365); // (1 year)
            Yii::app()->request->cookies['language'] = $cookie;
            $href = str_replace('/'.$_GET['language'], '', $_SERVER['REQUEST_URI']);
            $this->redirect($href);
        }
        elseif( $params[1] == 'ru' || $params[1] == 'en' || $params[1] == 'iw')
        {
            Yii::app()->language = $params[1];
            Yii::app()->user->setState('language', $params[1]);
            $cookie = new CHttpCookie('language', $params[1]);
            $cookie->expire = time() + (60*60*24*365);
            Yii::app()->request->cookies['language'] = $cookie;
            $href = str_replace('/'.$params[1], '', $_SERVER['REQUEST_URI']);
            $this->redirect($href);
        }
        elseif (Yii::app()->user->hasState('language') && (Yii::app()->user->getState('language')  == 'en' || Yii::app()->user->getState('language') == 'ru' || Yii::app()->user->getState('language') == 'iw'))
            Yii::app()->language = Yii::app()->user->getState('language');
        elseif(isset(Yii::app()->request->cookies['language']) && (Yii::app()->request->cookies['language']->value == 'en' || Yii::app()->request->cookies['language']->value == 'ru' || Yii::app()->request->cookies['language']->value == 'iw'))
            Yii::app()->language = Yii::app()->request->cookies['language']->value;
        //elseif(isset($headers['Language']) && (trim($headers['Language']) == 'ru' || trim($headers['Language']) == 'en' || trim($headers['Language']) == 'iw'))
        //    Yii::app()->language = $headers['Language'];
        if(Yii::app()->language != 'en' && Yii::app()->language != 'ru' && Yii::app()->language != 'iw')
            Yii::app()->language = 'en';
    }
    protected function getBody()
    {
        $answer = array();
        $data = file_get_contents('php://input','r');
        $exploded = explode('&', $data);
        foreach($exploded as $pair) {
            $pair = str_replace(['%5B','%5D'],['[',']'],$pair);
            $mass = explode('[',html_entity_decode($pair));//html_entity_decode
            if(count($mass) == 1)
            {
                $item = explode('=', $pair);
                if(count($item) == 2)
                    $answer[urldecode($item[0])] = urldecode($item[1]);
            }
            elseif(count($mass) == 2)
            {
                $key = $mass[0];
                $mass[1] = str_replace(']', '', $mass[1]);
                $item = explode('=', $mass[1]);
                if(count($item) == 2) {
                    if($item[0])
                        $answer[urldecode($key)][urldecode($item[0])] = urldecode($item[1]);
                    else
                        $answer[urldecode($key)][] = urldecode($item[1]);
                }
            }
        }
        return $answer;
    }
    function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization']))
            $headers = trim($_SERVER["Authorization"]);
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization']))
                $headers = trim($requestHeaders['Authorization']);
        }
        return $headers;
    }
    function getBearerToken() {
        $headers = $this->getAuthorizationHeader();
        if (!empty($headers))
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches))
                return $matches[1];
        return null;
    }
    protected function readRole()
    {
        $step = 0;
        Yii::app()->params->nmasks = [];
        Yii::app()->params->nroles = [];
        foreach(Yii::app()->params->auth as $role=>$params)
        {
            Yii::app()->params->nmasks[$role] = floor(pow(2,$step));
            $step++;
        }
        foreach(Yii::app()->params->auth as $role=>$params)
        {
            Yii::app()->params->nroles[$role] = $this->getRole($role,$mask,Yii::app()->params->auth);
        }
    }
    function getRole($role,$mask,$roles)
        {
        $answer = $mask[$role];
        if(isset($roles[$role]['children']))
            foreach($roles[$role]['children'] as $children)
                $answer = $answer | $this->getRole($children,$mask,$roles);
        return $answer;
    }
    function escape_params($params)
    {
        foreach($params as $key=>$param)
        {
            if(is_array($param))
                $params[$key] = $this->escape_params($param);
            else
                $params[$key] = $this->escape_string($param);
        }
        return $params;
    }
    function escape_string($string)
    {
        return mysql_real_escape_string($string);
    }
}

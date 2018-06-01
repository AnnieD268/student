<?php
namespace core\model;

class Base{
//    定义pdo对象属性
    protected $pdo;
//    定义表名属性
    protected $table;
//    定义where条件属性
    protected static $where;
//    定义静态主键值属性
    protected static $pri;

    public function __construct($config,$table)
    {
//        将$table变成一个属性，为了后面其他方法使用
        $this -> table =$table;
//        自动调用链接数据库方法
        $this -> connect($config);
    }

//    链接数据库方法
    public function connect($config){
        if (is_null($this -> pdo)){
            $dsn = 'mysql:host='.$config['host'].';dbname='.$config['dbname'];
            try{
                $this -> pdo = new \PDO($dsn,$config['username'],$config['password']);
                $this -> pdo -> query('set names utf8');
            }catch (\PDOException $e){
                die($e -> getMessage());
            }

        }

    }

//    获取多条数据
    public function get(){

//        组合sql语句
        $sql = 'select * from '. $this -> table . self::$where;
//        通过pdo对象调用query方法获取多条数据
        $result = $this -> pdo -> query($sql);
        $data = $result -> fetchAll(\PDO::FETCH_ASSOC);
//        将当前$data数据存入当前对象的一个临时属性中
        $this -> data = $data;
//        返回当前对象
        return $this;
    }

//    获取单条数据
    public function find($pri){
//        获取调用表的主键名称
        $priKey = $this -> getPriKey();
//        组合sql语句
        $sql = 'select * from ' . $this -> table.' where '.$priKey.' = '.$pri;
//        调用where方法处理where属性
//        $this->where($priKey . ' = ' . $pri);
//
//        $sql = "select * from ".$this->table. self::$where;
//        通过pdo对象调用query方法获取多条数据
        $result = $this -> pdo -> query($sql);
        $data = $result -> fetch(\PDO::FETCH_ASSOC);
//        将当前$data数据存入当前对象的一个临时属性中
        $this->data = $data;
//        将查找的属性值存入当前属性
        self::$pri = $pri;
//        返回当前对象
        return $this;
    }

//    获取主键名称
    public function getPriKey(){
//        组合sql语句
        $sql = "desc " . $this->table;
        $result = $this->pdo->query($sql);
//        定义一个接收主键名称的变量
        $priKey = '';
//        循环$result,判断,如果$v里面的Key == PRI,就代表当前字段是主键
        foreach ($result as $k => $v) {
            if ($v['Key'] == 'PRI'){
                $priKey = $v['Field'];
                break;
            }
        }
//        将主键名称返回
        return $priKey;

    }

//    将对象数据转成数组
    public function toArray(){

        return $this -> data;

    }

//    组合where语句
    public function where($where){

        self::$where = " where " . $where;
//        返回自身
        return $this;

    }

//    添加数据方法
    public function add($data){
//        定义空字符串接收字段名
        $keyStr = '';
//        定义空字符串接收字段值
        $valueStr = '';
//        循环
        foreach ($data as $k => $v) {
            $keyStr .= $k . ',';
            $valueStr .= '"'. $v . '",';
        }
//        将最后的逗号去掉
        $keyStr = rtrim($keyStr,',');
        $valueStr = rtrim($valueStr,',');

//        组合sql语句
        $sql = 'insert into '.$this->table.' ('.$keyStr.') values ('.$valueStr.')';
//        用pdo对象调用exec方法来完成添加
        $data = $this -> pdo -> exec($sql);
//        返回$data
        return $data;
    }

//    编辑数据方法
    public function edit($data){
        //循环$data,组合sql语句中需要的字符串
        //定义一个空字符串
        $str = '';
        foreach ($data as $k => $v){
            $str .= $k . ' = "' . $v . '",';
        }
        $str = rtrim($str,',');
//        方法一
//        $sql = "update ".$this->table." set ".$str.self::$where;
//        方法二
//        获取主键名称
        $priKey = $this -> getPriKey();
        $sql = "update ".$this->table." set ".$str. " where ".$priKey." = " . self::$pri;
//        使用pdo对象调用exec方法来修改数据
        $data = $this -> pdo -> exec($sql);
//        返回$data
        return $data;
    }

//    删除方法
    public function delete($pri){
//        获取主键名称
        $priKey = $this -> getPriKey();
//        组合sql语句
        $sql = "delete from ".$this -> table." where ".$priKey." = ".$pri;
//        使用pdo对象调用exec方法来修改数据
        $data = $this -> pdo -> exec($sql);
//        返回$data
        return $data;
    }

//    多表查询
    public function query($sql){
//        用pdo对象调用PDO的query方法获取关联表的数据
        $result = $this -> pdo -> query($sql);
//        获取多条
        $data = $result -> fetchAll(\PDO::FETCH_ASSOC);
//        将data数据存入当前对象的临时属性中
        $this->data = $data;
//        返回当前
        return $this;
    }
}



?>
<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-5-5
 * Time: 下午1:46
 */

namespace Monkey\Model;


use Doctrine\DBAL\Cache\QueryCacheProfile;
use Doctrine\DBAL\DriverManager;
use Monkey\Container;

class BaseModel extends Container
{
    protected $db;

    protected $table;

    public function __construct()
    {
        parent::__construct();
        if ($this->isTest) {
            $connectionParams = array(
                'dbname' => env('MYSQL')['db_name_test'],
                'user' => env('MYSQL')['username'],
                'password' => env('MYSQL')['password'],
                'host' => env('MYSQL')['host'],
                'driver' => 'pdo_mysql',
            );
        } else {
            $connectionParams = array(
                'dbname' => env('MYSQL')['db_name'],
                'user' => env('MYSQL')['username'],
                'password' => env('MYSQL')['password'],
                'host' => env('MYSQL')['host'],
                'driver' => 'pdo_mysql',
            );
        }
        $this->db = DriverManager::getConnection($connectionParams, $this->config);
        $this->db->getConfiguration()->setResultCacheImpl($this->cache);
    }

    public function create($fields){
        $this->db->insert($this->table, $fields);
        $row = $this->getById($this->db->lastInsertId());
        return $row;
    }

    public function updateById($id, $fields){
        if ($this->db->update($this->table, $fields, ['id'=>$id])){
            $this->refreshRedis($id);
        }
        return $this->getById($id);
    }

    public function updateByWhere($where, $fields){
        $sql = "SELECT id FROM `{$this->table}` WHERE {$where}";
        $ids = $this->db->executeQuery($sql)->fetchAll();
        $affectedNum = 0;
        foreach ($ids as $id){
            $id = (int)$id['id'];
            if ($this->db->update($this->table, $fields, ['id'=>$id])){
                $this->refreshRedis($id);
                $affectedNum++;
                $this->getById($id);
            }
        }
        return $affectedNum;
    }

    public function getById($id){
        $lifetime = 3600 * 60 * 20;
        $id = (int)$id;
        $sql = "SELECT * FROM `{$this->table}` WHERE id = {$id}";
        $stmt = $this->db->executeCacheQuery($sql, [], [], new QueryCacheProfile($lifetime, $this->generateRedisId($id)));
        $data = $stmt->fetch();
        $stmt->closeCursor();
        return $data;
    }

    public function getByWhere($where, $param){
        $ids = $this->db->executeQuery("SELECT id FROM {$this->table} WHERE {$where}", $param);
//        $sql = "SELECT id FROM `{$this->table}` WHERE {$where}";
//        $ids = $this->db->executeQuery($sql);
        $data = [];
        foreach ($ids as $id){
            array_push($data, $this->getById($id['id']));
        }
        return $data;
    }

    public function select($sql, $id, $lifetime = 3600 * 60 * 20)
    {
        $cache = new QueryCacheProfile($lifetime, $this->generateRedisId($id));
        $stmt = $this->db->executeCacheQuery($sql, [], [], $cache);
        $data = $stmt->fetchAll();
        $stmt->closeCursor();
        return $data;
    }

    private function generateRedisId($id){
        return $this->table . ':' . $id;
    }

    private function refreshRedis($cacheId){
        if ($this->cache->contains($this->generateRedisId($cacheId))){
            $this->cache->delete($this->generateRedisId($cacheId));
        }
    }
}
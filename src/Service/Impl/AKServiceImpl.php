<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-28
 * Time: 上午9:17
 */

namespace Monkey\Service\Impl;

use Codeception\Util\Debug;
use Monkey\Model\Impl\AccessSecretKeyModelImpl;
use Monkey\Service\AKService;
use Monkey\Service\Service;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;

class AKServiceImpl extends Service implements AKService
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AccessSecretKeyModelImpl();
    }

    public function info(){
        $this->monolog->info(__FUNCTION__);
        return __FUNCTION__;
    }

    public function generate()
    {
        try {
            $accessKey = Uuid::uuid4();
            $secretKey = Uuid::uuid4();
        } catch (UnsatisfiedDependencyException $e){
            $message = $e->getMessage();
            $this->monolog->error($message, [__CLASS__, __FUNCTION__]);
            return [];
        }
        $accessKey = join('', explode('-', $accessKey->toString()));
        $secretKey = join('', explode('-', $secretKey->toString()));

        $model = new AccessSecretKeyModelImpl();
        return $model->create(['access_key' => $accessKey, 'secret_key' => $secretKey]);
    }

    public function sign($accessKey, $data, $time)
    {
        $ak = $this->model->getByWhere("access_key = ?", [$accessKey]);
        if (empty($ak)){
            throw new \Exception('not exist');
        }
        $secretKey = $ak[0]['secret_key'];
        $this->monolog->info(print_r($ak, true));
        $info = json_encode([
            'data' => $data,
            'time' => $time
        ], true);
        $sign = hash_hmac('sha256', $info, $secretKey);
        $this->cache->save("sign:{$accessKey}:secret_key", $secretKey);
        return $sign;
    }

    public function checkSign($accessKey, $data, $time, $originSign)
    {
        if ($this->cache->contains("sign:{$accessKey}:secret_key")){
            $secretKey = $this->cache->fetch("sign:{$accessKey}:secret_key");
            $info = [
                'data' => $data,
                'time' => $time,
            ];
            $sign = hash_hmac('sha256', json_encode($info), $secretKey);
            if ($originSign === $sign){
                return true;
            } else {
                $a = 'aaa';
            }
        }
        return false;
    }
}
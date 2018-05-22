<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-5-5
 * Time: 下午1:47
 */

namespace Monkey\Model\Impl;


use Monkey\Model\AccessSecretKeyModel;
use Monkey\Model\BaseModel;

class AccessSecretKeyModelImpl extends BaseModel implements AccessSecretKeyModel
{
    public function __construct()
    {
        $this->table = 'access_secret_key';
        parent::__construct();
    }

    public function create($fields)
    {
        $fields = array_merge($fields, ['created_time' => time(), 'updated_time' => time()]);
        return parent::create($fields);
    }
}
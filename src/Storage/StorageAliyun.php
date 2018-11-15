<?php
/**
 * Created by PhpStorm.
 * User: chenbotome@163.com
 * Date: 2018/10/16
 * Time: 11:59
 */

namespace Monkey\Storage;



use OSS\OssClient;

class StorageAliyun implements Storage
{
    private $dir;
    private $bucket;
    private $endpoint;
    private $accessTTL;
    private $accessKeyID;
    private $accessKeySecret;
    private $callbackUrl;
    static $aclDefault = 'default'; // 文件遵循存储空间的访问权限。
    static $aclPrivate = 'private'; // 文件的拥有者和授权用户有该文件的读写权限，其他用户没有权限操作该文件。
    static $aclPublicRead = 'public-read'; // 文件的拥有者和授权用户有该文件的读写权限，其他用户只有文件的读权限。请谨慎使用该权限。
    static $aclPrivateReadWrite = 'public-read-write'; // 所有用户都有该文件的读写权限。请谨慎使用该权限。

    public function __construct()
    {
        $this->accessKeyID     = env('aliyun')['access_key_id'];
        $this->accessKeySecret = env('aliyun')['access_key_secret'];
        $this->endpoint        = env('aliyun')['endpoint'];
        $this->bucket          = env('aliyun')['bucket'];
        $this->dir             = env('aliyun')['dir'];
        $this->accessTTL       = env('aliyun')['access_ttl'];
        $this->callbackUrl     = env('aliyun')['callback_url'];
    }

    public function uploadWithString($fileString, $name)
    {
        // TODO: Implement uploadWithString() method.
    }

    /**
     * 初始化上传文件的信息
     * @param null $dir 保存目录
     * @return array
     */
    public function init($dir = null){
        $dir = $dir ? $dir : $this->dir;
        list($expiration, $end) = $this->getExpirationAndEnd();
        $result                  = array();
        $result['dir']           = $dir;
        $result['host']          = "http://{$this->endpoint}";
        $result['policy']        = base64_encode(json_encode(array('expiration' => $expiration, 'conditions' => $this->getConditions($dir))));
        $result['expire']        = $end;
        $result['callback']      = $this->getCallback();
        $result['signature']     = base64_encode(hash_hmac('sha1', $result['policy'], $this->accessKeySecret, true));
        $result['access_key_id'] = $this->accessKeyID;
        return $result;
    }

    /**
     * 获取私有资源的访问路径
     * @param $filename
     * @param null $dir
     * @return string
     * @throws \OSS\Core\OssException
     */
    public function getAccessUrl($filename, $dir = null)
    {
        $dir       = $dir ? $dir : $this->dir;
        $ossClient = new OssClient($this->accessKeyID, $this->accessKeySecret, $this->endpoint);
        return $ossClient->signUrl($this->bucket, "$dir/$filename", $this->accessTTL);
    }

    /**
     * 私有化资源
     * @param $filename
     * @param null $dir
     * @return null
     * @throws \OSS\Core\OssException
     */
    public function protectFile($filename, $dir = null){
        $dir       = $dir ? $dir : $this->dir;
        $ossClient = new OssClient($this->accessKeyID, $this->accessKeySecret, $this->endpoint);
        return $ossClient->putObjectAcl($this->bucket, "$dir/$filename", self::$aclPrivate);
    }

    private function gmt_iso8601($time) {
        $dtStr      = date("c", $time);
        $dateTime   = new \DateTime($dtStr);
        $expiration = $dateTime->format(\DateTime::ISO8601);
        $pos        = strpos($expiration, '+');
        $expiration = substr($expiration, 0, $pos);
        return $expiration."Z";
    }

    /**
     * 获取回调地址
     * @return string
     */
    private function getCallback(){
        $callbackParam = array(
            'callbackUrl'      => $this->callbackUrl,
            'callbackBody'     => 'filename=${object}&size=${size}&mimeType=${mimeType}&height=${imageInfo.height}&width=${imageInfo.width}',
            'callbackBodyType' => "application/x-www-form-urlencoded"
        );
        return base64_encode(json_encode($callbackParam));
    }

    /**
     * 获取有效时间
     * @return array
     */
    private function getExpirationAndEnd(){
        $now = time();
        $expire = 30;  //设置该policy超时时间是10s. 即这个policy过了这个有效时间，将不能访问。
        $end = $now + $expire;
        return [$this->gmt_iso8601($end), $end];
    }

    /**
     * 上传条件
     * @param $dir
     * @return array
     */
    private function getConditions($dir){
        //fixme
        $condition = array('content-length-range', 0, 1048576000);
        $conditions[] = $condition;
        $start = array('starts-with', '$key', $dir);
        $conditions[] = $start;
        return $conditions;
    }
}
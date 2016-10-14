<?php
/**
 * 定义 RFS Adapter。
 *
 * @author    Yao <yaogaoyu@gmail.com>
 * @copyright © 2016 Szen.in
 * @license   LGPL-3.0+
 */

namespace Zen\Rfs;

/**
 * RFS 组件。
 * @package Szen\Rfs
 * @version 0.1.0
 * @since 0.1.0
 */
class Rfs extends Core\Component
{
    /**
     * 已注册的驱动列表。
     *
     * @var array[]
     */
    protected static $driverArr = array();

    /**
     * 注册驱动。

     * @throws ExRegisterFaild  当未指定驱动名或驱动类时
     * @throws ExDriverExists   当驱动已被注册时
     */
    public static function register($driverName, $driverClass) {
        if (empty($driverName) || empty($driverClass)) throw new ExRegisterFaild($driverName, $driverClass);
        if (!empty(self::$driverArr[$driverName])) throw new ExDriverExists($driverName);
        self::$driverArr[$driverName] = $driverClass;
    }

    /**
     * 加载的驱动名。
     *
     * @var string
     */
    protected $driverName;

    /**
     * 加载的驱动类实例。
     *
     * @var string
     */
    protected $driver;

    /**
     * Rfs配置项，留作扩展使用。
     *
     * @var array<string, string>
     */
    protected $option;

    /**
     * 连接状态。
     *
     * @var bool
     */
    protected $isOpen;

    /**
     * 构造函数
     * @param string    $dsn    数据库连接配置，由具体驱动定义规范
     * @param string    $user   可选。连接用户名
     * @param string    $pwd    可选。连接密码
     * @param array    $option  可选。Rfs配置项
     *
     * @throws Exception    当dsn未定义时抛出
     */
    __Constructor($dsn, $user='', $pwd='', $option=array()){
        $dsnSplits = explode(':', $dsn);
        if (2 > count($dsnSplits) || !$dsnSplits[0]) throw new ExDriverNameNotFound($driverName);
        $this->driverName = $dsnSplits[0];
        $this->option = $option;
        $this->isOpen = false;
        $this->driver = new self::$driverArr[$driverName]($dsnSplits[1], $user, $pwd);
    }

    /**
     * 打开远端连接。
     *
     * @return bool
     */
    protected function open() {
        if (!$this->isOpen) {
            $this->driver->open();
            $this->isOpen = true;
        }
        return $this;
    }

    /**
     * 重建远端连接。
     *
     */
    public function ping() {
        $this->open()->driver->ping();
    }

    /**
     * 关闭远端连接。
     *
     */
    public function close() {
        if ($this->isOpen) {
            $this->driver->close();
            $this->isOpen = false;
        }
    }

    /**
     * 根据相对路径获取远端URL。
     *
     * @param 远端文件路径
     * @return string   $path   远端URL
     */
    public function url($path) {
        $this->open()->driver->url($path);
    }

    /**
     * 将本地文件复制到远端。
     *
     * @param string   $local   本地文件路径
     * @param string   $path    远端文件路径
     *
     * @return string   远端URL
     */
    public function push($local, $path) {
        $this->open()->driver->push($local, $path);
    }

    /**
     * 将远端文件复制到本地。
     *
     * @param string   $path   远端文件路径
     * @param string   $local    本地文件路径
     */
    public function pull($path, $local) {
        $this->open()->driver->pull($path, $local);
    }

    /**
     * 删除远端文件。
     *
     * @param string  $path   远端文件路径
     */
    public function rm($path) {
        $this->open()->driver->rm($path);
    }
}

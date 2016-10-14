<?php
/**
 * 声明 RFS 驱动组件规范。
 *
 * @author    Yao <yaogaoyu@gmail.com>
 * @copyright © 2016 Szen.in
 * @license   LGPL-3.0+
 */

namespace Zen\Rfs;

/**
 * RFS 组件规范。
 *
 * @version 0.1.0
 *
 * @since 0.1.0
 */
interface IRfsDriver
{
    /**
     * 打开远端连接。
     *
     * @return bool
     */
    public function open();

    /**
     * 重建远端连接。
     *
     * @return bool
     */
    public function ping();

    /**
     * 关闭远端连接。
     *
     * @return bool
     */
    public function close();

    /**
     * 根据相对路径获取远端URL。
     *
     * @return string
     */
    public function url($path);

    /**
     * 将本地文件复制到远端。
     *
     * @return string 远端URL
     */
    public function push($local, $path);

    /**
     * 将远端文件复制到本地。
     *
     * @return bool
     */
    public function pull($path, $local);

    /**
     * 删除远端文件。
     *
     * @return bool
     */
    public function rm($path);
}

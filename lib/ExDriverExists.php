<?php
/**
 * 定义当驱动已注册时抛出地异常。
 *
 * @author    Yao <yaogaoyu@gmail.com>
 * @copyright © 2016 Szen.in
 * @license   GPL-3.0+
 * @license   CC-BY-NC-ND-3.0
 */

namespace Zen\Rfs;

use Zen\Core as ZenCore;

/**
 * 当驱动已注册时时抛出地异常。
 *
 * @version 2.0.0
 *
 * @since   2.0.0
 *
 * @method void __construct(string $driverName, \Exception $prev = null) 构造函数
 */
final class ExDriverExists extends ZenCore\Exception
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected static $template = '此驱动已被注册。"%driverName$s"。';

    /**
     * {@inheritdoc}
     *
     * @var string[]
     */
    protected static $contextSequence = array('driverName');
}

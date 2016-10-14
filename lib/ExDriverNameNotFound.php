<?php
/**
 * 定义当未指定驱动名时抛出地异常。
 *
 * @author    Yao <yaogaoyu@gmail.com>
 * @copyright © 2016 Szen.in
 * @license   GPL-3.0+
 * @license   CC-BY-NC-ND-3.0
 */

namespace Zen\Rfs;

use Zen\Core as ZenCore;

/**
 * 当未指定驱动名时抛出地异常。
 *
 * @version 2.0.0
 *
 * @since   2.0.0
 *
 * @method void __construct(string $driverName, \Exception $prev = null) 构造函数
 */
final class ExDriverNameNotFound extends ZenCore\Exception
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected static $template = '驱动名未指定。"%driverName$s"。';

    /**
     * {@inheritdoc}
     *
     * @var string[]
     */
    protected static $contextSequence = array('driverName');
}

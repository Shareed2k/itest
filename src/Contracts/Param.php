<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 13/08/18
 * Time: 11:31
 */

namespace Shareed2k\iTest\Contracts;

/**
 * Interface Param
 * @package Shareed2k\iTest\Contracts
 */
interface Param
{
    /**
     * @param array $items
     * @return mixed
     */
    public function fill(array $items);
}
<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 13/08/18
 * Time: 11:28
 */

namespace Shareed2k\iTest\Models\Params;


use Shareed2k\iTest\Contracts\Param;

/**
 * Class AbstractParam
 * @package Shareed2k\iTest\Models\Params
 */
abstract class AbstractParam implements Param
{
    public $testName;
    public $ani = 'xxxxxxxxxxx';
    public $codec = '729';
    public $testType = 0;

    /**
     * @param array $items
     */
    public function fill(array $items) {
        foreach ($items as $key => $item) {
            if (property_exists($this, $key))
                $this->$key = $item;
        }
    }
}
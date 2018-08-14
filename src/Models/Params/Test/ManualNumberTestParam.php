<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 13:34
 */

namespace Shareed2k\iTest\Models\Params\Test;

use Shareed2k\iTest\Models\Params\AbstractParam;

/**
 * Class ManualNumberTest
 * @package Shareed2k\iTest\Models\Test
 */
class ManualNumberTestParam extends AbstractParam
{
    public $profileId;
    public $prefix;
    public $supplierId;
    public $numbers = [];
}
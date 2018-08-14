<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 15:51
 */

namespace Shareed2k\iTest\Models\Params\Test;


use Shareed2k\iTest\Models\Params\AbstractParam;

class CliTestParam extends AbstractParam
{
    public $profileId;
    public $supplierId;
    public $countryId;
    public $breakoutId;

    /**
     *
     * Optional argument of ‘qty’ can be used to define the number of calls to initiate. The available options are
     * 1,5 and 10. Example ‘&qty=5’. The default is 10.
     *
     * @var int
     */
    public $qty = 10;
}
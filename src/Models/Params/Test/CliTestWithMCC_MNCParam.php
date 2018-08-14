<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 16:26
 */

namespace Shareed2k\iTest\Models\Params\Test;


use Shareed2k\iTest\Models\Params\AbstractParam;

class CliTestWithMCC_MNCParam extends AbstractParam
{
    public $profileId;
    public $supplierId;
    public $mccMnc;

    /**
     *
     * Optional argument of ‘qty’ can be used to define the number of calls to initiate. The available options are
     * 1,5 and 10. Example ‘&qty=5’. The default is 10.
     *
     * @var int
     */
    public $qty = 10;
}
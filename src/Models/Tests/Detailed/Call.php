<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 12/08/18
 * Time: 08:31
 */

namespace Shareed2k\iTest\Models\Tests\Detailed;

use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class Call
 * @package Shareed2k\iTest\Models\Tests\Detailed
 */
class Call implements XmlDeserializable
{
    /**
    <Call>
        <ID>2018080811000026444</ID>
        <Source>20900651427</Source>
        <Destination>021001972527642377</Destination>
        <Start>1533728732</Start>
        <End>1533728744.260229</End>
        <PDD>1.11693</PDD>
        <MOS>0</MOS>
        <Ring>10.1</Ring>
        <Call>NA</Call>
        <Last_Code>487 Request Terminated</Last_Code>
        <Result>No answer</Result>
        <Result_Code>3</Result_Code>
        <CLI></CLI>
        <FAS>0</FAS>
        <LD_FAS>0</LD_FAS>
        <Dead_Air>0</Dead_Air>
        <No_RBT>0</No_RBT>
        <Viber>0</Viber>
        <F-DLR>0</F-DLR>
    </Call>
     */

    public $id; // <ID> is the ID of the call
    public $source; // <Source> is the source number of the call
    public $destination; // <Destination > is the destination number of the call
    public $start; // <Start> is the start time of the call as an epoch
    public $end;
    public $pdd; // <PDD> is the PDD of the call
    public $mos; // <MOS> is the MOS score of the call
    public $ring; // <Ring> is the number of seconds the call rang for
    public $call; // <Call> is the number of seconds the call was connected
    public $lastCode; // <Last_Code> is the last significant SIP message received from the customer switch
    public $result; // <Result> is the overall result of the call
    public $resultCode; // <Result_Code> is the Result Code (See below for list of result codes)
    public $cli; //<CLI> is the CLI presented (if applicable)

    /**
     * <FAS>,<LD_FAS>,<Dead_Air>,<No_RBT>,<Viber> is ‘0’ = false or ‘1’ = true, as to whether this
     * was detected on this call
     */
    public $fas;
    public $ldFas;
    public $deadAir;
    public $noRBT;
    public $viber;
    public $fDLR;

    /**
     * Result Codes:
     * 0 = Processing
     * 1 = Call SUccess
     * 2 = Call Failure
     * 3 No Answer
     * 4 Internal Error
     * 5 Device Unreachable
     * 6 Analysis Incomplete
     * 7 CLI Success
     * 8 CLI Failure
     * 9 Terminated Elsewhere
     * 10 Awaiting CLI Result
     * 11 Client Phone Unavailable
     * 12 Call Cancelled
     * 13 Call Timeout
     */

    /**
     * @param Reader $reader
     * @return Call
     */
    static function xmlDeserialize(Reader $reader):Call {
        $call = new self();

        unset($reader->elementMap['{}Call']);

        // Borrowing a parser from the KeyValue class.
        $keyValue = KeyValue::xmlDeserialize($reader);

        if (isset($keyValue['{}ID'])) {
            $call->id = $keyValue['{}ID'];
        }
        if (isset($keyValue['{}Source'])) {
            $call->source = $keyValue['{}Source'];
        }
        if (isset($keyValue['{}Destination'])) {
            $call->destination = $keyValue['{}Destination'];
        }
        if (isset($keyValue['{}Start'])) {
            $call->start = $keyValue['{}Start'];
        }
        if (isset($keyValue['{}End'])) {
            $call->end = $keyValue['{}End'];
        }
        if (isset($keyValue['{}PDD'])) {
            $call->pdd = $keyValue['{}PDD'];
        }
        if (isset($keyValue['{}MOS'])) {
            $call->mos = $keyValue['{}MOS'];
        }
        if (isset($keyValue['{}Ring'])) {
            $call->ring = $keyValue['{}Ring'];
        }
        if (isset($keyValue['{}Call']) && $keyValue['{}Call']) {
            $call->call = $keyValue['{}Call'];
        }
        if (isset($keyValue['{}Last_Code'])) {
            $call->lastCode = $keyValue['{}Last_Code'];
        }
        if (isset($keyValue['{}Result'])) {
            $call->result = $keyValue['{}Result'];
        }
        if (isset($keyValue['{}Result_Code'])) {
            $call->resultCode = $keyValue['{}Result_Code'];
        }
        if (isset($keyValue['{}CLI'])) {
            $call->cli = $keyValue['{}CLI'];
        }
        if (isset($keyValue['{}FAS'])) {
            $call->fas = $keyValue['{}FAS'];
        }
        if (isset($keyValue['{}LD_FAS'])) {
            $call->ldFas = $keyValue['{}LD_FAS'];
        }
        if (isset($keyValue['{}Dead_Air'])) {
            $call->deadAir = $keyValue['{}Dead_Air'];
        }
        if (isset($keyValue['{}No_RBT'])) {
            $call->noRBT = $keyValue['{}No_RBT'];
        }
        if (isset($keyValue['{}Viber'])) {
            $call->viber = $keyValue['{}Viber'];
        }
        if (isset($keyValue['{}F-DLR'])) {
            $call->fDLR = $keyValue['{}F-DLR'];
        }

        return $call;
    }
}
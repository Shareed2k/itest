<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 16:53
 */

namespace Shareed2k\iTest\Models\Tests\Overview;


use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class Job
 * @package Shareed2k\iTest\Models\Tests\Overview
 */
class Job implements XmlDeserializable {

    /**
    <Job>
        <ID>454767603279</ID>
        <Init>15376892</Init>
        <Name>Test: 454767603279</Name>
        <InitBy>R K</InitBy>
        <Supplier></Supplier>
        <Type>0</Type>
        <t>1</t>
        <c>1</c>
        <s>0</s>
        <n>1</n>
        <f>0</f>
        <PDD>0.84</PDD>
    </Job>
     */

    public $id;
    public $init;//is the time the call was initiated as an EPOCH
    public $name;
    public $initBy;//is the name of the user who initiated the test
    public $supplier;
    public $type;
    public $totalCalls;
    public $completedCalls;
    public $successfulCalls;
    public $notAnsweredCalls;
    public $failedCalls;
    public $pdd; // all the combined calls

    /**
     * @param Reader $reader
     * @return Job
     */
    static function xmlDeserialize(Reader $reader):Job {
        $job = new self();

        // Borrowing a parser from the KeyValue class.
        $keyValue = KeyValue::xmlDeserialize($reader);

        if (isset($keyValue['{}ID'])) {
            $job->id = $keyValue['{}ID'];
        }
        if (isset($keyValue['{}Init'])) {
            $job->init = $keyValue['{}Init'];
        }
        if (isset($keyValue['{}Name'])) {
            $job->name = $keyValue['{}Name'];
        }
        if (isset($keyValue['{}InitBy'])) {
            $job->initBy = $keyValue['{}InitBy'];
        }
        if (isset($keyValue['{}Supplier'])) {
            $job->supplier = $keyValue['{}Supplier'];
        }
        if (isset($keyValue['{}Type'])) {
            $job->type = $keyValue['{}Type'];
        }
        if (isset($keyValue['{}t'])) {
            $job->totalCalls = $keyValue['{}t'];
        }
        if (isset($keyValue['{}c'])) {
            $job->completedCalls = $keyValue['{}c'];
        }
        if (isset($keyValue['{}s'])) {
            $job->successfulCalls = $keyValue['{}s'];
        }
        if (isset($keyValue['{}n'])) {
            $job->notAnsweredCalls = $keyValue['{}n'];
        }
        if (isset($keyValue['{}f'])) {
            $job->failedCalls = $keyValue['{}f'];
        }
        if (isset($keyValue['{}PDD'])) {
            $job->pdd = $keyValue['{}PDD'];
        }

        return $job;
    }
}
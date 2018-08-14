<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 11:26
 */

namespace Shareed2k\iTest\Models;

use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class NDBList
 * @package Shareed2k\iTest\Models
 */
class NDBList implements XmlDeserializable {

    /**
    <NDB_List>
        <Breakout>
            <Country_Name>COUNTRY 1</Country_Name>
            <Country_ID>COUNTRY ID</Country_ID>
            <Breakout_Name>BREAKOUT Name</Breakout_Name>
            <Breakout_ID>BREAKOUT ID</Breakout_ID>
        </Breakout>
    <NDB_List>
     */

    // A list of breakouts.
    public $items = [];

    /**
     * @param Reader $reader
     * @return NDBList
     * @throws \Sabre\Xml\LibXMLException
     * @throws \Sabre\Xml\ParseException
     */
    static function xmlDeserialize(Reader $reader):NDBList {
        $ndbs = new self();
        $children = $reader->parseInnerTree();
        foreach($children as $child) {
            if ($child['value'] instanceof Breakout) {
                $ndbs->items[] = $child['value'];
            }
        }

        return $ndbs;
    }
}
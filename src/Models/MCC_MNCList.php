<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 12:43
 */

namespace Shareed2k\iTest\Models;

use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class MCC_MNCList
 * @package Shareed2k\iTest\Models
 */
class MCC_MNCList implements XmlDeserializable {
    /**
    <MCC_MNC_List>
        <Breakout>
            <MCC_MNC>12345</MCC_MNC>
        </Breakout>
    </ MCC_MNC_List>
     */

    // A list of breakouts.
    public $items = [];

    /**
     * @param Reader $reader
     * @return MCC_MNCList
     * @throws \Sabre\Xml\LibXMLException
     * @throws \Sabre\Xml\ParseException
     */
    static function xmlDeserialize(Reader $reader):MCC_MNCList {
        $mccs = new self();
        $children = $reader->parseInnerTree();
        foreach($children as $child) {
            if ($child['value'] instanceof Breakout) {
                $mccs->items[] = $child['value'];
            }
        }
        return $mccs;
    }
}
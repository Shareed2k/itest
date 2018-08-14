<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 11:08
 */

namespace Shareed2k\iTest\Models;

use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class VendorsList
 * @package Shareed2k\iTest\Models
 */
class VendorsList implements XmlDeserializable {

    /**
    <Vendors_List>
        <Supplier>
            <Supplier_ID>1039</Supplier_ID>
            <Supplier_Name>0 Platinum g711</Supplier_Name>
            <Prefix>021001</Prefix>
            <Codec>G.711 u-law</Codec>
        </Supplier>
        <Supplier>
            <Supplier_ID>1094</Supplier_ID>
            <Supplier_Name>0 Platinum g729</Supplier_Name>
            <Prefix>021001</Prefix>
            <Codec>G.729</Codec>
        </Supplier>
    </Vendors_List>
     */

    // A list of suppliers.
    public $items = [];

    /**
     * @param Reader $reader
     * @return VendorsList
     * @throws \Sabre\Xml\LibXMLException
     * @throws \Sabre\Xml\ParseException
     */
    static function xmlDeserialize(Reader $reader):VendorsList {
        $vendors = new self();
        $children = $reader->parseInnerTree();
        foreach($children as $child) {
            if ($child['value'] instanceof Supplier) {
                $vendors->items[] = $child['value'];
            }
        }
        return $vendors;
    }
}
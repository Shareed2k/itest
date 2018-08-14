<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 09:42
 */

namespace Shareed2k\iTest;

use GuzzleHttp\Client as GClient;
use Sabre\Xml\Service;
use Shareed2k\iTest\Models\Breakout;
use Shareed2k\iTest\Models\MCC_MNCList;
use Shareed2k\iTest\Models\MobileOrigination;
use Shareed2k\iTest\Models\MobileOriginationList;
use Shareed2k\iTest\Models\NDBList;
use Shareed2k\iTest\Models\Profile;
use Shareed2k\iTest\Models\ProfilesList;
use Shareed2k\iTest\Models\Supplier;
use Shareed2k\iTest\Models\Test;
use Shareed2k\iTest\Models\Params\Test\CliTestParam;
use Shareed2k\iTest\Models\Params\Test\CliTestWithMCC_MNCParam;
use Shareed2k\iTest\Models\Params\Test\ManualNumberTestParam;
use Shareed2k\iTest\Models\Params\Test\MobileOriginationTestParam;
use Shareed2k\iTest\Models\Params\Test\NDBTestParam;
use Shareed2k\iTest\Models\TestInitiation;
use Shareed2k\iTest\Models\Tests\Detailed;
use Shareed2k\iTest\Models\Tests\Overview;
use Shareed2k\iTest\Models\VendorsList;

/**
 * Class Client
 *
 * iTest API v4.3
 *
 * @package Shareed2k\iTest
 */
class Client
{
    const API_URL = 'https://api.i-test.net/';

    const STANDARD_TEST = 1021;
    const CLI_TEST = 1022;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $pass;

    /**
     * @var GClient
     */
    protected $client;

    /**
     * Client constructor.
     * @param string $email
     * @param string $pass
     */
    public function __construct(string $email, string $pass) {
        $this->client = new GClient([
            'base_uri' => self::API_URL,
            'headers' => [
                'Content-Type'  => 'multipart/form-data',
                'Accept'        => 'application/xml',
            ]
        ]);

        $this->email = $email;
        $this->pass = $pass;
    }

    /**
     * @param array $query
     * @param array $elements
     * @return array|mixed|object|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    protected function makeRequest(array $query, array $elements) {
        $response = $this->client->request('POST', '', [
            'form_params' => [
                'email' => $this->email,
                'pass'  => $this->pass
            ],
            'query' => $query
        ]);

        $b = $response->getBody()->getContents();
        $b = str_replace("&", "&amp;", $b);

        $service = new Service();
        $service->elementMap = $elements;

        return $service->parse($b);
    }

    /**
     * List Profiles
     *
     * Where <Profile_IP> contains the Profile IP
     * Where <Profile_Port> contains the Profile Port
     * Where <Profile_Src_Number> contains the Profile Source Number (random source number is displayed
     * as xxxxxxxxxxx)
     *
     * https://api.i-test.net/?t=1011
     *
     * @return ProfilesList
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function getListProfiles():ProfilesList {
        return $this->makeRequest(
            [
                't' => 1011
            ],
            [
                '{}Profiles_List' => ProfilesList::class,
                '{}Profile'       => Profile::class,
            ]
        );
    }

    /**
     * List Suppliers
     *
     * Where <Supplier_ID> contains the Supplier ID
     * Where <Supplier_Name> contains the Supplier Name
     * Where <Prefix> contains the Supplier Prefix
     * Where <Codec> contains the Supplier Codec
     *
     * https://api.i-test.net/?t=1012
     *
     * @return VendorsList
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function getListSuppliers():VendorsList {
        return $this->makeRequest(
            [
                't' => 1012
            ],
            [
                '{}Vendors_List' => VendorsList::class,
                '{}Supplier'     => Supplier::class,
            ]
        );
    }

    /**
     * List Number DataBase (NDB) breakouts
     *
     * – Standard Tests = 1021
     * – CLI Tests = 1022
     *
     * Where <Country_Name> contains the Country Name
     * Where <Country_ID> contains the Country ID
     * Where <Breakout_Name> contains the Breakout Name
     * Where <Breakout_ID> contains the Breakout ID
     *
     * https://api.i-test.net/?t=1021 / 1022
     *
     * @param int $type
     * @return NDBList
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function getListNumberDataBase(int $type = self::STANDARD_TEST):NDBList {
        switch ($type) {
            case self::CLI_TEST:
                break;
            default:
                $type = self::STANDARD_TEST;
        }

        return $this->makeRequest(
            [
                't' => $type
            ],
            [
                '{}NDB_List' => NDBList::class,
                '{}Breakout' => Breakout::class,
            ]
        );
    }

    /**
     * List Number DataBase (NDB) breakouts – CLI Tests (By MCC/MNC)
     *
     * Where < MCC_MNC> is the MCC / MNC combined code
     *
     * https://api.i-test.net/?t=1027
     *
     * @return MCC_MNCList
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function getListNumberDataBaseByMCC_MNC():MCC_MNCList {
        return $this->makeRequest(
            [
                't' => 1027
            ],
            [
                '{}MCC_MNC_List' => MCC_MNCList::class,
                '{}Breakout'     => Breakout::class,
            ]
        );
    }

    /**
     * List Mobile Origination Endpoints
     *
     * https://api.i-test.net/?t=1024
     *
     * @return MobileOrigination
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function getListMobileOriginationEndpoints():MobileOrigination {
        return $this->makeRequest(
            [
                't' => 1024
            ],
            [
                '{}Mobile_Origination'      => MobileOrigination::class,
                '{}Mobile_Origination_List' => MobileOriginationList::class,
            ]
        );
    }

    /**
     * Initiate Standard Manual Number Test
     *
     * Params:
     *
     * Where 12 is the Profile ID returned from the Profile list
     * Where 34 is the prefix required (a hash must be sent as '%%hash') (Optional)
     * Where 44 is the supplier ID (As identified by looking up the supplier)
     * Where 1234%%-5678%%-12345678 is a list of numbers to include in the test separated by '%%-'
     *
     * Return:
     *
     * Where <Test_ID> contains the ID of the test
     * Where <Share_URL> contains the URL to access the shared test
     *
     * https://api.i-test.net/?t=2011&profid=12&prefix=34&vended=44&numbers=1234%%-5678%%-12345678
     *
     * @param ManualNumberTestParam $params
     * @return TestInitiation
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function initiateStandardManualNumberTest(ManualNumberTestParam $params):TestInitiation {
        return $this->makeRequest(
            [
                't' => 2011,
                'tname'  => $params->testName,
                'tani'   => $params->ani,
                'profid' => $params->profileId,
                'prefix' => $params->prefix,
                'vended' => $params->supplierId,
                'codec'  => $params->codec,
                'numbers'=> implode('%%-', $params->numbers),
                'j_type'   => $params->testType,
            ],
            [
                '{}Test_Initiation' => TestInitiation::class,
                '{}Test'            => Test::class,
            ]
        );
    }

    /**
     * Initiate Standard NDB Test
     *
     * Params:
     *
     * Where 12 is the Profile ID returned from the Profile list
     * Where 34 is the prefix required (a hash must be sent as '%%hash') (Optional)
     * Where 44 is the supplier ID (As identified by looking up the supplier)
     * Where 56 is the Country ID returned from the NDB breakout list
     * Where 78 is the Breakout ID returned from the NDB breakout list
     *
     * https://api.i-test.net/?t=2011&profid=12&prefix=34&vended=44&ndbccgid=56&ndbcgid=78
     *
     * Return:
     *
     * Where <Test_ID> contains the ID of the test
     * Where <Share_URL> contains the URL to access the shared test
     *
     * @param NDBTestParam $params
     * @return TestInitiation
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function initiateStandardNDBTest(NDBTestParam $params):TestInitiation {
        return $this->makeRequest(
            [
                't' => 2011,
                'tname'    => $params->testName,
                'tani'     => $params->ani,
                'profid'   => $params->profileId,
                'prefix'   => $params->prefix,
                'vended'   => $params->supplierId,
                'ndbccgid' => $params->countryId,
                'ndbcgid'  => $params->breakoutId,
                'codec'    => $params->codec,
                'j_type'   => $params->testType,
            ],
            [
                '{}Test_Initiation' => TestInitiation::class,
                '{}Test'            => Test::class,
            ]
        );
    }

    /**
     * Initiate CLI Test
     *
     * Params:
     *
     * Where 12 is the Profile ID returned from the Profile list
     * Where 44 is the Supplier ID returned from the Supplier list
     * Where 56 is the Country ID returned from the NDB breakout list
     * Where 78 is the Breakout ID returned from the NDB breakout list
     *
     * Optional argument of ‘qty’ can be used to define the number of calls to initiate. The available options are
     * 1,5 and 10. Example ‘&qty=5’. The default is 10.
     *
     * https://api.i-test.net/?t=2012&profid=12&vendid=44&ndbccgid=56&ndbcgid=78&qty=5
     *
     * Return:
     *
     * Where <Test_ID> contains the ID of the test
     * Where <Share_URL> contains the URL to access the shared test
     *
     * @param CliTestParam $params
     * @return TestInitiation
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function initiateCliTest(CliTestParam $params):TestInitiation {
        return $this->makeRequest(
            [
                't' => 2012,
                'tname'    => $params->testName,
                'tani'     => $params->ani,
                'profid'   => $params->profileId,
                'vendid'   => $params->supplierId,
                'ndbccgid' => $params->countryId,
                'ndbcgid'  => $params->breakoutId,
                'ndbqty'   => $params->qty,
                'codec'    => $params->codec,
                'j_type'   => $params->testType,
            ],
            [
                '{}Test_Initiation' => TestInitiation::class,
                '{}Test'            => Test::class,
            ]
        );
    }

    /**
     * Initiate CLI Test (Using MCC / MNC)
     *
     * Params:
     *
     * Where 12 is the Profile ID returned from the Profile list
     * Where 44 is the Supplier ID returned from the Supplier list
     * Where 12345 is the MCC/MNC code returned from the NDB list by MCC/MNC
     *
     * Optional argument of ‘qty’ can be used to define the number of calls to initiate. The available options are
     * 1,5 and 10. Example ‘&qty=5’. The default is 10.
     *
     * https://api.i-test.net/?t=2012&profid=12&vendid=44&mccmnc=12345&qty=5
     *
     * Return:
     *
     * Where <Test_ID> contains the ID of the test
     * Where <Share_URL> contains the URL to access the shared test
     *
     * @param CliTestWithMCC_MNCParam $params
     * @return TestInitiation
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function initiateCliTestWithMCC_MNC(CliTestWithMCC_MNCParam $params):TestInitiation {
        return $this->makeRequest(
            [
                't' => 2012,
                'tname'  => $params->testName,
                'tani'   => $params->ani,
                'profid' => $params->profileId,
                'vendid' => $params->supplierId,
                'mccmnc' => $params->mccMnc,
                'ndbqty' => $params->qty,
                'codec'  => $params->codec,
                'j_type' => $params->testType,
            ],
            [
                '{}Test_Initiation' => TestInitiation::class,
                '{}Test'            => Test::class,
            ]
        );
    }

    /**
     * Initiate Mobile Origination Test
     *
     * Params:
     *
     * Where 56 is the Country ID returned from the NDB breakout list
     * Where 78 is the Breakout ID returned from the NDB breakout list
     * Where 12345 is the number for the remote node to call
     *
     * https://api.i-test.net/?t=2014&ndbccgid=56&ndbcgid=78&dstnum=12345
     *
     * Return:
     *
     * Where <Test_ID> contains the ID of the test
     *
     * @param MobileOriginationTestParam $params
     * @return TestInitiation
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function initiateMobileOriginationTest(MobileOriginationTestParam $params):TestInitiation {
        return $this->makeRequest(
            [
                't' => 2014,
                'tname'    => $params->testName,
                'tani'     => $params->ani,
                'ndbccgid' => $params->countryId,
                'ndbcgid'  => $params->breakoutId,
                'dstnum'   => $params->number,
                'codec'    => $params->codec,
                'j_type'   => $params->testType,
            ],
            [
                '{}Test_Initiation' => TestInitiation::class,
                '{}Test'            => Test::class,
            ]
        );
    }

    /**
     * Check Test Status Overview
     *
     * Params:
     *
     * Where 123456789123456789 is the Test_ID returned when initiating the test (Optional)
     * If the test id is omitted, the last 20 test will be shown
     *
     * https://api.i-test.net/?t=3014&jid=123456789123456789
     *
     * Return:
     *
     * Where <ID> is the ID of the test
     * Where <Init> is the time the call was initiated as an EPOCH
     * Where <Name> is the name of the test
     * Where <InitBy> is the name of the user who initiated the test
     * Where <Supplier> is the supplier of the test
     * Where <Type> is the test type of the test (0 = standard test, 1 = advanced / CLI test, 2 = Interconnect Test)
     * Where <t> is the total calls initiated
     * Where <c> is the total number of completed calls
     * Where <s> is the number of successful calls
     * Where <n> is the number of calls not answered
     * Where <f> is the number of calls that failed
     * Where <PDD> is the PDD for all the combined calls
     *
     * @param int $testId
     * @return Overview\TestStatus
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function checkTestStatusOverview(int $testId):Overview\TestStatus {
        return $this->makeRequest(
            [
                't' => 3014,
                'jid' => $testId,
            ],
            [
                '{}Test_Status' => Overview\TestStatus::class,
                '{}Job'         => Overview\Job::class,
            ]
        );
    }

    /**
     * Check Test Status Detailed
     *
     * Params:
     *
     * Where 123456789123456789 is the Test_ID returned when initiating the test (Optional)
     * If the test id is omitted, the last 20 test will be shown
     *
     * https://api.i-test.net/?t=3024&jid=123456789123456789
     *
     * Return:
     *
     * Where <Name> is the name of the test
     * Where <Supplier> is the supplier of the test
     * Where <InitBy> is the name of the user who initiated the test
     * Where <Init> is the time the call was initiated as an epoch
     * Where <Type> is the test type of the test (0 = standard test, 1 = advanced / CLI test, 2 = Interconnect Test)
     * Where <TestID> is the ID of the test
     * Where <ID> is the ID of the call
     * Where <Source> is the source number of the call
     * Where <Destination > is the destination number of the call
     * Where <Start> is the start time of the call as an epoch
     * Where <PDD> is the PDD of the call
     * Where <MOS> is the MOS score of the call
     * Where <Ring> is the number of seconds the call rang for
     * Where <Call> is the number of seconds the call was connected
     * Where <Last_Code> is the last significant SIP message received from the customer switch
     * Where <Result> is the overall result of the call
     * Where <Result_Code> is the Result Code (See below for list of result codes)
     * Where <CLI> is the CLI presented (if applicable)
     * Where <FAS>,<LD_FAS>,<Dead_Air>,<No_RBT>,<Viber> is ‘0’ = false or ‘1’ = true, as to whether this was detected on this call
     *
     * @param int $testId
     * @return Detailed\TestStatus
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sabre\Xml\ParseException
     */
    public function checkTestStatusDetailed(int $testId):Detailed\TestStatus {
        return $this->makeRequest(
            [
                't' => 3024,
                'jid' => $testId,
            ],
            [
                '{}Test_Status'   => Detailed\TestStatus::class,
                '{}Test_Overview' => Detailed\TestOverview::class,
                '{}Call'          => Detailed\Call::class,
            ]
        );
    }
}
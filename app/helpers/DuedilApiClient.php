<?php
//namespace DuedilApiClient;
/**
 * DuedilApiClient
 * @copyright 2013 Duedil Ltd.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
if ( version_compare(PHP_VERSION, '5.2.0', '<') ) {
    throw new DuedilApiException('Duedil Client need PHP version >= 5.2.0');
}

/**
 * Duedil API Client
 *
 * @author Duedil Ltd <api@duedil.com>
 * @copyright 2013 Duedil Ltd.
 *
 */
abstract class AbstractDuedilApiClient
{
    public static $version = 'duedil.api.client-php-3.1';

    const COMPANIES = '/companies/';

    const DIRECTORS = '/directors/';

    const PREVIOUS_COMPANY_NAMES = '/previous-company-names';

    const REGISTERED_ADDRESS = '/registered-address';

    const BANK_ACCOUNTS = '/bank-accounts';

    const SECONDARY_INDUSTRIES = '/secondary-industries';

    const SHAREHOLDERS = '/shareholders';

    const DOCUMENTS = '/documents';

    const MORTGAGES = '/mortgages';

    const ACCOUNTS = '/accounts';

    const SUBSIDIARIES = '/subsidiaries';

    const PARENT = '/parent';

    const CREDIT_LIMITS = '/credit-limits';

    const CREDIT_RATINGS = '/credit-ratings';

    const DIRECTORSHIPS = '/directorships';

    const SERVICE_ADDRESSES = '/service-addresses';

    const STAT = '/stat';

    const REQUEST_DETAILS = '/request-details/';

    const COMMA = ',';

    const QUESTION_MARK = '?';

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var string
     */
    private $fields;

    /**
     * @var string
     */
    private $pagination;

    /**
     * @var string
     */
    protected $requestId;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $query = array();

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @param string $key the duedil api key
     * @param string $url the api url
     * @param string | null $locale the locale value
     */
    public function __construct($key, $url = 'http://duedil.io/v3', $locale = null)
    {
        if ( !$key ) {
            throw new DuedilApiException('No API Key found');
        }

        if ( $locale ) {
            $this->locale = $locale;
        }

        $this->httpClient = new HttpClient($key, $url);
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = strtolower($locale);
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $result = $this->httpClient->run(
            $this->path, $this->fields, $this->limit, $this->offset, $this->query
        );

        return $this->cleanupResults($result);
    }

    /**
     * @param $result
     * @return mixed
     */
    private function cleanupResults($result)
    {
        if ( isset($result[ResponseEnum::REQUEST_ID]) ) {
            $this->requestId = ($result[ResponseEnum::REQUEST_ID]);
        }

        if ( isset($result[ResponseEnum::RESPONSE][ResponseEnum::PAGINATION]) ) {
            $this->pagination = $result[ResponseEnum::RESPONSE][ResponseEnum::PAGINATION];
            $data = $result[ResponseEnum::RESPONSE][ResponseEnum::DATA];
        } else {
            $data = $result[ResponseEnum::RESPONSE];
        }

        $this->reset();
        return $data;
    }

    /**
     * Reset the client's properties
     */
    protected function reset()
    {
        $this->limit = null;
        $this->offset = null;
        $this->fields = null;
    }

    /**
     * @return string
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    public function setFields($fields)
    {
        if ( is_array($fields) ) {
            $fields = join(self::COMMA, $fields);
        }

        $this->fields = $fields;
        return $this;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }
}

/**
 * Class DuedilApiClient
 */
class DuedilApiClient extends AbstractDuedilApiClient
{
    public function getCompanyByOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org;
        return $this;
    }

    public function getPreviousCompanyNameByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::PREVIOUS_COMPANY_NAMES;
        return $this;
    }

    public function getPreviousCompanyDetailsByCompanyOrg($company_org, $old_company_id)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::PREVIOUS_COMPANY_NAMES . ResponseEnum::SLASH . $old_company_id;
        return $this;
    }

    public function getRegisteredAddressByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::REGISTERED_ADDRESS;
        return $this;
    }

    public function getBankAccountsByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::BANK_ACCOUNTS;
        return $this;
    }

    public function getSecondaryIndustriesByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::SECONDARY_INDUSTRIES;
        return $this;
    }

    public function getShareholdingsByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::SHAREHOLDERS;
        return $this;
    }

    public function getDocumentsByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::DOCUMENTS;
        return $this;
    }

    public function getMortgagesByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::MORTGAGES;
        return $this;
    }

    public function getAccountsByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::ACCOUNTS;
        return $this;
    }

    public function getAccountsDetailsByOrg($company_org, $account_id)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::ACCOUNTS . ResponseEnum::SLASH . $account_id;
        return $this;
    }

    public function getSubsidiariesByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::SUBSIDIARIES;
        return $this;
    }

    public function getCompanyBySubsidiaryOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::PARENT;
        return $this;
    }

    public function getDirectorshipsByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::DIRECTORSHIPS;
        return $this;
    }

    public function getDirectorByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . rtrim(self::DIRECTORS, ResponseEnum::SLASH);
        return $this;
    }

    //CREDIT
    public function getCreditLimitsByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::CREDIT_LIMITS;
        return $this;
    }

    public function getCreditRatingsByCompanyOrg($company_org)
    {
        $this->path = $this->locale . self::COMPANIES . $company_org . self::CREDIT_RATINGS;
        return $this;
    }

    //DIRECTOR
    public function getDirectorById($director_id)
    {
        $this->path = $this->locale . self::DIRECTORS . $director_id;
        return $this;
    }

    public function getCompaniesByDirectorsId($director_id)
    {
        $this->path = $this->locale . self::DIRECTORS . $director_id . self::COMPANIES;
        return $this;
    }

    public function getDirectorshipsByDirectorsId($director_id)
    {
        $this->path = $this->locale . self::DIRECTORS . $director_id . self::DIRECTORSHIPS;
        return $this;
    }

    public function getServiceAddressByDirectorsId($director_id)
    {
        $this->path = $this->locale . self::DIRECTORS . $director_id . self::SERVICE_ADDRESSES;
        return $this;
    }

    public function getDirectorStatByDirectorsId($director_id)
    {
        $this->path = $this->locale . self::DIRECTORS . $director_id . self::COMPANIES . self::STAT;
        return $this;
    }

    //REQUEST ID
    public function getRequestDetails($request_id = null)
    {
        if ( !$request_id ) {
            $request_id = $this->getRequestId();
        }

        if ( !$request_id ) {
            throw new DuedilApiException('Request id not found. You need to call method run() before call getRequestId()');
        }

        return $this->httpClient->run(self::REQUEST_DETAILS . $request_id);
    }
}

final class AdvancedSearchDuedilApiClient extends DuedilApiClient
{
    private $filters = array();

    private $orderBy = array();

    public function setTerms($terms, $value)
    {
        $this->filters[$terms] = $value;
        return $this;
    }

    public function setRange($range, $from, $to)
    {
        $this->filters[$range] = array( (int)$from, (int)$to );
        return $this;
    }
    /**
     * @return mixed
     */
    public function search()
    {
        if ( empty($this->filters) ) {
            throw new DuedilApiException('The filters can\' be null');
        }

        $this->query = array(ResponseEnum::FILTERS => json_encode($this->filters));

        if ( !empty($this->orderBy) ) {
            $this->orderBy = array(ResponseEnum::ORDER_BY => json_encode($this->orderBy));
            $this->query = array_merge($this->query, $this->orderBy);
        }

        return parent::run();
    }

    public function searchCompanies($name = null)
    {
        if ( $name ) {
            $this->filters[SearchFields::COMPANIES_NAME] = $name;
        }
        $this->path = rtrim(self::COMPANIES, ResponseEnum::SLASH);
        return $this;
    }

    public function searchDirectors($name = null)
    {
        if ( $name ) {
            $this->filters[SearchFields::DIRECTORS_NAME] = $name;
        }
        $this->path = rtrim(self::DIRECTORS, ResponseEnum::SLASH);
        return $this;
    }

    public function orderBy($field, $direction)
    {
        $this->orderBy[$field] = $direction;
        return $this;
    }

    protected function reset()
    {
        parent::reset();
        $this->filters = array();
        $this->orderBy = array();
    }
}

final class SearchFields
{
    //Range
    const DATE_OF_BIRTH ='date_of_birth';
    const TURNOVER ='turnover';
    const TURNOVER_DELTA_PERCENTAGE ='turnover_delta_percentage';
    const GROSS_PROFIT ='gross_profit';
    const GROSS_PROFIT_DELTA_PERCENTAGE ='gross_profit_delta_percentage';
    const GROSS_MARGIN_RATIO ='gross_margin_ratio';
    const COST_OF_SALES ='cost_of_sales';
    const COST_OF_SALES_DELTA_PERCENTAGE ='cost_of_sales_delta_percentage';
    const NET_ASSETS ='net_assets';
    const NET_ASSETS_DELTA_PERCENTAGE ='net_assets_delta_percentage';
    const CURRENT_ASSETS ='current_assets';
    const CURRENT_ASSETS_DELTA_PERCENTAGE ='current_assets_delta_percentage';
    const TOTAL_ASSETS ='total_assets';
    const TOTAL_ASSETS_DELTA_PERCENTAGE ='total_assets_delta_percentage';
    const CASH ='cash';
    const CASH_DELTA_PERCENTAGE ='cash_delta_percentage';
    const CASH_TO_TOTAL_ASSETS_RATIO ='cash_to_total_assets_ratio';
    const CASH_TO_CURRENT_LIABILITIES_RATIO ='cash_to_current_liabilities_ratio';
    const TOTAL_LIABILITIES ='total_liabilities';
    const TOTAL_LIABILITIES_DELTA_PERCENTAGE ='total_liabilities_delta_percentage';
    const NET_WORTH ='net_worth';
    const NET_WORTH_DELTA_PERCENTAGE ='net_worth_delta_percentage';
    const DEPRECIATION ='depreciation';
    const DEPRECIATION_DELTA_PERCENTAGE ='depreciation_delta_percentage';
    const EMPLOYEE_COUNT ='employee_count';
    const KEYWORDS ='keywords';
    const TAXATION ='taxation';
    const RETAINED_PROFITS ='retained_profits';
    const PROFIT_RATIO ='profit_ratio';
    const NET_PROFITABILITY ='net_profitability';
    const INVENTORY_TURNOVER_RATIO ='inventory_turnover_ratio';
    const RETURN_ON_CAPITAL_EMPLOYED ='return_on_capital_employed';
    const GEARING ='gearing';
    const RETURN_ON_ASSETS_RATIO ='return_on_assets_ratio';
    const CURRENT_RATIO ='current_ratio';
    const DEBT_TO_CAPITAL_RATIO ='debt_to_capital_ratio';
    const LIQUIDITY_RATIO ='liquidity_ratio';
    //Terms
    const GENDER ='gender';
    const TITLE ='title';
    const NATIONALITY ='nationality';
    const SECRETARIAL ='secretarial';
    const CORPORATE ='corporate';
    const DISQUALIFIED ='disqualified';
    const POSTCODE ='postcode';
    const INDUSTRIES ='industries';
    const LOCALE ='locale';
    const LOCATION ='location';
    const SIC_CODE ='sic_code';
    const SIC_2003_CODE ='sic_2003_code';
    const STATUS ='status';
    const CURRENCY ='currency';
    const DIRECTORS_NAME ='name';
    const COMPANIES_NAME ='name';
    //OrderBY
    const DESC = 'desc';
    const ASC = 'asc';
}

/**
 * Simple HTTP Client
 *
 * @author Duedil Ltd <api@duedil.com>
 * @copyright 2013 Duedil Ltd.
 *
 */
final class HttpClient
{
    private $url;

    private $key;

    public function __construct($key, $url)
    {
        $this->key = $key;
        $this->url = $url;
    }

    private function execute($path)
    {
        $curl = $this->createCurl($path);
        $response = curl_exec($curl);

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $code == 0 ) {
            throw new DuedilApiException('Error while connecting to ' . $path);
        }

        if ( $code != 200 ) {
            throw new DuedilApiException(json_decode($response, true));
        }

        curl_close($curl);

        return $response;
    }

    private function createCurl($path)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $path);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, ResponseEnum::GET);
        curl_setopt($curl, CURLOPT_USERAGENT, DuedilApiClient::$version);
        //timeout
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($curl, CURLOPT_TIMEOUT, 4);
        return $curl;
    }

    private function callEndpoint($path, $param)
    {
        return json_decode(
            $this->execute($this->url . $path . DuedilApiClient::QUESTION_MARK . $param), true
        );
    }

    private function createParamList($param, $limits, $offset, array $query)
    {
        $params = array();

        if ( $param != null ) {
            $params[ResponseEnum::FILEDS] = $param;
        }

        if ( $limits != null ) {
            $params[ResponseEnum::LIMIT] = $limits;
        }

        if ( $offset != null ) {
            $params[ResponseEnum::OFFSET] = $offset;
        }

        if ( !empty($query) ) {
            foreach ( $query as $k => $v ) {
                $params[$k] = $v;
            }
        }

        $params[ResponseEnum::API_KEY] = $this->key;

        return http_build_query($params);
    }

    public function run($path, $param = null, $limits = null, $offset = null, $query = null)
    {
        return $this->callEndpoint(
            $path, $this->createParamList($param, $limits, $offset, $query)
        );
    }
}

/**
 * DuedilApiException
 *
 * @author Duedil Ltd <api@duedil.com>
 * @copyright 2013 Duedil Ltd.
 *
 */
final class DuedilApiException extends Exception
{
    public function __construct($message, $code = null, $previous = null)
    {
        if ( is_array($message) ) {
            $this->message = $message;
            $message = $message[ResponseEnum::MSG];
        }
        parent::__construct($message);
    }
}

/**
 * ResponseEnum
 *
 * @author Duedil Ltd <api@duedil.com>
 * @copyright 2013 Duedil Ltd.
 *
 */
final class ResponseEnum
{
    const RESPONSE = 'response';
    const REQUEST_ID = 'request_id';
    const PAGINATION = 'pagination';
    const FILEDS = 'fields';
    const LIMIT = 'limit';
    const OFFSET = 'offset';
    const API_KEY = 'api_key';
    const MSG = 'message';
    const DATA = 'data';
    const SLASH = '/';
    const FILTERS = 'filters';
    const GET = 'GET';
    const ORDER_BY = 'orderBy';
}

<?php

namespace CodingMs\InfoniqaJobs\Service;

/***************************************************************
 *  Copyright notice
 *  (c) 2016 Thomas Deuling <typo3@coding.ms>, www.coding.ms
 *
 *  All rights reserved
 *  License for this script located in "\License\License.pdf"
 *  Neither this script nor parts of it are permitted for free distribution!
 ***************************************************************/

/**
 * Fetch jobs XML
 *
 */
class XmlService
{

    protected $error = '';

    /**
     * CURL HTTP header data
     * @var array
     */
    public static $curlHttpHeader = [
        'Accept: application/json',
        //'Accept-Encoding: gzip',
        'Accept-Language: de'
    ];

    /**
     * CURL user agent
     * @var array
     */
    public static $curlUserAgent = [
        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Safari/534.45'
    ];

    /**
     * Fetch jobs by CURL or file_get_contents
     *
     * @param string $url URL of jobs XML
     * @return boolean|\SimpleXMLElement
     */
    public function fetch($url)
    {
        $jobOffers = null;
        // Get current version by CURL
        if (function_exists('curl_init')) {
            // Init curl request
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, self::$curlHttpHeader);
            curl_setopt($ch, CURLOPT_USERAGENT, self::$curlUserAgent);
            curl_setopt($ch, CURLOPT_REFERER, 'http://' . $_SERVER['HTTP_HOST']);
//+286/econcess
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_USERPWD, "info" . ":" . "niqa12345");
//-286/econcess
            $xmlData = curl_exec($ch);
			curl_close($ch);
        } // Fall back with file get contents
        else {
            $context = ['http' => ['header' => 'Referer: http://' . $_SERVER['HTTP_HOST']]];
            $streamContext = stream_context_create($context);
            $xmlData = @file_get_contents($url, false, $streamContext);
        }
        if (is_string($xmlData) && trim($xmlData) !== '') {
            try {
                $jobOffers = new \SimpleXMLElement($xmlData);
            } catch (\Exception $e) {
                $this->error = $e->getMessage();
            }
        }
        return $jobOffers;
    }


    public function getError()
    {
        return $this->error;
    }

    /**
     * @param $xmlObject
     * @return array
     */
    public function xml2array($xmlObject)
    {
        return json_decode(json_encode($xmlObject), 1);
    }
}

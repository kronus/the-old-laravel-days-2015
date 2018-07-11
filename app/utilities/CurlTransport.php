<?php

namespace utilities;

/**
 *
 **/
class CurlTransport
{
    protected $headers;
    protected $curlErrorNum;
    protected $curlErrorMessage;

    public function __construct()
    {
        $curlErrorNum = '';
        $curlErrorMessage = '';
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function addToHeaders($headerItem)
    {
        $this->headers[] = $headerItem;
    }

    public function getCurlErrorNum()
    {
        return $this->curlErrorNum;
    }

    protected function setCurlErrorNum($error_num)
    {
        $this->curlErrorNum = $error_num;
    }

    public function getCurlErrorMessage()
    {
        return $this->curlErrorMessage;
    }

    protected function setCurlErrorMessage($error)
    {
        $this->curlErrorMessage = $error;
    }

    public function sendContentViaCurl($content, $endpoint)
    {
        $ch = curl_init();
        $options = array(
            CURLOPT_POST => 1,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_URL => $endpoint,
            CURLOPT_HTTPHEADER => $this->getHeaders(),
            CURLOPT_USERAGENT => 'SomeConfig',
            CURLOPT_POSTFIELDS => $content,
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->setCurlErrorNum(curl_errno($ch));
            $this->setCurlErrorMessage(curl_error($ch));
        }

        curl_close($ch);

        return $response;

    }

    public function curlHasError()
    {
        $currentErrorNum = $this->getCurlErrorNum();
        if (in_array($currentErrorNum, array('', 0))) {
            return false;
        } else {
            return true;
        }
    }

}

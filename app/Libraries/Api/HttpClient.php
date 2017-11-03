<?php

namespace App\Libraries\APi;


use App\Exceptions\BadRequestException;
use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class HttpClient
{
    protected $httpClient;

    public function __construct($session = null)
    {
        $this->httpClient = new Client([
            // 后台接口基地址
            'base_uri' => env('API_BASE_URL'),
            // Http 请求超时时间
            'timeout' => env('API_REQUEST_TIMEOUT'),
        ]);
    }

    /**
     * Http GET 请求接口
     *
     * @param $url
     * @param array $data
     * @return string
     */
    protected function get($url, array $data = null)
    {
        $options = ['query' => $data];

        return $this->request('get', $url, $options);
    }

    /**
     * Http POST 请求接口
     *
     * @param $url
     * @param array $data
     * @return string
     */
    protected function post($url, $data = null)
    {
        $options = ['form_params' => $data];

        return $this->request('post', $url, $options);
    }

    protected function request($method, $url, $options = [])
    {
        try {
            Log::info($method . ' ' . $url . PHP_EOL . \GuzzleHttp\json_encode($options));
            $res = $this->httpClient->request($method, $url, $options);
            $body = $res->getBody();
            $content = $body->getContents();
            Log::info($content . PHP_EOL);

            if(!empty($content)) {
                $content = \GuzzleHttp\json_decode($content, true);
            }

            return $content;
        } catch (Exception $e) {
            $this->exceptionHandler($e);
        }
    }

    protected function exceptionHandler(Exception $e)
    {
        if ($e instanceof RequestException) {
            $response = $e->getResponse();
            if (is_null($response)) {
                throw new BadRequestException($e->getMessage());
            }

            $code = $response->getStatusCode();
            $body = $response->getBody();

            throw new BadRequestException($body, $code);
        }
        throw new BadRequestException($e->getMessage(), $e->getCode());
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: barte
 * Date: 26.09.2017
 * Time: 23:15
 */

namespace AppBundle\RedditAPI;


use function json_decode;

class Curl
{
    private $endpoint = 'https://www.reddit.com/api/v1/';
    private $username;
    private $password;
    private $token;

    public function request($method, $resource, array $post = [], $headers = '')
    {
        $curl = curl_init($this->endpoint . $resource);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/xml', !empty($headers) ? $headers : null
        ]);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

        if (!empty($post)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result);
    }

    private function getToken()
    {

    }
}
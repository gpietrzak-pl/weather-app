<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//secrets to get data from provider
require_once('/var/www/html/app/src/secrets.php');

class WeatherController extends AbstractController
{
    /**
     * @Route("/weather/index")
     */
    public function index(): Response
    {
            return new Response(
                '<html><head></head><body><h1>Response page</h1></body><html>'
            );

        // return $this->render('weather/index.html.twig', [
        //     'controller_name' => 'WeatherController',
        // ]);
    }

    /**
     * @Route("/weather/now/{city?}")
     */
    public function now() : Response
    {
        function buildBaseString($baseURI, $method, $params) {
        $r = array();
        ksort($params);
        foreach($params as $key => $value) {
            $r[] = "$key=" . rawurlencode($value);
        }
        return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
        }

        function buildAuthorizationHeader($oauth) {
            $r = 'Authorization: OAuth ';
            $values = array();
            foreach($oauth as $key=>$value) {
                $values[] = "$key=\"" . rawurlencode($value) . "\"";
            }
            $r .= implode(', ', $values);
            return $r;
        }

        $url = YAHOO_url;
        $app_id = YAHOO_app_id;
        $consumer_key = YAHOO_consumer_key;
        $consumer_secret = YAHOO_consumer_secret;

        $query = array(
            'location' => 'rzeszow,pl',
            'format' => 'json'
        );

        $oauth = array(
            'oauth_consumer_key' => $consumer_key,
            'oauth_nonce' => uniqid(mt_rand(1, 1000)),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0'
        );

        $base_info = buildBaseString($url, 'GET', array_merge($query, $oauth));
        $composite_key = rawurlencode($consumer_secret) . '&';
        $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature'] = $oauth_signature;

        $header = array(
            buildAuthorizationHeader($oauth),
            'X-Yahoo-App-Id: ' . $app_id
        );
        $options = array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $url . '?' . http_build_query($query),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        return $this->json($response);
    }

    /**
     * @Route("/weather/forecast/{city?}")
     */
    public function forecast() : Response
    {
        return $this->json(["forecast"]);
    }
}
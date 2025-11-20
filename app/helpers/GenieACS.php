<?php
// /app/helpers/GenieACS.php

class GenieACS
{
    protected $url;
    protected $username;
    protected $password;

    public function __construct($url, $username, $password)
    {
        $this->url = rtrim($url, '/');  // contoh: http://127.0.0.1:7557
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Request helper via CURL
     */
    protected function request($endpoint, $method = 'GET', $data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);

        if ($method === 'POST' && $data) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            return json_decode($response, true);
        }

        return false;
    }

    /**
     * Dapatkan daftar devices
     */
    public function getDevices()
    {
        return $this->request('/devices');
    }

    /**
     * Dapatkan device berdasarkan serial number
     */
    public function getDevice($serial)
    {
        return $this->request("/devices/$serial");
    }

    /**
     * Reboot device
     */
    public function rebootDevice($serial)
    {
        return $this->request("/devices/$serial/reboot", 'POST');
    }

    /**
     * Push config
     */
    public function pushConfig($serial, $config)
    {
        return $this->request("/devices/$serial/config", 'POST', $config);
    }
}

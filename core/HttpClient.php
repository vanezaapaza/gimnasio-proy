
<?php
class HttpClient {
    private $baseUrl;

    public function __construct($baseUrl) {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    public function get($endpoint, $params = []) {
        $url = $this->buildUrl($endpoint, $params);
        return $this->sendRequest($url, 'GET');
    }

    public function post($endpoint, $data = []) {
        $url = $this->buildUrl($endpoint);
        return $this->sendRequest($url, 'POST', $data);
    }

    public function put($endpoint, $data = []) {
        $url = $this->buildUrl($endpoint);
        return $this->sendRequest($url, 'PUT', $data);
    }

    public function delete($endpoint, $data = []) {
        $url = $this->buildUrl($endpoint);
        return $this->sendRequest($url, 'DELETE', $data);
    }

    private function buildUrl($endpoint, $params = []) {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        return $url;
    }

    private function sendRequest($url, $method, $data = null) {
        echo $url;
        $options = [
            'http' => [
                'method' => $method,
                'header' => 'Content-Type: application/json',
            ],
        ];

        if ($data) {
            $options['http']['content'] = json_encode($data);
        }

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === FALSE) {
            throw new Exception("Error processing request to $url");
        }

        return json_decode($response, true);
    }
}
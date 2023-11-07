<?php

namespace App\Models\LabsMobile;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class Core
{
    private $client = null;
    public $error = null;

    protected function __construct() {
        $this->client = new Client([
            'base_uri' => config('labsmobile.url'),
            'auth' => [
                config('labsmobile.user'),
                config('labsmobile.token'),
            ],
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);
    }

    protected function call($path, $payload = []) {       
        if (App::environment('local')) {
            $this->logger()->info('Envío deshabilitado en ambiente de desarrollo', $payload);
            return [
                'subid' => '',
                'message' => 'Envío deshabilitado en ambiente de desarrollo',
                'code' => '0'
            ];
        }
        try {
            $response = $this->client->post("$path", [
                'json' => $payload
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
            $this->logger()->info('SEND', [
                'payload' => $payload,
                'response' => $data,
            ]);
        }catch(ClientException $e) {
            $this->error = $e;
            $this->logger()->error($e->getResponse()->getBody()->getContents(), $payload);
            return false;
        }
        return $data;
    }

    /**
     * Obtener mensaje de error de la última solicitud
     * @return object|false
     */
    public function getError() {
        if ($this->error) {
            $body = $this->error->getResponse()->getBody();
            $info = json_decode($body->getContents() ?: (string) $body);
            if ($info->error ?? false) {
                return $info->error;
            }
            return $info;
        }
        return false;
    }

    private function logger() {
        return Log::channel('labsmobile');
    }
    
}

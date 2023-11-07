<?php

namespace App\Models\LabsMobile;

use Exception;
use BenMorel\GsmCharsetConverter\Converter;

class Message extends Core
{
    public function __construct() {
        parent::__construct();
    }

    private $recipient = [], $message;
    public $params = [];

    public function to($number) {
        $to = preg_replace('/\+/', '', $number);
        if (empty($to)) {
            throw new Exception(__('Número para SMS inválido: :num', ['num' => $number]));
        }
        $this->recipient[] = ['msisdn' => $to];
        return $this;
    }

    public function body($body) {
        $converter = new Converter();
        $this->message = $converter->cleanUpUtf8String($body, true, '?');
        return $this;
    }
    
    public function send() {
        return self::call("send", array_merge([
            'recipient' => $this->recipient,
            'message' => $this->message,
            'tpoa' => config('labsmobile.tpoa')
        ], $this->params));
    }
    
}

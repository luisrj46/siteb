<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ErrorDatabaseException extends Exception
{
    protected $code;

    protected $message;

    protected Exception $exception;

    public function __construct(int $code, String $message, $exception)
    {
        $this->code = $code;
        $this->message = $message;
        $this->exception = $exception;
    }


    public function render($request){
        
        $code = Str::random(10);
        $messageException = $code.' ==> '.$this->message." \n ".$this->exception->getMessage() . " \n " . $this->exception->getTraceAsString();
            
        Log::critical(message: $messageException);
        
        if ($request->is('api/*')) {
            return response()->json([
                'message' => $this->message.'; Code: '.$code.
                (app('env') != 'production' 
                ? " \n ".$messageException 
                : null)
            ], $this->code);
        }

        abort($this->code,$messageException);
    }
}

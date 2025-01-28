<?php

namespace App\Exceptions;
use Exception;
class InvalidBase64DataException extends Exception
{
    protected $statusCode = 400;
    protected $message = 'invalid base64 file';


    protected $apiErrorCode = '2';

    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        if($request->ajax() || $request->wantsJson()){
            return responder()->error(config('moduleName.module_id') * 1000 + $this->apiErrorCode, $this->message)->respond( $this->statusCode  );
        }

        return redirect()->back()->withErrors([__($this->message)]);
    }

}

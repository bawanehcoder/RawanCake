<?php

namespace App\Exceptions;
use Exception;
class GeneralException extends Exception
{
    /**
     * http status code
     *
     * @var int|null
     */
    protected $statusCode = 400;

    /**
     * api error code
     *
     * @var string|null
     */
    protected $message = 'errorMsgHere';

    /**
     * error message
     *
     * @var string|null
     */
    protected $apiErrorCode = 'sold_out_error';

    public function __construct($apiErrorCode, $message, $statusCode = null, $moduleName = null){
        $this->apiErrorCode = $apiErrorCode;
        $this->message = $message;
        $this->moduleName = $moduleName;

        if(!empty($statusCode)){
            $this->statusCode = $statusCode;
        }

    }

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
            if($this->moduleName){
                $moduleName = $this->moduleName;
                $errorCode = config("$moduleName.module_id") * 1000 + $this->apiErrorCode;
            }else{
                $errorCode = $this->apiErrorCode + $this->apiErrorCode;
            }

            return responder()->error( $errorCode, $this->message)->respond( $this->statusCode  );
        }

        return redirect()->back()->withInput()->withErrors([__($this->message)]);
    }
}

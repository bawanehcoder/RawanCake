<?php

namespace App\Exceptions;
use Exception;
class OldNewPasswordMismatchException extends Exception
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
    protected $message = 'old password is not valid';

    /**
     * error message
     *
     * @var string|null
     */
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
            return responder()->error($this->apiErrorCode, $this->message)->respond( $this->statusCode  );
        }

        return redirect()->back()->withErrors([__($this->message)]);
    }
}

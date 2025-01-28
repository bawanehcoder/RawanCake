<?php

namespace App\Exceptions;
use Exception;
class DuplicateElementException extends Exception
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
    protected $message = 'element is duplicate';

    /**
     * error message
     *
     * @var string|null
     */
    protected $apiErrorCode = 'duplicate_element';

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

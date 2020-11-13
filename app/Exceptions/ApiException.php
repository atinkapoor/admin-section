<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Session;

class ApiException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
    }


    public static function customApiResponse($exception)
    {
        if ( method_exists($exception, 'getStatusCode') ) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }
        $response = [];
        $errorBody = json_decode($exception->getBody(), true);
        switch ($statusCode) {
            case 401:
                $response['errors'] = $errorBody;
                break;
            case 403:
                $response['errors'] = $errorBody;
                break;
            case 404:
                $response['errors'] = $errorBody;
                break;
            case 405:
                $response['errors'] = $errorBody;
                break;
            case 422:
                $response['errors'] = $errorBody;
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
                break;
        }
        Session::flash('error', $response);
        return $response;
    }

}

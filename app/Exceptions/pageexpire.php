<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;

class pageexpire extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        //
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render($request, Throwable $e): \Symfony\Component\HttpFoundation\Response
    {
        if ($e instanceof TokenMismatchException) {
            return redirect()->route('login')->with('error', 'Your session has expired. Please log in again.');
        }
    
        return parent::render($request, $e);
    }
    
}

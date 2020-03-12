<?php namespace Extend\Filter;

use Session;
use Input;
use Log;

class SessionFilter
{
    public function filter()
    {
        $token = Session::token();

        // Session::regenerateToken();

        if ($token != Request()->input('_token'))
        {
            // Log::error('Token mismatch');

            throw new \Illuminate\Session\TokenMismatchException;
        }
    }
}
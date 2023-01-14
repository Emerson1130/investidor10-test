<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class GlobalHelper
{

    public static function getLoggedUserId(Request $request)
    {
        return $request->user()->getAttribute('id');
    }

}

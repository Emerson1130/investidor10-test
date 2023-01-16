<?php

namespace App\Validators;

use App\Models\Book;
use Illuminate\Http\Request;

//use App\Helpers\GlobalHelper;
//use App\Exceptions\NoPermissionToHandleException;

class BookValidator
{

    public function manipulation(Book $model, Request $request)
    {
        /*
          if (!$model->belongsToUser(GlobalHelper::getLoggedUserId($request))) {
              throw new NoPermissionToHandleException();
          }
         */

        return true;
    }

}

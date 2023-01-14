<?php

namespace App\Traits;

trait ControllerActions
{

    public function response(bool $status, array $response, int $httpCode)
    {
        $response['status'] = $status;

        return response()->json($response, $httpCode);
    }

}

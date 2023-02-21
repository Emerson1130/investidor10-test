<?php

namespace App\Traits;

trait WebControllerActions
{
    public function response(bool $status, string $message, string $route)
    {
        if (!$status) {
            return back()->withErrors(['message' => $message]);
        }

        return redirect($route)->with('message', $message);
    }
}

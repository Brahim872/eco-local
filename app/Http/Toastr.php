<?php

namespace App\Http;

class Toastr
{
    public function success($message)
    {
        session()->flash('success', $message);
    }

    public function warning($message)
    {
        session()->flash('warning', $message);
    }

    public function error($message)
    {
        session()->flash('error', $message);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Get the evaluated view contents for the given view.
     *
     * @param string $name
     * @return Application|Factory|View
     */
    protected function getView($name)
    {
        $view = view($name);
        $vars = $this->getViewVars();
        foreach ($vars as $name => $var) {
            $view->with($name, $var);
        }

        return $view;
    }

    /**
     * Define view vars
     *
     * @return array
     */
    protected function getViewVars()
    {
        return [];
    }
}

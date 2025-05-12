<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as LaravelBaseController;

class BaseController extends LaravelBaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function restrictToGestionnaire()
    {
        if (!session('user') || session('user')['role'] !== 'gestionnaire') {
            return redirect()->route('home')->with('error', 'Accès non autorisé.');
        }
        return null;
    }
}
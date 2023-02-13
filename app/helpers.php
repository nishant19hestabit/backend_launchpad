<?php


use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

if (!function_exists('allow')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function allow($permission)
    {
        if (!Gate::allows($permission)) {
            // abort(403, 'Permission Denied');
            denied();
        }
    }
}

if (!function_exists('denied')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function denied()
    {
        response()->json(['status' => false, 'message' => 'Permission Denied'], 403)->send();
        die;
    }
}

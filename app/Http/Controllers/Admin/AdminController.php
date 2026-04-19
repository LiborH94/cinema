<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index()
    {
        if (! Gate::allows('isAdmin')) {
            abort(404);
        }
        return view('admin.index');
    }
}

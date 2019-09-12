<?php

namespace App\Http\Controllers;

use App\Presenter;
use Illuminate\Http\Request;
use App\User;


class API_PresenterController extends Controller
{
    public function list()
    {
        return Presenter::where('estado','ACTIVO')->with('user')->get();
    }
    public function list_JSON()
    {
        return Presenter::where('estado','ACTIVO')->with('user')->get()->toJson(); 
    }
}

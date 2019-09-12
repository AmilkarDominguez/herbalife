<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;
use App\User;
use App\Auspice;
use App\Presenter;

class API_ProgramController extends Controller
{
    public function list()
    {
        return Program::where('estado','ACTIVO')->with('user','auspice','presenter')->get();
    }
    public function list_JSON()
    {
        return Program::where('estado','ACTIVO')->with('user','auspice','presenter')->get()->toJson(); 
    }
}

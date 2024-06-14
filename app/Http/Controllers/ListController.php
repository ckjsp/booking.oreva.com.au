<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller

{
    public function createlist()

    {
        return view('list.add_list');
    }

}

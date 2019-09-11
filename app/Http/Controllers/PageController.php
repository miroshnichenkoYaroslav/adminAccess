<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class PageController extends Controller
{
    public function page1(): Response
    {
        return response()->view('admin.page1');
    }

    public function page2(): Response
    {
        return response()->view('admin.page2');
    }
}

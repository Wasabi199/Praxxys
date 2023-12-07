<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class VideoController extends Controller
{
    //

    public function videoPlayer()
    {
        return Inertia::render('Praxxys/VideoPlayer');
    }
}

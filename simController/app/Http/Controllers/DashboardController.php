<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function run()
    {
        for ($i = 0; $i < 3; $i++) {
            event(new \App\Events\BaggageCreated(["id" => 1]));
            sleep(2);
        }
        return "event fired";
    }
}

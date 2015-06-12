<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Baggage;

class BaggageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $baggages = Baggage::all();
        return response()->json($baggages->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // guard the passenger_id field
        if (!$request->has('passenger_id')) {
            return response("No passenger id provided", 400);
        }

        // create a new baggage
        $passengerId = $request->input('passenger_id');
        $baggage = Baggage::create(["passenger_id" => $passengerId]);

        // return the new baggage if it was created
        if ($baggage) {
            return response()->json($baggage->toArray());
        }
        // return server error, if creation was not possible
        return response("Baggage was not created", 500);
    }
}

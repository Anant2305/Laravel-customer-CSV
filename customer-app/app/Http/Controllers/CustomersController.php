<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function importFile(Request $request) 
    {
        $results = Customer::sortCSVFile();

        return view("results",["results"=>$results]);
    }

}

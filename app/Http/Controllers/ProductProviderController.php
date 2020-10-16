<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\ProductProvider;

class ProductProviderController extends Controller
{
    public function getAll()
    {
        $providers = ProductProvider::all();
        return response()->json($providers);
    }
}

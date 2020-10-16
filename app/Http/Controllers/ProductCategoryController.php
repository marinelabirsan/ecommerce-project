<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;

class ProductCategoryController extends Controller
{
    public function getAll()
    {
        $categories = ProductCategory::all();
        return response()->json($categories);
    }
}

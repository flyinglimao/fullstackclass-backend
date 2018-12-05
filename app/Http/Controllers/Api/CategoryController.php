<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Resources\CategoryResource;
use App\Subcategory;
use App\Http\Resources\SubcategoryResource;

class CategoryController extends Controller
{
  public function index (Request $request) {

    return CategoryResource::collection(Category::all());
  }

  public function show (Request $request, Category $category) {
    return SubcategoryResource::collection(Subcategory::where('category_id', $category->id)->get());
  }
}

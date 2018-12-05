<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Subcategory;
use App\Http\Resources\CategoryResource;

class CategoryController.php extends Controller
{
  public index (Request $request) {
    return Category::all();
  }

  public show (Request $request, Category $category) {

  }

}

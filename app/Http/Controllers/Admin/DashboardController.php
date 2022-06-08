<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all()->count();
        $orders = Order::all()->count();
        $categories = Category::all()->count();
        $users = User::all()->count();

        return View::make('admin.dashboard', compact('categories','products','orders','users'));
    }
}

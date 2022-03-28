<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Product;
use App\Models\Products;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MasterController extends Controller
{
    public function showCreateUser()
    {
        return Inertia::render('Master/CreateUser');
    }
    public function showManageUnits()
    {
        return Inertia::render('Master/ManageUnits');
    }
}

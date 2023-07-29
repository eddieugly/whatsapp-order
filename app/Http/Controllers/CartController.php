<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the single category resource.
     */
    public function index()
    {

        return Inertia::render('Frontend/Cart', [
            'title' => 'Cart',
        ]);
    }
}

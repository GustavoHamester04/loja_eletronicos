<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;  
use Illuminate\Http\Request;
use App\Models\Produto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $produtos = Produto::with('fotos')->paginate(9); // carrega produtos E fotos
    return view('home', compact('produtos'));
}
}

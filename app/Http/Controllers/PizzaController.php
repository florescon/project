<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop\Speciality;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Speciality::all();

        return view(
            'pizzas.index',
            [
                'pizzas' => $pizzas
            ]
        );
    }
}

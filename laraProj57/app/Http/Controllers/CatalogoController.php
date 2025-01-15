<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodotto; // Assuming the model for 'prodotti' table is called 'Prodotto'

class Catalogocontroller extends Controller
{
    public function index()
    {
        // Fetch all products from 'prodotti' table
        $prodotti = Prodotto::all();

        // Pass the products to the view
        return view('catalogo', compact('prodotti'));
    }
}

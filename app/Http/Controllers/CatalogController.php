<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class CatalogController extends Controller
{
    public function getIndex()
    {
		return view('catalog.index', array('arrayPeliculas' => Movie::all())); // Va a la base de datos, coge todas las películas y se las pasa al catalog index a través de arrayPeliculas //

    }

    public function getShow($id)
    {
    	return view('catalog.show',
    		array(
    			'pelicula' => Movie::findOrFail($id)
    		)
    	);
    }

    public function getCreate()
    {
    	return view('catalog.create');
    }

    public function getEdit($id)
    {
    	return view('catalog.edit', array('pelicula' => Movie::findOrFail($id)));
    }

}

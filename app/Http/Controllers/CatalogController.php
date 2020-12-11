<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class CatalogController extends Controller
{
    public function getIndex() {

		return view('catalog.index', array('arrayPeliculas' => Movie::all()));

    }

    public function getShow($id) {

    	return view('catalog.show',
    		array(
    			'pelicula' => Movie::findOrFail($id)
    		)
    	);

    }

    public function getCreate() {

    	return view('catalog.create');
    }

    public function postCreate(Request $request) {

        $pelicula = new Movie();

        $pelicula->title = $request->input('title'); // El valor de estos campos inputs proveniene del name del formulario(create.blade.php), no del atributo de pelicula. Si no coinciden, no se podrá recuperar el valor.
        $pelicula->year = $request->input('year');

        $pelicula->director = $request->input('director');

        $pelicula->poster = $request->input('poster');
        // no se le da valor a rented puesto que ya está por defecto.
        $pelicula->synopsis = $request->input('synopsis');

        $pelicula->save();

        return redirect('/catalog');

    }

    public function getEdit($id) {

        return view('catalog.edit', array('pelicula' => Movie::findOrFail($id)));

    }

    public function putEdit(Request $request) {

        $id = $request->input('id');

        $pelicula = Movie::findOrFail($id);

        $pelicula->title = $request->input('title'); // El valor de estos campos inputs proveniene del name del formulario(create.blade.php), no del atributo de pelicula. Si no coinciden, no se podrá recuperar el valor.

        $pelicula->year = $request->input('year');

        $pelicula->director = $request->input('director');

        $pelicula->poster = $request->input('poster');

        // no se le da valor a rented puesto que ya está por defecto.

        $pelicula->synopsis = $request->input('synopsis');

        $pelicula->save();

        return redirect('/catalog/show/' . $id);

    }

}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use App\Http\Resources\PeliculaResource;
use Illuminate\Support\Facades\Http;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return PeliculaResource::collection(Pelicula::paginate());

    }

    public function indexOMDB($search) {

        $host = 'www.omdbapi.com';

        $response = Http::get('http://' . $host . '/', [

            'apikey' => env('OMDBAPI_KEY'),
            's' => $search,
            'page' => 1,
            'r' => 'json'

        ]);

        return response()->json(json_decode($response));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $pelicula = json_decode($request->getContent(), true);

        $pelicula = Pelicula::create($pelicula);

        return new PeliculaResource($pelicula);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function show(Pelicula $pelicula)
    {
        
        return new PeliculaResource($pelicula);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        
        $peliculaData = json_decode($request->getContent(), true);
        $pelicula->update($peliculaData);

        return new PeliculaResource($pelicula);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelicula $pelicula)
    {
        
        $pelicula->delete();

    }
}

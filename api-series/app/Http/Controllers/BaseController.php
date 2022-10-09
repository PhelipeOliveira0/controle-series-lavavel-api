<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Episodio,Serie};


abstract class BaseController extends Controller
{

    protected $classe;

    /**
     * Create a new controller instance.
     *
     * @return void
     */




    public function index(Request $request){

        $offset = ($request->page - 1) * $request->qtd_page;
        
        //return $this->classe::query()->offset($offset)->limit($request->qtd_page)->get();
        return $this->classe::paginate($request->qtd_page);


    }

    public function store(Request $request){

        return response()->json($this->classe::create($request->all()),201);
    }


    public function show(int $id){

        $recurso = $this->classe::find($id);
        if(is_null($recurso)){
            return response()->json("",204);
        }
        return $recurso;
    }


    public function update(int $id, Request $request){
        $recurso = $this->classe::find($id);

        if(is_null($recurso)){
            return response()->json(["erro"=>"paguina inesistentente"],404);
        }

        $recurso->fill($request->all());
        $recurso->save();
        return $recurso; 
    }


    public function destroy(int $id,Request $request){

        $recursoDeletada = $this->classe::destroy($id);
        if($recursoDeletada === 0){
            return response()->json(["erro"=>"recurso inesistente"],404);
        }
        return response()->json(["sucesso"=>"item deletado"],204);
    }

    public function __construct()
    {
        
    }

    //
}

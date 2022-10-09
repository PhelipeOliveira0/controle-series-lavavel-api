<?php

namespace App\Http\Controllers;

use App\Models\{Episodio,Serie};
use Illuminate\Http\Request;

class EpisodioController extends BaseController{

    
    public function __construct(){
        $this->classe = Episodio::class;
    }


    
    public function buscaSerie(Request $request,int $id){

       $ep = Episodio::query()->where("serie_id",$id)->paginate();
        return $ep;
    }


}

<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use App\Models\Serie;


class Episodio extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false; 
    public $perPage = 5;
    protected $appends = ["links"];
    protected $fillable = [
        'temporada', 'numero','assistido','serie_id',
    ];

    public function Serie(){
        return $this->belongsto(Serie::class);
    }


    public function getAssistidoAttribute(bool $assistido){
        return $assistido;
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getLinksAttribute(){
        return["series"=>"/api/series/".$this->serie_id];
    }

}

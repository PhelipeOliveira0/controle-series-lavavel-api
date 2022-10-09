<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use App\Models\episodio;

class Serie extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function episodios(){

        return $this->asMany(Episodio::class);

    }
    protected $appends = ['links'];
    public $timestamps = false;
    public $perPage = 10;
    protected $fillable = [
        'nome', 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    
    public function getLinksAttribute(){
        return ["episodios"=>"/api/series/" . $this->id . "/episodios",
                "series"=>"/api/series/".$this->id];
    }
}

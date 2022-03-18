<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupoModulo extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = ["modulo_id","grupo_id"];

    public function grupo()
    {
        return $this->hasMany(Grupo::class, 'grupo_id', 'id');        
    }
    public function modulo()
    {
        return $this->hasMany(Modulo::class, 'modulo_id', 'id');        
    }       
}

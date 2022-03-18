<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcessoGrupo extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = ["acesso_id","grupo_id"];

    public function acesso()
    {
        return $this->hasMany(Acesso::class, 'acesso_id', 'id');        
    }    
    public function grupo()
    {
        return $this->hasMany(Grupo::class, 'grupo_id', 'id');        
    }       
}

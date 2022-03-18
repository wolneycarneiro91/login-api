<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anuencia extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = ["acesso_grupo_id","grupo_modulo_id","function_id"];

    public function acesso_grupo()
    {
        return $this->hasMany(AcessoGrupo::class, 'acesso_grupo_id', 'id');        
    }     
    public function grupo_modulo()
    {
        return $this->hasMany(GrupoModulo::class, 'grupo_modulo_id', 'id');        
    }      
    public function action()
    {
        return $this->hasMany(Action::class, 'action_id', 'id');        
    }     
}

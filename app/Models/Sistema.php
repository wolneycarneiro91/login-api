<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sistema extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = ["descricao"];

    public function grupo()
    {
        return $this->hasMany(Grupo::class);
    }    

    public function usuariosistema()
    {
        return $this->belongsToMany(UsuarioSistema::class, 'sistema_id', 'id');        
    }     
    public function modulo()
    {
        return $this->belongsToMany(Modulo::class, 'sistema_id', 'id');        
    }      
}

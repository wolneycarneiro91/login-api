<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modulo extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = ["descricao","sistema_id"];

    public function sistema()
    {
        return $this->belongsTO(Sistema::class, 'sistema_id', 'id');        
    }  
    public function grupomodulo()
    {
        return $this->belongsTo(GrupoModulo::class, 'modulo_id', 'id');        
    }      
}

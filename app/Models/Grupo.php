<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = ["nome","sistema_id"];


    public function sistema()
    {
        return $this->belongsTo(Sistema::class, 'sistema_id','id');        
    } 
      
    public function grupo_modulo()
    {
        return $this->belongsTo(GrupoModulo::class, 'grupo_id', 'id');        
    }       
      
    
}

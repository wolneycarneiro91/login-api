<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Acesso extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = ["user_id","sistema_id"];

    public function user()
    {
        return $this->hasMany(User::class, 'user_id', 'id');        
    }
    public function sistema()
    {
        return $this->hasMany(Sistema::class, 'sistema_id', 'id');        
    }             
}

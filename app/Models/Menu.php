<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'user_id',
        'category_id',
        'plus_weight',
        'sharing',
        ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function sharedWithUsers(){
        return $this->belongsToMany(User::class, 'menu_user', 'menu_id', 'user_id');
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function results(){
        return $this->hasMany(Result::class);
    }
}

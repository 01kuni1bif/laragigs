<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{


    use HasFactory;

    protected $fillable =['title','company','location','website','email','discription','tags'];

    public function scopeFilter($query,array $filters){
        if($filters ['tag'] ?? false){
            $query->where('tags','like','%' .request('tag') . '%');
        }
        //schaut wo title ist wie bei request search 
        if($filters ['search'] ?? false){
            $query->where('title','like','%' .request('search') . '%')->orWhere('discription','like','%' . request('search') . '%')
            ->orWhere('tags','like','%' . request('search') . '%')
            ;
        }


    }
}

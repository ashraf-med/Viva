<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viva extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'pname','year','prname','prmark','sname','smark',
        'ename','emark','s1name','s2name','s3name','code'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}

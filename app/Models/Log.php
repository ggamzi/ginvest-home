<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = "log";
    protected $primaryKey = "id";

    protected $fillable = ['id','category','flag','ip','msg','account'];
}

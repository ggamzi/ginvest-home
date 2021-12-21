<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    use HasFactory;
    protected $table = "black_list";
    protected $primaryKey = "id";

    protected $fillable = ['id','ip','desc'];
}

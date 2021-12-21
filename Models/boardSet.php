<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class boardSet extends Model
{
    use HasFactory;
    protected $table = "board_list";
    protected $primaryKey = "id";

    protected $fillable = ['id','name','url'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class board extends Model
{
    use HasFactory;
    protected $table = "board";
    protected $primaryKey = "id";

    protected $fillable = ['user_id','board_id','nickname','view_count','title','content','thumbnail','is_view','create_date','option','notice'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class boardReview extends Model
{
    use HasFactory;
    protected $table = "board_review";
    protected $primaryKey = "id";

    protected $fillable = ['id','user_id','title','content'];
}

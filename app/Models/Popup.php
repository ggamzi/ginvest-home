<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;
    protected $table = "popup";
    protected $primaryKey = "id";

    protected $fillable = ['id','desc','img','link','start_date','end_date','width','height','top','left','order_id'];
}

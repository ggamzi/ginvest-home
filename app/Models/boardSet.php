<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sidebarSub extends Model
{
    use HasFactory;
    protected $table = "sidebar_sub";
    protected $primaryKey = "id";

    protected $fillable = ['id','name','url'];
}

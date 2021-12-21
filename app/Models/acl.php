<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acl extends Model
{
    use HasFactory;
    protected $table = "acl";
    protected $primaryKey = "id";

    protected $fillable = ['id','name','ip','is_use'];
}

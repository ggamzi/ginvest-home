<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperUser extends Model
{
    use HasFactory;
    protected $table = "experience_user";
    protected $primaryKey = "id";

    protected $fillable = ['id','name','phone','event_code','marketing','ip'];
}

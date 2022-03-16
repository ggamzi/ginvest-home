<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertEmail extends Model
{
    use HasFactory;
    protected $table = "alert_email";
    protected $primaryKey = "id";

    protected $fillable = ['name','email','is_use'];
}

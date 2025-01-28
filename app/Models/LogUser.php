<?php

namespace App\Models;

use App\Models\Traits\SourceTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUser extends Model
{
    use HasFactory,SourceTrait;
    protected $fillable=['UserID','source','data','blob'];

}

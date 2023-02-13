<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleType extends Model
{
    use HasFactory;
    protected $table = 'module_type';

    protected $primaryKey = 'id';

    protected $fillable = [
        'module_id', 'name',
    ];
}

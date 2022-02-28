<?php

namespace App\Modules\cache\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    
    protected $fillable = [
        'key',
        'value',
    ];
}

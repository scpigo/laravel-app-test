<?php

namespace App\Modules\auth\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserRefreshToken extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = ['user_id', 'token', 'ip', 'user_agent', 'expires_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

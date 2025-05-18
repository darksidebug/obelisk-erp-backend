<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use HasFactory, SoftDeletes;

    public const ROLE_USER = 'User';

    public const ROLE_ADMIN = 'Admin';

    public const ROLE_GUEST = 'Guest';

    public const ROLE_SUPER_ADMIN = 'Super-Admin';

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getRoleId($role)
    {
        return self::whereName($role)->first()?->id;
    }
}

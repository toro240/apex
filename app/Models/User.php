<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    const MAX_NAME_LENGTH = 255;
    const MIN_PASSWORD_LENGTH = 8;
    const MAX_PASSWORD_LENGTH = 20;

    public static function generateRandomPassword(): string
    {
        $password = '';
        $length = self::MIN_PASSWORD_LENGTH;
        $chars = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
        shuffle($chars);
        for ($i = 0 ; $i < $length ; $i++){
            $password = $password . $chars[$i];
        }

        return $password;
    }

    public static function create(array $attributes = []): Model|Builder
    {
        if(isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }
        return static::query()->create($attributes);
    }

    public static function getAuthorizationUser(string $name, string $password): Model|null
    {
        $user = static::query()->where('name', $name)->first();
        if (is_null($user)) {
            return null;
        }
        if (!Hash::check($password, $user->password)) {
            return null;
        }
        return $user;
    }
}

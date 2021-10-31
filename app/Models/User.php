<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    const MIN_PASSWORD_LENGTH = 8;

    public static function generateRandomPassword(): string
    {
        $password = '';
        $length = 8;
        $chars = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
        shuffle($chars);
        for ($i = 0 ; $i < $length ; $i++){
            $password = $password . $chars[$i];
        }

        return $password;
    }

    public static function create(array $attributes = [])
    {
        if(isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }
        return static::query()->create($attributes);
    }

}

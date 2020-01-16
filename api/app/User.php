<?php

namespace App;

use App\Token;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function generateToken($name)
    {
        $token = $this->tokens()->create([
            'id'    => Str::uuid(),
            'name'  => $name,
            'token' => Str::random(80),
        ]);

        return $token->token;
    }

    public function getToken($name)
    {
        return optional($this->tokens()->whereName($name)->first())->token;
    }
}

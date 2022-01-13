<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $fillable = ['name','email','senha'];
    protected $hidden = ['password'];


     // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function rules()
    {
        return [
            'name' => 'required',
            //'email' => 'required|unique:users,email,'.$this->id.'|min:3',
            'password' => 'required'
        ];
    }
    public function feedback()
    {
       return [
            'required' => 'O :attribute é obrigatório',
            'email.unique' => 'o e-mail já está cadastrado'
        ];
    }
}

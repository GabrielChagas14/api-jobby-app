<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','senha'];
    protected $hidden = ['password'];

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

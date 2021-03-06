<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User; //::create($request->all());
        $request->validate($user->rules(), $user->feedback());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::whereId($id)->first();
        if($user ===  null){
            return response()->json(['erro' => 'usuário pesquisado não existe'], 404);
        }
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    /*public function edit(User $user)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user =  User::whereId($id)->first();

        if($request->method() === 'PATCH') {

            $dynamicRules = array();

            foreach($user->rules() as $input => $rule)
            {
                if(array_key_exists($input, $request->all()))
                {
                    $dynamicRules[$input] = $rule;
                }
            }
            dd($dynamicRules);
            $request->validate($dynamicRules, $user->feedback());
        } else
        {
            $request->validate($user->rules(), $user->feedback());
        }
        if($user === null){
            return response()->json(['erro' => 'usuário pesquisado não existe'], 404);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  User::whereId($id)->first();
        if($user === null){
            return response()->json(['erro' => 'usuário pesquisado não existe'], 404);
        }
        $user->delete();
        return response()->json(['msg'=> 'User foi deletado com sucesso'], 200);
    }
}

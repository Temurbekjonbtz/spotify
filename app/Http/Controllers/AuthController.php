<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['login','signup']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    public function signup(Request $request)
    {
        User::create($request->all());
        return $this->login($request);
    }
    public function update(Request $request){
        $user=auth()->user();
        if($request->email){
            $user->email=$request->email;
            $user->save();
            return ['message'=>'Your  email is  updated  successfully','user'=>auth()->user()];
        }
       if($request->current && $request->newpassword){
           if(Hash::check($request->current,$user->password)){
               $user->password=$request->newpassword;
               $user->save();
               return ['message'=>'Your password  is  updated  successfully','user'=>auth()->user()];
           }else{
            return ['message'=>'Your current  password  is  invalied'];
           }
        }
        else{
            return ['message'=>'Something  wrong  with  your data'];
        }
        
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user'=>auth()->user()
        ]);
    }
}

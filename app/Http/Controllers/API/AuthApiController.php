<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseApiController;

class AuthApiController extends BaseApiController
{
    /**
     * Register api.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        $inputs = $request->all();
        $inputs['password'] = Hash::make($request->password);
        $user = User::create($inputs);
        // $data['token'] =  $user->createToken($user->email)->accessToken;
        $data['name'] =  $user->name;

        return $this->sendResponse('User register successfully.', $data);
    }

    /**
     * Login api.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->sendError(__('auth.failed'), ['error'=>'Unauthorised'], 403);
        }

        $user = Auth::user();
        $tokenResult = $user->createToken($user->email);

        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addMonths(1);
        }
        $token->save();

        return response()->json([
            'success' => true,
            'message' => 'User login successfully.',
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
            'access_token' => $tokenResult->accessToken
        ]);
    }

    /**
     * Logout (void the token).
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);

        return $this->sendResponse('Successfully logged out.');
    }

    /**
     * Get Authenticated User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        return $this->sendResponse('Successfully logged out.', $request->user());
    }
}

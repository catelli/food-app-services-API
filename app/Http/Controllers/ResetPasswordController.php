<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendMail;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;


class ResetPasswordController extends Controller
{   
    private $User;

    public function __construct(User $user)
    {
        $this->User = $user;
    }

    public function sendForgotPasswordMail(Request $request) 
    {
        try 
        {

            $user = $this->User->where('email', $request->email)->first();

            if(!$user) {
                return response()->json(['message' => 'User not found' ], 404); 
            }


            $data = ['nome' => $user->name, 'email' => $request->email, 'view' => 'mail.forgot-password'];

            SendMail::sendEmail($data);


        } catch(Throwable $e) {
            return response()->json(['message' => 'Server error' ], 500);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Server error' ], 500);
        }
        catch (FatalErrorException $e) {
            return response()->json(['message' => 'Server error' ], 500);
        }
    }

    public function create(Request $request) 
    {
        $email = $request->query('email');
        return view('mail.reset-password', ['email' => $email]);
    }

    public function resetPassword(Request $request) 
    {
        $user = $this->User->where('email', $request->email)->first();

        $user->password = Hash::make($request->password);

        $user->save();
        
        return view('mail.verify-email', ['nome' => $user->name]);

    }

}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendMail;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;


class VerifyEmailController extends Controller
{

    private $User;

    public function __construct(User $user)
    {
        $this->User = $user;
    }

    public function verifyEmail(Request $request) 
    {

        try 
        {
            $query = $request->query('token');
            $user = $this->User->where('api_token', $query)->first();
    
            if(\is_null($user)) {
                return response()->json(['message' => 'Token invalid'], 400);
            }
    
            $user->email_verified_at = date("Y-m-d H:i:s");
            $user->save();

            return view('mail.verify-email', ['nome' => $user->name]);
            
        } catch(Throwable $e) {
            return response()->json(['message' => 'Server error' ], 500);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Query error' ], 500);
        }
        catch (FatalErrorException $e) {
            return response()->json(['message' => 'Server error' ], 500);
        }
    }

    public function resendMail(Request $request) 
    {
        try 
        {
            $token = $request->header('Authorization');
            $user = $this->User->where('api_token', $token)->first();
    
            if(\is_null($user)) {
                return response()->json(['message' => 'Token invalid'], 400);
            }
    
            $data = ['nome' => $user->name,'email' => $user->email, 'token' => $user->api_token, 'view' => 'mail.welcome'];
            SendMail::sendEmail($data);
            
        } catch(Throwable $e) {
            return response()->json(['message' => 'Server error' ], 500);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Query error' ], 500);
        }
        catch (FatalErrorException $e) {
            return response()->json(['message' => 'Server error' ], 500);
        }

    }

}

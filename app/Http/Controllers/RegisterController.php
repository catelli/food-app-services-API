<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AddressController;
use App\Mail\SendMail;
//use App\Jobs\SendMailJob;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Debug\Exception\FatalErrorException;


class RegisterController extends Controller
{

    private $User;
    private $Address;

    public function __construct(User $user, AddressController $address)
    {
        $this->User = $user;
        $this->Address = $address;
    }

    public function signUp(Request $request)
    {
        
        try 
        {
            $user = $this->User;
            $address = $this->Address;

            $emailExists = $this->User->where('email', $request->input('user.email'))->first();
            if($emailExists) {
                return response()->json(['message' => 'User Already Exists' ], 422); 
            }

            if($request->input('user.password') != $request->input('user.password_confirmation')) {
                return response()->json(['message' => "password does not match" ], 406); 
            }
            
            $user->name = $request->input('user.name');
            $user->phone = $request->input('user.phone');
            $user->email = $request->input('user.email');
            $user->password = Hash::make($request->input('user.password'));
            $user->api_token = Str::random(60);
            $user->roles = 'user';
            
          
            $addresses = $request->input('addresses');
       

            if($user->save()) {

                foreach($addresses as $a){

                    DB::table('addresses')->insert([
                        'street' => $a['street'],
                        'number' => $a['number'],
                        'district' => $a['district'],
                        'complement' => $a['complement'],
                        'state' => $a['state'],
                        'city' => $a['city'],
                        'zip_code' => $a['zip_code'],
                        'user_id' => $user->id
                    ]);

                }
                


                $data = ['nome' => $user->name,'email' => $user->email, 'token' => $user->api_token, 'view' => 'mail.welcome'];
                /*  * send mail with jobs
                    *$this->dispatch(new SendMailJob($data));
                */
                SendMail::sendEmail($data);

                return response()->json(['token' => $user->api_token, 'email' => $user->email], 201);  
            } 

        } 
        catch(Throwable $e) {
            return response()->json(['message' => 'Server error' ], 500);
        }
        catch (FatalErrorException $e) {
            return response()->json(['message' => 'Server error' ], 500);
        }
    }

    public function signIn(Request $request)
    {

        try
        {

            $userExists = $this->User->where('email', $request->email)->first();
            
            if(empty($userExists->email))
            {
                return response()->json(['message' => "Email not exists" ], 406); 
            }
    
            if (Hash::check($request->password, $userExists->password)) {
                $userExists->api_token = Str::random(60);
                $userExists->save();
                return response()->json(['token' => $userExists->api_token ], 200); 
                
            } else {
                return response()->json(['message' => "password does not match" ], 406); 
            }

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

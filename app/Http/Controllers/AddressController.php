<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;


class AddressController extends Controller
{

    private $Address;

    public function __construct(Address $address)
    {
        $this->Address = $address;
    }

    public function create(Request $request)
    {
        $address = $this->Address;

        $address->street = $request->input('street');
        $address->number = $request->input('number');
        $address->complement = $request->input('complement');
        $address->district = $request->input('district');
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->zip_code = $request->input('zip_code');
        $address->user_id = $request->input('user_id');

        $address->save();
    }

    public function show($id) 
    {
        try 
        {
        
            $address = $this->Address->where('user_id', $id)->get();

            return $address;

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

    public function update(Request $request)
    {
        try 
        {

           
                        
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

    public function destroy(Request $request) 
    {
        try {


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
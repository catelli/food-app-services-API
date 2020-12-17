<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
//use App\Http\Requests\ProductRequest;
use App\Exceptions\Handler;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class OrderController extends Controller {

    private $Order;
    private $OrderItems;
    private $user;

    public function __construct (Order $order, OrderItem $orderItems, User $user)
    {
        $this->Order = $order;
        $this->OrderItems = $orderItems;
        $this->User = $user;
    }

    public function index(Request $request) {

        $token = $request->header('Authorization');

        if(!$token) {
            return response()->json(['message' => 'Invalid token' ], 404); 
        }

        $user = $this->User->where('api_token', $token)->first();

        $orders = $this->Order->where('user_id', $user->id)->get();

        return response()->json($orders, 200);
    }

    public function store(Request $request) {

        try 
        {
            $order = $this->Order;
            $orderItems = $this->OrderItems;

            $token = $request->header('Authorization');

            if(!$token) {
                return response()->json(['message' => 'Invalid token' ], 404); 
            }

            $user = $this->User->where('api_token', $token)->first();

            $order->id = hexdec(uniqid());
            $order->user_id = $user->id;
            $order->date = time();
            $order->code = $order->id.$order->date;
            $order->total_value = $request->total_value;

            if($order->save()) {

                $products = $request->products;
                foreach($products as $product ) {
                    DB::table('order_items')->insert([
                        'product_id' => $product['product_id'],
                        'order_id' => $order['id'],
                        'quantity' => $product['quantity'],
                        'partial_value' => $product['unitary_value'] * $product['quantity'],
                        'unitary_value' => $product['unitary_value'],
                        'created_at' => $order->created_at,
                        'updated_at' => $order->created_at,
                    ]);
                }

            }


            return response()->json($order, 200);
                        
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
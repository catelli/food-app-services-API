<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\User;
use App\Models\Order;
//use App\Http\Requests\ProductRequest;
use App\Exceptions\Handler;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class OrderItemsController extends Controller {

    private $OrderItems;
    private $Order;
    private $user;

    public function __construct (OrderItem $orderItems, Order $order, User $user)
    {
        $this->Items = $orderItems;
        $this->Order = $order;
        $this->User = $user;
    }

    public function index(Request $request) {

        $token = $request->header('Authorization');

        if(!$token) {
            return response()->json(['message' => 'Invalid token' ], 404); 
        }

        $user = $this->User->where('api_token', $token)->first();

        $orderItems = DB::table('order_items')
                        ->join('orders', 'orders.id', '=', 'order_items.order_id')
                        ->join('products', 'products.id', '=', 'order_items.product_id')
                        ->select('orders.id as id_order', 'products.*', 'order_items.created_at', 'order_items.id as id_orderitems')
                        ->where('orders.user_id', $user->id)
                        ->orderBy('order_items.created_at', 'desc')
                        ->paginate(15);

        return response()->json($orderItems, 200);
    }

    /*public function store(Request $request) {

        try 
        {
            $order = $this->Order;

            $token = $request->header('Authorization');

            if(!$token) {
                return response()->json(['message' => 'Invalid token' ], 404); 
            }

            $user_id = $this->User->select('id')->where('api_token', $token)->first();

            $order->user_id = $user_id;
            $order->date = Date('dMhs');
            $order->id = uniqid();
            $order->code = $order->id.$order->date;
            $order->total_value = $request->total_value;

            return response()->json($order->total_value, 200);
                        
        } catch(Throwable $e) {
            return response()->json(['message' => 'Server error' ], 500);
        }
        catch (QueryException $e) {
            return response()->json(['message' => 'Query error' ], 500);
        }
        catch (FatalErrorException $e) {
            return response()->json(['message' => 'Server error' ], 500);
        }
    }*/
}
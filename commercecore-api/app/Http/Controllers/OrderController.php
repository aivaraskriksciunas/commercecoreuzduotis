<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Orders\SubmitOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function submit( SubmitOrderRequest $request )
    {
        $order = new Order( $request->validated() );
        
        if ( !$this->validate_credit_card( 
            $request->card_number, 
            $request->card_security_code, 
            $request->expiration_year, 
            $request->expiration_month ))
        {
            return Response([
                'message' => "Invalid card. Could not complete purchase."
            ], 400 );
            
        }
        
        $product = Product::find( $order->product_id );
        $order->unit_price = $product->discounted_price ?? $product->unit_price_usd;
        $order->amount = $product->amount;
        $order->save();

        return Response([
            'message' => "Thank you for your order, {$order->first_name} {$order->last_name}"
        ]);
    }

    private function validate_credit_card( $number, $cvv, $year, $month )
    {
        // Validate credit card
        $card_expires = Carbon::createFromDate(  
            2000 + $year, $month, 1
        );

        if ( strlen( $number ) == 16 &&
            $cvv == 100 &&
            $card_expires > Carbon::now())
        {
            return true;
        }

        return false;
    }
}

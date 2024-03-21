<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use App\User;
use Stripe;
use App\Models\Wallet;
use Stripe\Error\Card;
// use Cartalyst\Stripe\Stripe;
class MoneySetupController extends Controller
{
    public function paymentStripe()
    {
        return view("paymentstripe");
    }
    public function postPaymentStripe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "card_no" => "required",
            "ccExpiryMonth" => "required",
            "ccExpiryYear" => "required",
            "cvvNumber" => "required",
            //'amount' => 'required',
        ]);
        $input = $request->all();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));	
		$response = \Stripe\Token::create(array(
		  	"card" => array(
		    "number"    => $request->input('card_no'),
		    "exp_month" => $request->input('ccExpiryMonth'),
		    "exp_year"  => $request->input('ccExpiryYear'),
		    "cvc"       => $request->input('cvvNumber'),
		    "name"      => 'Zain Ul Rauf'
		)));
		$response=$response->toArray();
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $response['id'],
                "description" => "Zain Ul Rauf" 
        ]);
        $input=$request->all();
        $input['currency']="pkr";
        $input['user_id']=1;
        $input['amount']="100";
        Wallet::create($input);
        Session::flash('success', 'Payment successful!');
        return back();
    }
}

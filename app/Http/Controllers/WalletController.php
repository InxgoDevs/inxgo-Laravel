<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\WalletInformation;
use Illuminate\Support\Facades\Response;

class WalletController extends Controller
{
	public function buyer(Request $request)
	{
		$validator = Validator::make($request->all(), [
		    'buyer_id'=>'required',
		]);
        if ($validator->fails()) { 
            return response()->json($validator->messages());
        }
        $data=WalletInformation::where('buyer_id',$request->buyer_id)->with('buyer')->get()->toArray();
        return Response::json(['data' => $data], 200);
	}
	public function seller(Request $request)
	{
		$validator = Validator::make($request->all(), [
		    'seller_id'=>'required',
		]);
        if ($validator->fails()) { 
            return response()->json($validator->messages());
        }
        $data=WalletInformation::where('seller_id',$request->seller_id)->with('seller')->get()->toArray();
    	return Response::json(['data' => $data], 200);
	}
    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
		    'seller_id' => 'required',
		    'buyer_id'=>'required',
		    'job_id'=>'required',
		    'amount'=>'required',
		    'currency'=>'required',
		]);

        if ($validator->fails()) { 
            return response()->json($validator->messages());
        }
        $twenty=$this->get20Percentage($request->amount,20);
        	//charity 
        $two=$this->get20Percentage($request->amount,2);
        	//medical
        $three=$this->get20Percentage($request->amount,3);
        // dd($two,$three);
        $sellerAmount=$request->amount+$twenty+$two+$three;
        $buyerAmount=($request->amount-$twenty)-$two-$three;
        $companyAmount=$twenty+$twenty;
        $companyMedical=$sellerAmount-$buyerAmount-$companyAmount;

        $data['seller_amount']=$sellerAmount;
        $data['buyer_amount']=$buyerAmount;
        $data['company_profit']=$companyAmount;
        $data['medical_charity']=$companyMedical;
        $data['currency']=$request->currency;
        $data['job_id']=$request->job_id;
        $data['seller_id']=$request->seller_id;
        $data['buyer_id']=$request->buyer_id;
        $data['amount']=$request->amount;
        WalletInformation::create($data);
        $data = ['message' => 'Amount Successfully added in wallet.!'];
    	return response()->json($data, 204);
    }
    public function get20Percentage($amount,$percentage)
    {
		return $amount*($percentage/100);
    }
}

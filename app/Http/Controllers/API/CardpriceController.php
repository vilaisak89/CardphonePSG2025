<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cardprice;

class CardpriceController extends Controller
{
    //
    public function index(){
        //1. $cardp = Cardprice::all();
        // return response()->json($cardp);

        //2. $cardp = Cardprice::orderBy('id','desc')
        // ->paginate(10)
        // ->toArray();
        // return response()->json($cardp);

        //3.  $sort = \Request::get('sort');

        // $cardp = Cardprice::orderBy('id', $sort)
        // ->paginate(10)
        // ->toArray();
        // return response()->json($cardp);

        //4. $sort = \Request::get('sort');
        // $perpage = \Request::get('perpage');

        // $cardp = Cardprice::orderBy('id', $sort)
        // ->paginate($perpage)
        // ->toArray();
        // return response()->json($cardp);

        //5. $sort = \Request::get('sort');
        // $perpage = \Request::get('perpage');
        // $search = \Request::get('search');

        // $cardp = Cardprice::orderBy('id', $sort)
        // ->where(function ($query) use ($search) { 
        //      $query->where('price', 'like', '%' . $search . '%');
        //  })
        // ->paginate($perpage)
        // ->toArray();
        // return response()->json($cardp);

        //6. $sort = \Request::get('sort');
        // $perpage = \Request::get('perpage');
        // $search = \Request::get('search');
        // $cardtype = \Request::get('cardtype');

        // $cardp = Cardprice::orderBy('id', $sort);
        // if($cardtype != 'all'){
        //     $cardp = $cardp->where('cardtype_id', $cardtype);
        // }
        // $cardp = $cardp->where(
        //      function ($query) use ($search) { 
        //      $query->where('price', 'like', '%' . $search . '%');
        //      }
        //  )
        // ->paginate($perpage)
        // ->toArray();
        // return response()->json($cardp);

        $Sortcp = \Request::get('sortcp');
        $perpage = \Request::get('perpage');
        $search = \Request::get('search');
        $cardtype = \Request::get('cardtype');

        $cardp = Cardprice::join('cardtypes','cardprices.cardtype_id','=','cardtypes.id')
        ->select('cardprices.*','cardtypes.cardtype_name')
        ->orderBy('cardprices.id', $Sortcp);
        if($cardtype != 'all'){
            $cardp = $cardp->where('cardprices.cardtype_id', $cardtype);
        }
        $cardp = $cardp->where(
            function ($query) use ($search) {
                $query->where('cardprices.price', 'like', '%' . $search . '%');
            })
        ->paginate($perpage)
        ->toArray();
        return response()->json($cardp);

    }

    public function add(Request $request){
        try {
            $cardp = new Cardprice([
                'cardtype_id' => $request->cardtype_id,
                'price' => $request->price
            ]);
            $cardp->save();

            $success = true;
            $message = 'ບັນທຶກຂໍ້ມູນສຳເລັດ';
            
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];
        return response()->json($response);
    }

    public function edit($id){
        $cardp = Cardprice::find($id);
        return response()->json($cardp);
    }

    public function update($id, Request $request){
        try {
            $cardp = Cardprice::find($id);

            $cardp->update([
                'cardtype_id' => $request->cardtype_id,
                'price' => $request->price
            ]);

            $success = true;
            $message = 'ອັບເດດຂໍ້ມູນສຳເລັດ';
            
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];
        return response()->json($response);
    }

    public function delete($id){
        try {
            $cardp = Cardprice::find($id);
            $cardp->delete();

            $success = true;
            $message = 'ລຶບຂໍ້ມູນສຳເລັດ!';

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cardtype;

class CardtypeController extends Controller
{
    //
    public function index(){
        $cardt = Cardtype::all();
        return response()->json($cardt);
    }

    public function add(Request $request){
        try {
            $cardt = new Cardtype([
                'cardtype_name' => $request->cardtype_name,
            ]);
            $cardt->save();

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
        $cardt = Cardtype::find($id);
        return response()->json($cardt);
    }

    public function update($id, Request $request){
        try {
            $cardt = Cardtype::find($id);

            $cardt->update([
                'cardtype_name' => $request->cardtype_name,
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
            $cardt = Cardtype::find($id);
            $cardt->delete();

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

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    //
    public function index(){
        $comp = Company::all();
        return response()->json($comp);
    }

    public function add(Request $request){
        try {
            $comp = new Company([
                'name_company' => $request->name_company,
                'fullname_company' => $request->fullname_company,
                'remark' => $request->remark,
            ]);
            $comp->save();

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
        $comp = Company::find($id);
        return response()->json($comp);
    }

    public function update($id, Request $request){
        try {
            $comp = Company::find($id);

            $comp->update([
                'name_company' => $request->name_company,
                'fullname_company' => $request->fullname_company,
                'remark' => $request->remark,
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
            $comp = Company::find($id);
            $comp->delete();

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

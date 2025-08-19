<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deparment;

class DeparmentController extends Controller
{
    //
    public function index(){
        $sort = \Request::get('sort');
        $perpage = \Request::get('perpage');
        $search = \Request::get('search');
        $company = \Request::get('company');

        // $dep = Deparment::orderBy('id', $sort)
        // ->where(
        //     function($query) use ($search){
        //         $query->where('name_deparment','like','%'.$search.'%');
        //     }
        // )
        // ->paginate($perpage)
        // ->toArray();
        // return response()->json($dep);
        
        // $dep = Deparment::orderBy('id', $sort);
        // if($company != 'all'){
        //     $dep = $dep->where('company_id', $company);
        // }
        // $dep = $dep->where(
        //     function($query) use ($search){
        //         $query->where('name_deparment','like','%'.$search.'%');
        //     }
        // )
        // ->paginate($perpage)
        // ->toArray();

        // return response()->json($dep);

        $dep = Deparment::join('companies','deparments.company_id','=','companies.id')
            ->select('deparments.*','companies.name_company','companies.fullname_company')
            ->orderBy('deparments.id', $sort);

            if($company != 'all'){
                $dep = $dep->where('deparments.company_id', $company);
            }
            $dep = $dep->where(function($query) use ($search){
                    $query->where('deparments.name_deparment','like','%'.$search.'%');
                }
            )
            ->paginate($perpage)
            ->toArray();

        return response()->json($dep);   
    }

    public function add (Request $request){
        try {
            $dep = new Deparment([
                'company_id' => $request->company_id,
                'name_deparment' => $request->name_deparment,
                'remark' => $request->remark,
            ]);
            $dep->save();

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
        $dep = Deparment::find($id);
        return response()->json($dep);
    }

    public function update($id, Request $request){
        try {
            $dep = Deparment::find($id);

            $dep->update([
                'company_id' => $request->company_id,
                'name_deparment' => $request->name_deparment,
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
            $dep = Deparment::find($id);
            $dep->delete();

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

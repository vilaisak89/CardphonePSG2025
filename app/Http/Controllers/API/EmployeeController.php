<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //
    public function index(){
        $sort = \Request::get('sort');
        $perpage = \Request::get('perpage');
        $search = \Request::get('search');
        $company = \Request::get('company');
        $deparment = \Request::get('deparment');
        
        $emp = Employee::join('companies','employees.company_id','=','companies.id')
            ->join('deparments', 'employees.deparment_id', '=', 'deparments.id')
        ->select('employees.*','companies.name_company','deparments.name_deparment')
        ->orderBy('employees.id', $sort);

        if($company != 'all'){
            $emp = $emp->where('employees.company_id', $company);
        }

        if($deparment != 'all'){
            $emp = $emp->where('employees.deparment_id', $deparment);
        }

        $emp = $emp->where(
            function ($query) use ($search) {
            $query->where('employees.employee_name', 'like', '%' . $search . '%')
            ->orwhere('employees.costcenter', 'like', '%' . $search . '%');
            }
        )
        ->paginate($perpage)
        ->toArray();
        return response()->json($emp);
    }

    public function add(Request $request){
        try {
            //path upload
            $upload_path = "assets/img";

            if($request->file('employee_img')){
                // gen image name 
                $new_name_img = time().".".$request->employee_img->getClientOriginalExtension();
                // upload
                $request->employee_img->move(public_path($upload_path),$new_name_img);
            } else {
                $new_name_img = "";
            }
            $emp = new Employee([
                'company_id' => $request->company_id,
                'deparment_id' => $request->deparment_id,
                'employee_name' => $request->employee_name,
                'employee_img' => $new_name_img,
                'position' => $request->position,
                'costcenter' => $request->costcenter,
                'lgaccount' => $request->lgaccount,
                'employee_phone' => $request->employee_phone,
                'remark' => $request->remark,
            ]);
            $emp->save();

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
        $emp = Employee::find($id);
        return response()->json($emp);
    }

    public function update($id, Request $request){
        try {
            $emp = Employee::find($id);
            $upload_path = "assets/img";

            //Check image, have new image upload
            if($request->file('employee_img')){
                // delete old image (if have)
                if($emp->employee_img){
                    if(file_exists(public_path($upload_path.'/'.$emp->employee_img))){
                        unlink(public_path($upload_path.'/'.$emp->employee_img));
                    }
                }
                // gen new name image 
                $new_name_img = time().".".$request->employee_img->getClientOriginalExtension();
                // move file to path
                $request->employee_img->move(public_path($upload_path),$new_name_img);
                
                //update data with image name
                $emp->update([
                'company_id' => $request->company_id,
                'deparment_id' => $request->deparment_id,
                'employee_name' => $request->employee_name,
                'employee_img' => $new_name_img,
                'position' => $request->position,
                'costcenter' => $request->costcenter,
                'lgaccount' => $request->lgaccount,
                'employee_phone' => $request->employee_phone,
                'remark' => $request->remark,
            ]);

            } else {
                //if don't have upload image
                if($request->employee_img){
                    //update data but don't change image
                    $emp->update([
                        'company_id' => $request->company_id,
                        'deparment_id' => $request->deparment_id,
                        'employee_name' => $request->employee_name,
                        // 'employee_img' => $new_name_img,
                        'position' => $request->position,
                        'costcenter' => $request->costcenter,
                        'lgaccount' => $request->lgaccount,
                        'employee_phone' => $request->employee_phone,
                        'remark' => $request->remark,
                    ]);
                } else {
                    //don't have image and want to delete image
                    if($emp->employee_img != ""){
                        if(file_exists($upload_path.'/'.$emp->employee_img)){
                            unlink($upload_path.'/'.$emp->employee_img);
                        }
                    }
                    //Update data and clear image value
                    $emp->update([
                        'company_id' => $request->company_id,
                        'deparment_id' => $request->deparment_id,
                        'employee_name' => $request->employee_name,
                        'employee_img' => "",
                        'position' => $request->position,
                        'costcenter' => $request->costcenter,
                        'lgaccount' => $request->lgaccount,
                        'employee_phone' => $request->employee_phone,
                        'remark' => $request->remark,
                    ]);
                }
            }

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
            $emp = Employee::find($id);
            $upload_path = "assets/img";

            if($emp){
                if($emp->employee_img != ""){
                    if(file_exists($upload_path.'/'.$emp->employee_img)){
                        unlink($upload_path.'/'.$emp->employee_img);
                    }
                }
                $emp->delete();
                $success = true;
                $message = 'ລຶບຂໍ້ມູນສຳເລັດ!';
            } else {
                $success = false;
                $messeage = 'ບໍ່ພົບຂໍ້ມູນ!';
            }

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

<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Activation;
use App\Models\Log;

class ApiController extends Controller
{
    // protected $signature = 'abcd1234+/,';

    // public function __construct() {

    //     $return = array('error' => '0', 'errors' => array());
	// 	$headers = request()->headers->all();

	// 	if ( !$this->validate_signature($headers) ) {
	// 		$return['error'] = '1';
	// 		$return['errors'][] = array('signature' => 'Invalid signature');
	// 		die(json_encode($return));
	// 	}
    // }

    // public function validate_signature($headers) {
    //     return ( isset($headers['signature'][0]) && $headers['signature'][0] == $this->signature )
    //         ? true : false;
    // }
  
    public function login(Request $request)
    {
        $return = array('error' => '0', 'success' => '0', 'errors' => array());
        $employee = Employee::where('key', $request->key)->first();
        
        if (!$employee) {

            $return['error'] = '1';
            $return['errors'][] = array(
                'Key' => 'Invalid Employee Key',
            );
        } else {
            $return['success'] = '1';
        }
        
        return response()->json($return);
    }
    
    public function activation(Request $request) {

        $return = array('error' => '0', 'success' => '0', 'errors' => array());

        if($request->key !== null){
            $activation = Activation::where('employee_key', $request->key)->first();
            
            if ($activation) {

                $return['error'] = '1';
                $return['errors'][] = array(
                    'Key' => 'Key already activated',
                );
            } else {
                $employee = Employee::where('key', $request->key)->first();
                
                if (!$employee) {
                    $return['error'] = '1';
                    $return['errors'][] = array(
                        'Key' => 'Invalid Employee Key',
                    );
                } else {
                    $validator = Validator::make($request->all(), [
                        'key' => 'required',
                        'mac_address' => 'required',
                    ]);

                    if ($validator->fails()) {
                        $return['error'] = '1';
                        $return['errors'] = $validator->errors();
                        return response()->json($return);
                    }
                    $activation = new Activation;
                    $activation->employer_id = $employee->employer_id;
                    $activation->employee_id = $employee->employee_id;
                    $activation->mac_address = $request->mac_address;
                    $activation->employee_key = $request->key;
                    $activation->is_active = 1;
                    $activation->save();

                    $return['success'] = '1';
                    $return['employee'] = $employee;
                }
            }
        }
        return response()->json($return);
    }

    public function logs(Request $request)
    {
        // dd($request);
        $return = array('error' => '0', 'success' => '0', 'html' => array());
        $validator = Validator::make($request->all(), [
            'key' => 'required',
            'total_usage' => 'required|numeric',
            'idle_time' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $return['error'] = '1';
            $return['errors'] = $validator->errors();
            return response()->json($return);
        }

        if($request->key !== null){
            $employee = Employee::where('key', $request->key)->first();

            if($employee){

                $currentDate = Carbon::today();
                $log_exist = Log::where('employee_id', $employee->employee_id)->whereDate('created_at', $currentDate)->first();

                if($log_exist){
                   
                        $log = $log_exist;

                        // $total_Usage = $log->total_usage + $request->total_usage;
                        // $idle_Time = $log->idle_time + $request->idle_time;
                    
                        $log->total_usage = $request->total_usage;
                        $log->idle_time = $request->idle_time;
                      
                        $log->save();
                        $return['success'] = '1';
                        $return['html'][] = array(
                            'msg' => 'Updated',
                        );
                }
                else{
                    
                    $log = new Log;
                    $log->employee_id = $employee->employee_id;
                    $log->employer_id = $employee->employer_id;
                    $log->log_type = $request->log_type;
                    $log->total_usage = $request->total_usage;
                    $log->idle_time = $request->idle_time;
                    $log->save();
                    $return['success'] = '1';
                    $return['html'][] = array(
                        'msg' => 'Created',
                    );
                }
            }
            else{
                $return['error'] = '1';
                $return['html'][] = array(
                    'Key' => 'Invalid Key',
                );
            }
        }
        else{
            $return['error'] = '1';
            $return['html'][] = array(
                'Key' => 'Key is null',
            );
        }
        return response()->json($return);
    }

}
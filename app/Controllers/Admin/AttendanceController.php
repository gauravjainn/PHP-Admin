<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CheckIn;
use App\Models\Leaves;
use App\Models\UserModel;
use App\Models\NotCheckin;

// Import Excel Package
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AttendanceController extends BaseController
{
    // this method is to show the checkin list of users
    public function index()
    {
       return view('admin/admin_attendance/index');
    }

    // this method is use to load the user checkin data
    public function loadCheckin()
    {
        // echo "<pre>";
        // print_r($this->request->getVar("emp_code"));
        // die;

        $from_date = $this->request->getVar('from_date');
        $to_date = $this->request->getVar('To_date');
        $employee_code = $this->request->getVar('emp_code');

    //    $get_date = $this->request->getVar('date_pick');
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];

        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";

        /* If we pass any extra data in request from ajax */
        // $value1 = isset($get_date)? $get_date:"";

        $value1 =  isset($from_date)? $from_date:"";
        $value2 =  isset($to_date) ? $to_date:"";
        $value3 = isset($employee_code) ? $employee_code:"";

        /* Value we will get from typing in search */
        // $search_value = $_REQUEST['search']['value'];
        
        // $model = new CheckIn;
        $db      = \Config\Database::connect();
        $data = [];

        $fetch = $db->table("checkins"); 
        $fetch->select('users.employee_code as emp_code,users.id,users.name,checkins.status as checkstatus,checkins.date_time as date');
        $fetch->join('users', 'users.id = checkins.user_id');

        if(isset($value3) && !empty($value3))
        {
            $fetch->where('users.employee_code',$value3);
        }

        if(isset($value1) && !empty($value1) && isset($value2) && !empty($value2))
        {
            $fetch->where('checkins.date >=',$value1);
            $fetch->where('checkins.date <=',$value2);
        }
        elseif($value1!="" || $value2!="")
        {
            if($value1!="")
            {
                $fetch->where('checkins.date',$value1);
            }
            else
            {
                $fetch->where('checkins.date',$value2);
            }

        }
        else
        {
            $current_date = date('Y-m-d');
            $fetch->where('date',$current_date);
        }
       
        $result = $fetch->orderBy('checkins.id','DESC')->limit($length,$start)->get()->getResultArray();
        $counting = count($result);

        $no = 0;
        foreach ( $result as $customers) {
           $no++;
           $row = array();
           $row['id'] = $no;
           $row['employee_code'] = $customers['emp_code'];
           $row['name'] = $customers['name'];
           $checkin_status = $customers['checkstatus'];
           if($checkin_status == 1)
           {
              $row['status'] = "CheckIn";
           }
           $row['date'] = date('d-m-Y h:i:s',strtotime($customers['date']));
           
           $row['action'] = checkin_view($customers['id']);
           $data[] = $row;
       }
        
        $json_data = array(
            "draw" => intval($params['draw']),
            "recordsTotal" => $counting,
            "recordsFiltered" => $counting,
            "data" => $data   // total data array
        );

        echo json_encode($json_data);

    }

    // this method is use to show the list of leaves user
    public function userLeaves()
    {
        return view('admin/admin_attendance/leaves');
    }

    // this method is use to load the user leaves data
    public function loadLeaves()
    {
      $from_date = $this->request->getVar('from_date');
        $to_date = $this->request->getVar('To_date');
        $employee_code = $this->request->getVar('emp_code');
        
        // $get_date = $this->request->getVar('date_pick');

        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];

        
        $value1 =  isset($from_date)? $from_date:"";
        $value2 =  isset($to_date) ? $to_date:"";
        $value3 = isset($employee_code) ? $employee_code:"";

        $db      = \Config\Database::connect();
        $data = [];

        $fetch = $db->table("leaves");
        $fetch->select('users.employee_code as emp_code,users.id,users.name,leaves.status as checkstatus,leaves.date_time as date');
        $fetch->join('users', 'users.id = leaves.user_id');

        if(isset($value3) && !empty($value3))
        {
            $fetch->where('users.employee_code',$value3);
        }

        if(isset($value1) && !empty($value1) && isset($value2) && !empty($value2))
        {
            $fetch->where('leaves.date >=',$value1);
            $fetch->where('leaves.date <=',$value2);
        }
        elseif($value1!="" || $value2!="")
        {
            if($value1!="")
            {
                $fetch->where('leaves.date',$value1);
            }
            else
            {
                $fetch->where('leaves.date',$value2);
            }

        }
        else
        {
            $current_date = date('Y-m-d');
            $fetch->where('date',$current_date);
        }

        $result = $fetch->orderBy('leaves.id','DESC')->limit($length,$start)->get()->getResultArray();
        $counting = count($result);

        $no = 0;
        foreach ( $result as $customers) {
           $no++;
           $row = array();
           $row['id'] = $no;
           $row['employee_code'] = $customers['emp_code'];
           $row['name'] = $customers['name'];
           $checkin_status = $customers['checkstatus'];
           if($checkin_status == 1)
           {
              $row['status'] = "Leave";
           }
           $row['date'] = date('d-m-Y h:i:s', strtotime($customers['date']));
           $row['action'] = leave_view($customers['id']);
           $data[] = $row;
       }
        
        $json_data = array(
            "draw" => intval($params['draw']),
            "recordsTotal" => $counting,
            "recordsFiltered" => $counting,
            "data" => $data   // total data array
        );

        echo json_encode($json_data);
    }

    // this method is use to export the data
    public function exportData()
    {
       $export_date = $this->request->getVar('btn');
       $from_date = $this->request->getVar('from_date');
       $to_date =  $this->request->getVar('to_date');
       $emp_code = $this->request->getVar('emp_code');

       $from_date =  isset($from_date)? $from_date:"";
       $to_date =  isset($to_date) ? $to_date:"";
       $emp_code = isset($emp_code) ?  $emp_code:"";

        $db      = \Config\Database::connect();

        $fetch = $db->table("checkins"); 
        $fetch->select('users.employee_code as emp_code,users.name,checkins.status as checkstatus,checkins.created_at as date');
        $fetch->join('users', 'users.id = checkins.user_id');

        if(isset($emp_code) && !empty($emp_code))
        {
            $fetch->where('users.employee_code',$emp_code);
        }

        if(isset($from_date) && !empty($from_date) && isset($to_date) && !empty($to_date))
        {
            $fetch->where('checkins.date >=',$from_date);
            $fetch->where('checkins.date <=',$to_date);
        }
        elseif($from_date!="" || $to_date!="")
        {
            if($from_date!="")
            {
                $fetch->where('checkins.date',$from_date);
            }
            else
            {
                $fetch->where('checkins.date',$to_date);
            }

        }
        else
        {
            $current_date = date('Y-m-d');
            $fetch->where('date',$current_date);
        }
       
        $result = $fetch->orderBy('checkins.id','DESC')->get()->getResultArray();

       if($export_date == "excel")
       {

        $fileName = 'checkin.xlsx'; // File is to create

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Id');
		$sheet->setCellValue('B1', 'Employee Code');
		$sheet->setCellValue('C1', 'Name');
		$sheet->setCellValue('D1', 'status');
		$sheet->setCellValue('E1', 'date/time');

        $rows = 2;

        $n =0;
        foreach ( $result as $val) {
            $n++;
			$sheet->setCellValue('A' . $rows, $n);
			$sheet->setCellValue('B' . $rows, $val['emp_code']);
			$sheet->setCellValue('C' . $rows, $val['name']);
            if($val['checkstatus'] == 1)
            {
            $sheet->setCellValue('D' . $rows, 'checkin');
            }
			
			$sheet->setCellValue('E' . $rows, date('d-m-Y h:i:s', strtotime($val['date'])));

            $rows++;
		}

        $writer = new Xlsx($spreadsheet);

		// file inside /public folder
		$filepath = $fileName;

		$writer->save($filepath);

		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');

		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		flush(); // Flush system output buffer
		readfile($filepath);

		exit;
       }
       else
       {
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml(view('admin/admin_attendance/checkin-pdf', ["result" => $result]));

            // setting paper to portrait, also we have landscape
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            // Download pdf
            $dompdf->stream();

       }
    }
    
    // this method is use to export leave data
    public function exportLeaveData()
    {
        $export_date = $this->request->getVar('btn');
        $from_date = $this->request->getVar('from_date');
        $to_date =  $this->request->getVar('to_date');
        $emp_code = $this->request->getVar('emp_code');
 
        $from_date =  isset($from_date)? $from_date:"";
        $to_date =  isset($to_date) ? $to_date:"";
        $emp_code = isset($emp_code) ?  $emp_code:"";
 
         $db      = \Config\Database::connect();
 
         $fetch = $db->table("leaves");
         $fetch->select('users.employee_code as emp_code,users.name,leaves.status as checkstatus,leaves.created_at as date');
         $fetch->join('users', 'users.id = leaves.user_id');
 
         if(isset($emp_code) && !empty($emp_code))
         {
             $fetch->where('leaves.employee_code',$emp_code);
         }
 
         if(isset($from_date) && !empty($from_date) && isset($to_date) && !empty($to_date))
         {
             $fetch->where('leaves.date >=',$from_date);
             $fetch->where('leaves.date <=',$to_date);
         }
         elseif($from_date!="" || $to_date!="")
         {
             if($from_date!="")
             {
                 $fetch->where('leaves.date',$from_date);
             }
             else
             {
                 $fetch->where('leaves.date',$to_date);
             }
 
         }
         else
         {
             $current_date = date('Y-m-d');
             $fetch->where('date',$current_date);
         }
        
         $result = $fetch->orderBy('leaves.id','DESC')->get()->getResultArray();
 
        if($export_date == "excel")
        {
 
         $fileName = 'leave.xlsx'; // File is to create
 
         $spreadsheet = new Spreadsheet();
 
         $sheet = $spreadsheet->getActiveSheet();
         $sheet->setCellValue('A1', 'Id');
         $sheet->setCellValue('B1', 'Employee Code');
         $sheet->setCellValue('C1', 'Name');
         $sheet->setCellValue('D1', 'status');
         $sheet->setCellValue('E1', 'date/time');
 
         $rows = 2;
 
         $n =0;
         foreach ( $result as $val) {
             $n++;
             $sheet->setCellValue('A' . $rows, $n);
             $sheet->setCellValue('B' . $rows, $val['emp_code']);
             $sheet->setCellValue('C' . $rows, $val['name']);
             if($val['checkstatus'] == 1)
             {
             $sheet->setCellValue('D' . $rows, 'leave');
             }
             
             $sheet->setCellValue('E' . $rows, date('d-m-Y h:i:s', strtotime($val['date'])));
 
             $rows++;
         }
 
         $writer = new Xlsx($spreadsheet);
 
         // file inside /public folder
         $filepath = $fileName;
 
         $writer->save($filepath);
 
         header("Content-Type: application/vnd.ms-excel");
         header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
 
         header('Expires: 0');
         header('Cache-Control: must-revalidate');
         header('Pragma: public');
         header('Content-Length: ' . filesize($filepath));
         flush(); // Flush system output buffer
         readfile($filepath);
 
         exit;
        }
        else
        {
             $dompdf = new \Dompdf\Dompdf();
             $dompdf->loadHtml(view('admin/admin_attendance/leave-pdf', ["result" => $result]));
 
             // setting paper to portrait, also we have landscape
             $dompdf->setPaper('A4', 'portrait');
             $dompdf->render();
             // Download pdf
             $dompdf->stream();
        }
    }
    
   // this method is use to do the entry in not checkin table
    public function notCheckin()
    {
        $db      = \Config\Database::connect();
        $fetch = $db->table("users"); 

        $fetch_user_id =  $fetch->select('id')->where('id !=',1)->get()->getResultArray();

        if(isset($fetch_user_id) && count($fetch_user_id)>0)
        {
              foreach($fetch_user_id as $result)
              {
                    $present_date = date('Y-m-d');
                    $checkin = $db->table("checkins");
                    $checking_user =  $checkin->where(['user_id'=>$result['id'],'date'=>$present_date])->get()->getResultArray();

                    if(isset($checking_user) && count($checking_user)>0)
                    {
                        foreach($checking_user as $check_result)
                        {
                            $not_checkin = $db->table("not_checkin");
                            $not_checkin->where(['user_id'=>$check_result['user_id'],'date'=>$present_date])->delete();
                        }
                    }
                    else
                    {

                        $not_checkin = $db->table("not_checkin");

                        $checkin_present = $not_checkin->where(['user_id'=>$result['id'],'date'=>$present_date])->get()->getResultArray();

                        if(isset($checkin_present) && count($checkin_present)>0)
                        {

                        }
                        else
                        {
                            $model = new NotCheckin;
                            $newData = [
                               'user_id' => $result['id'],
                               'date' => $present_date
                            ];
     
                            $model->save($newData);
                        }

                           
                        
                    }

                    $fetch_notcheckin =  $not_checkin->select('users.employee_code as employeecode,users.name as name,not_checkin.status')
                    ->join('users', 'users.id = not_checkin.user_id')
                    ->where('users.status',1)
                    ->where('not_checkin.date',$present_date)->get()->getResultArray();  

              }

                echo json_encode( array(
                    'status' => true, 
                    'view_html' => view('admin/admin_attendance/not_checkin',['fetch_notcheckin'=>$fetch_notcheckin])
                ));
               
        }
        else
        {
            echo json_encode( array( 
                "status" => false, 
                "message" => "Record not found"
             ));
        }
    }

    // this method is use to move checkin record to leave
    public function moveLeave()
    { 
        $emp_id= $this->request->getVar('emp_id');

        $db      = \Config\Database::connect();
        $fetch = $db->table("checkins");

        $current_date = date('Y-m-d');

        // getting result as a object
        $fetch_checkin_user = $fetch->where(['user_id'=>$emp_id,'date'=>date('Y-m-d')])->get()->getFirstRow();

        if(isset($fetch_checkin_user))
        {
            $user_id = $fetch_checkin_user->user_id;
            $date = $fetch_checkin_user->date;
            $date_time = $fetch_checkin_user->date_time;

            // moving data to leave
            $model = new Leaves;
            $newData = [
               'user_id' => $user_id,
               'date' => $date,
               'date_time' => $date_time,
               'created_at'=>$date_time,
               'updated_at'=>$date_time
            ];

            $model->save($newData);

            // delete record from checkin
            $record_delete = $fetch->where(['user_id'=>$emp_id,'date'=>date('Y-m-d')])->delete();

            $status = true;
            $message = "Record has been Moved Sucessfully";
        }
        else
        {
            $status = false;
            $message = "Record not found";
        }

        echo json_encode( array( 
            "status" => $status, 
            "message" => $message
         ));

       
        
    }

    // this method is use to move leave record to checkin
    public function moveCheckin()
    {
        $emp_id= $this->request->getVar('emp_id');

        $db      = \Config\Database::connect();
        $fetch = $db->table("leaves");

        $current_date = date('Y-m-d');

        // getting result as a object
        $fetch_checkin_user = $fetch->where(['user_id'=>$emp_id,'date'=>date('Y-m-d')])->get()->getFirstRow();

        if(isset($fetch_checkin_user))
        {
            $user_id = $fetch_checkin_user->user_id;
            $date = $fetch_checkin_user->date;
            $date_time = $fetch_checkin_user->date_time;

            // moving data to leave
            $model = new CheckIn;
            $newData = [
               'user_id' => $user_id,
               'date' => $date,
               'date_time' => $date_time,
               'created_at'=>$date_time,
               'updated_at'=>$date_time
            ];

            $model->save($newData);

            // delete record from leave
            $record_delete = $fetch->where(['user_id'=>$emp_id,'date'=>date('Y-m-d')])->delete();

            $status = true;
            $message = "Record has been Moved Sucessfully";
        }
        else
        {
            $status = false;
            $message = "Record not found";
        }

        echo json_encode( array( 
            "status" => $status, 
            "message" => $message
         ));

    }

    // this method is use to delte multiple checkin record
    public function deleteCheckinRecord()
    {
        $emp_id= $this->request->getVar('emp_id');

        $db      = \Config\Database::connect();
        $fetch = $db->table("checkins");

        $current_date = date('Y-m-d');

        // delete record from checkin
        $record_delete = $fetch->where(['user_id'=>$emp_id,'date'=>date('Y-m-d')])->delete();

        echo json_encode( array( 
            "status" => true, 
            "message" => "Recond has been deleted successfully"
         ));
    }

}

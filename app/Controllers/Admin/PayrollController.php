<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Payroll;

use App\Models\ExcelPayslip;

class PayrollController extends BaseController
{
    public function __construct()
    {
        // loading database
        $this->db = \Config\Database::connect();
    }

    // this method is use to show payroll page
    public function index()
    {
        $fetch =  $this->db->table("users"); 
        $fetch_user = $fetch->select('id,employee_code')->where('id !=',1)->get()->getResultArray();

       return view('admin/admin_payroll/index',['user'=>$fetch_user]);
    }

    // this method is use to show the layout of payroll
    public function payrollLayout()
    {
        $data = $this->request->getVar();
        $employee_id = $data['emp_id'];

        $month = ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sept','Oct','Nov','Dec'];

        $get_user = $this->db->table("payroll_slip"); 

        $get_payroll = $get_user->where('user_id',$employee_id)->get()->getResultArray();

        // echo "<pre>";
        // print_r($get_payroll);
        // die;

        echo json_encode( array(
            'status' => true, 
            'view_html' => view('admin/admin_payroll/payroll_layout',['emp_id'=>$employee_id,'month'=>$month,'pay_roll'=>$get_payroll])
        ));
    }

    // this method is use to upload payslip
    public function uploadPayslip()
    {
         $file = $this->request->getFile('file');

         $newdata = $this->request->getVar();

         $emp_id = $newdata['emp_id'];
         $month = $newdata['month'];
         $year =  $newdata['year'];
    
         $newName = $file->getRandomName();
         $file->move(WRITEPATH.'../public/csvfile', $newName);

         $path = base_url().'/public/csvfile/'.$newName;


         $model = new Payroll;
         $newData = [
            'user_id' => $emp_id,
            'month' =>  $month,
            'year' => $year,
            'file_path' => $path
         ];

         $model->save($newData);

         $get_user = $this->db->table("payroll_slip");
         $fetch = $get_user->where(['user_id'=>$emp_id,'month'=>$month,'year'=>$year])->get()->getResultArray();

         echo json_encode( array(
            'status' => true,
            'data' => $fetch[0]['file_path'],
            'month'=> $fetch[0]['month'],
            'message' => 'Salary slip has been uploaded for '.$month.' month'
        ));
            
    }

    // this method is use to remove payslip
    public function removePayslip()
    {
        $data = $this->request->getVar();

        $emp_id = $data['emp_id'];
        $month = $data['month'];
        $year = $data['year'];


        $get_user = $this->db->table("payroll_slip");

        $fetch_record = $get_user->where(['user_id'=>$emp_id,'month'=>$month,'year'=>$year])->delete();

        echo json_encode( array(
            'status' => true,
            'data'=> $month,
            'message' => 'Salary slip has been removed for '.$month.' month'
        ));
    }

    // this method is use to upload excel payslip
    public function uploadExcelPayslip()
    {
        $file = $this->request->getFile('file');
        $newdata = $this->request->getVar();
        $user_id = $newdata['emp_id'];

        $newName = $file->getRandomName();
        $file->move(WRITEPATH.'../public/excelfile', $newName);

        $path = base_url().'/public/excelfile/'.$newName;

        $get_link = $this->db->table("excel_payslip");
        $fetch_sample = $get_link->where('user_id',$user_id)->get()->getFirstRow();

        if(isset($fetch_sample) && !empty($fetch_sample))
        {
           $msg = 'File has been already uploaded';
        }
        else
        {
            $model = new ExcelPayslip;
            $newData = [
            'user_id' => $user_id,
            'path' => $path
            ];

            $model->save($newData);

            $msg = 'File has been uploaded sucessfully';
        }

        echo json_encode( array(
            'status' => true,
            'message' => $msg
        ));

    }

    // this method is use to download excel sample
    public function downloadExcelSample()
    {
        $newdata = $this->request->getVar();
        $user_id = $newdata['emp_id'];

        $get_link = $this->db->table("excel_payslip");
       $fetch_sample = $get_link->where('user_id',$user_id)->get()->getFirstRow();

       if(isset($fetch_sample) &&  !empty($fetch_sample))
       {
           $status = true;
           $data = $fetch_sample->path;
           $msg = "";
       }
       else
       {
            $status = false;
            $data = null;
            $msg = 'Please upload a file to download the sample';
       }

        echo json_encode( array(
            'status' => $status,
            'data' => $data,
            'message' => $msg
        ));

    }
}

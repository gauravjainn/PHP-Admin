<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class UserProfileController extends BaseController
{
    public function __construct()
    {
        // loading database
        $this->db = \Config\Database::connect();
    }

    // this method is use to show profile page
    public function index()
    {
        
        $month = ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sept','Oct','Nov','Dec'];
        $employee_id = session()->get('id');

        $get_user = $this->db->table("payroll_slip"); 

        $get_payroll = $get_user->where('user_id',$employee_id)->get()->getResultArray();

        return view('frontend/users/user_profile',['emp_id'=>$employee_id,'month'=>$month,'pay_roll'=>$get_payroll]);
    }

    //this method is use for logout
    public function logout()
    {
        $array_items = ['user_name', 'emp_code','user_login','id'];
        $session = session();
        $session->remove($array_items);
        
        return redirect()->route('home');
    }
}

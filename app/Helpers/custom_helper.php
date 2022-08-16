<?php



use App\Models\UserModel;





// Function: used to create the html button

if (!function_exists("return_html")) {

    function return_html($url=null,$view=null)

    {

        $html = "<a href=$url class='btn btn-success btn-sm text-white'>";

        $html.='<i class="fas fa-edit"></i>';

        $html.='</a>';

        $html.=' ';

        $html.= "<a href=$view class='btn btn-info btn-sm text-white'>";

        $html.='<i class="fas fa-eye"></i>';

        $html.='</a>';



        return $html;

    }

}



// Function: used to create the html of select button

if (!function_exists("select_box")) {

    function select_box($data=null,$user_id=null)

    {

        // assign variable to value on condition basis

        $active = ($data == '1') ?  "selected" : "" ;

        $inactive = ($data == '0') ?  "selected" : "" ;



        $html = '<select name="status" data-status='.$data.' data-id='.$user_id.'   id="status" class="form-control">';

        $html.='<option value="1" '.$active.'>Active</option>';

        $html.='<option value="0" '.$inactive.'>Inactive</option>';

        $html.='</select>';



        return $html;

    }



}



// function: use to genrate unique employee Id

if(!function_exists("employee_id"))

{

     function employee_id()

     {

        $db      = \Config\Database::connect();

        $builder = $db->table('users');



        // this query return result as a object

        $query   = $builder->select('*')->orderBy('id','DESC')->limit(1)->get()->getResult();



        if(isset($query) && !empty($query))

        {

            if($query[0]->employee_code == NULL)

            {

                $emp_id = "Emp0".'1'.'/'.date('y');   

            }

            else

            {

                $result = $query[0]->employee_code;

                $break = explode("/",$result);



                $val_first = $break[0][3];

                $val_second = $break[0][4];

                $val_third = isset($break[0][5]) ? $break[0][5]:"";

                

                $arr = array($val_first,$val_second,$val_third);

                $get = implode("",$arr);



                $int_value = (int) $get;

                $new_num = $int_value + 1;

                $emp_id = "Emp0".$new_num.'/'.date('y');   

            }

        }

        else

        {

            $emp_id = "Emp0".'1'.'/'.date('y');    

        }

          

        return $emp_id;

     } 

}





// Function: used to create the html button

if (!function_exists("checkin_view")) {

    function checkin_view($id=null)

    {

        $html = "<a href='javascript:void(0)' id='move_checkin' data-id=$id class='btn btn-info btn-sm text-white'>";

        $html.='Move to leave';

        $html.='</a>';

        $html.=' ';

        $html.= "<a href='javascript:void(0)' id='delete_checkin' data-id=$id class='btn btn-info btn-sm text-white'>";

        $html.='<i class="fas fa-trash"></i>';

        $html.='</a>';

        return $html;

    }

}


if (!function_exists("leave_view")) {

    function leave_view($id=null)

    {

        $html = "<a href='javascript:void(0)' id='move_leave' data-id=$id class='btn btn-info btn-sm text-white'>";

        $html.='Move to checkin';

        $html.='</a>';

        return $html;

    }

}






<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\Role;

class UserController extends BaseController
{
    // this method is use to show user listing
    public function index()
    {
        return view('admin/admin_users/index');
    }

    // this mnethod is use to load server side datatable data
    public function ajaxLoadData()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];

        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];
        
        $model = new UserModel;
        $db      = \Config\Database::connect();
        $data = [];

        if(!empty($search_value)){
            $model->like('name',$search_value);
            $total_count =  $model->where('role_id !=',1)->findAll();

            $counting = count($total_count);

            $builder = $db->table('users');
            $builder->select('users.*,roles.role_name');
            $builder->join('roles', 'roles.id = users.role_id');
            $builder->where('role_id !=',1);
            // $builder->where('status',1);
            $builder->like('name',$search_value);
            $builder->orLike('employee_code',$search_value);
            $result = $builder->orderBy('users.id','DESC')->limit($length,$start)->get()->getResultArray();
        }else{
            // count all data
            $total_count =  $model->where('role_id !=',1)->findAll();

            $counting = count($total_count);

            $builder = $db->table('users');
            $builder->select('users.*,roles.role_name');
            $builder->join('roles', 'roles.id = users.role_id');
            $builder->where('role_id !=',1);
            // $builder->where('status',1);
            $result = $builder->orderBy('users.id','DESC')->limit($length,$start)->get()->getResultArray();
        }

        $no = 0;
        foreach ( $result as $customers) {
           $no++;
           $row = array();
           $row['id'] = $no;
           $row['employee_code'] = $customers['employee_code'];
           $row['email'] = $customers['email'];
           $row['name'] = $customers['name'];
           $row['designation'] = $customers['role_name'];
           $row['status'] = select_box($customers['status'],$customers['id']);
           $url = base_url('admin/edit-users/'.$customers['id']);
           $view = base_url('admin/show-users/'.$customers['id']);
           $row['action'] = return_html($url,$view);
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

    // this method is use to show user-add form
    public function addUsers()
    {
        $emp_id = employee_id();
        $role = new Role;
        $fetch_data = $role->where('role_name !=','Admin')->orderBy('id','DESC')->findAll();
        return view('admin/admin_users/create',['role'=>$fetch_data,'emp_id'=>$emp_id]);
    }

    // this method is use to store the user data
    public function storeUsers()
    {
        $emp_id = employee_id();
        $role = new Role;
        $fetch_data = $role->where('role_name !=','Admin')->orderBy('id','DESC')->findAll();
        $input = $this->validate([
            'email' => 'required|max_length[50]|valid_email|is_unique[users.email]',
            'name' => 'required|min_length[3]|max_length[20]',
            'designation' => 'required|numeric',
            'password'=>'required|min_length[8]|max_length[255]'
        ]);

        if (!$input) {
            return view('admin/admin_users/create',[
                'role'=>$fetch_data,
                'validation' => $this->validator,
                'emp_id'=>$emp_id
            ]);
        }
        else
        {
            $model = new UserModel;
            $newData = [
                'employee_code' => $this->request->getVar('employee_code'),
                'email' => $this->request->getVar('email'),
                'name'=> $this->request->getVar('name'),
                'role_id'=> $this->request->getVar('designation'),
                'password' => md5($this->request->getVar('password')),
            ];

            $model->save($newData);
            return redirect()->to(base_url('admin/users'))->with('message','User has been created Successfully.');
        }
    }

    // this method is use to show edit form
    public function editUsers($id=null)
    {
        $user = new UserModel;
        $fetch_user = $user->where('id',$id)->first();
        $role = new Role;
        $fetch_data = $role->where('role_name !=','Admin')->orderBy('id','DESC')->findAll();

        session()->set('user_id',$id);

        return view('admin/admin_users/edit',['fetch_user'=>$fetch_user,'role'=>$fetch_data]);
    }

    // this method is use to store the updated data
    public function updateUsers($id=null)
    {
        $input = $this->validate([
            'email' => 'required|max_length[50]|valid_email',
            'name' => 'required|min_length[3]|max_length[20]',
            'designation' => 'required|numeric',
            'password'=>'required|min_length[8]|max_length[255]'
        ]);

        $user = new UserModel;
        $fetch_user = $user->where('id',$id)->first();

        if (!$input) {
            $role = new Role;
            $fetch_data = $role->where('role_name !=','Admin')->orderBy('id','DESC')->findAll();
    
            session()->set('user_id',$id);
            return view('admin/admin_users/edit',['fetch_user'=>$fetch_user,'validation' => $this->validator,'role'=>$fetch_data]);
        }
        else
        {
            $newData = [
                'employee_code' => $this->request->getVar('employee_code'),
                'email' => $this->request->getVar('email'),
                'name'=> $this->request->getVar('name'),
                'role_id'=> $this->request->getVar('designation'),
                'password' => md5($this->request->getVar('password')),
            ];

             $user->update($id,$newData);
            return redirect()->to(base_url('admin/users'))->with('message','User has been updated Successfully.');
        }
    }

    // this method is use to show user
    public function showUsers($id=null)
    {
        $user = new UserModel;
        // $fetch_user = $user->where('id',$id)->first();
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('*','roles.role_name');
        $builder->join('roles', 'roles.id = users.role_id');
        $builder->where('role_id !=',1);
        // $builder->where('status',1);
        $fetch_user = $builder->where('users.id',$id)->get()->getResultArray();

        session()->set('user_id',$id);

        return view('admin/admin_users/show',['fetch_user'=>$fetch_user]);
    }

    // this method is use to change the status
    public function changeStatus()
    {
        if ($this->request->isAJAX()) {

            $data = $this->request->getVar();

            $user_id = $data['user_id'];
            $user_status = $data['user_status'];

            $user = new UserModel;

            $fetch = $user->where("id",$user_id)->first();

            if(isset($fetch) && !empty($fetch))
            {
                if($fetch['status'] == 1)
                {
                    $newData = [
                        'status'=>0
                    ];
                     $user->update($user_id,$newData);
                }
                else
                {
                    $newData = [
                        'status'=>1
                    ];
                    $user->update($user_id,$newData);
                }

                echo json_encode( array( 
                    "status" => True, 
                    "message" => "Status has been Updated Sucessfully"
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
    }

}

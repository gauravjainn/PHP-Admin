<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserModel;

class AdminController extends BaseController
{
    // this method is use to show login page
    public function login()
    {
         return view('admin/auth/login');
    }

    // this method is use to check for authentication
    public function auth()
    {

        // $input = $this->validate([
        //     'email' => 'required|valid_email',
        //     'password' => 'required'
        // ]);

            $name = $this->request->getVar('name');
            $password = $this->request->getVar('password');
            $remember =  $this->request->getVar('remember');

            $model = new UserModel;
            $user = $model->where('name',$name)->first();

            if(isset($user) && !empty($user))
            {
                if(md5($password) == $user['password'])
                {

 
                    if(isset($remember) && !empty($remember))
                    {
                         
                        setcookie("username", $name, time() + (86400 * 30), "/");
                        setcookie("password", $password, time() + (86400 * 30), "/");

                        $cook_na = get_cookie("username",TRUE);
                        $cook_pass = get_cookie("password",TRUE);  
                    }
                    else
                    {
                        setcookie("username", $name, time() - (86400 * 30), "/");
                        setcookie("password", $password, time() - (86400 * 30), "/");
                    }

                    // $this->setUserCookie($cook_na,$cook_pass);

                    // Stroing session values
                    $this->setUserSession($user);
                    // Redirecting to dashboard after login
                    return redirect()->to(base_url('admin/dashboard'));
                }
                else
                {
                    return redirect()->route('login')->with('message','please enter correct password');
                }
            }
            else
            {
                return redirect()->route('login')->with('message','please enter valid email address and password.');
            }
    }
    // setting session for logged in user
    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'isLoggedIn' => true
        ];

        session()->set($data);
        return true;
    }

    // this method is use to show dashboard page
    public function dashboard()
    {
        $model = new UserModel;
        $user_get = $model->where('role_id !=',1)->findAll();
    
        // taking out user count
        $user_count = count($user_get);
        return view('admin/admin_dashboard/dashboard',['count'=>$user_count]);
    }

    // this method is to logout the admin
    public function logout()
    {
        $array_items = ['id','name','email','role_id','isLoggedIn'];
        $session = session();
        $session->remove($array_items);
        // session()->destroy();
        return redirect()->route('login');
    }

}

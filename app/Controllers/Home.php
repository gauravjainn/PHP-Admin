<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\Leaves;
use App\Models\CheckIn;

class Home extends BaseController
{
    // this method is use to show frontend user login page
    public function index()
    {
        return view('frontend/login');
    }

    // This method is use to check in the user
    public function checkIn()
    {
        if ($this->request->isAJAX()) 
        {
             $data = $this->request->getVar();
             $emp_code = $data['emp_code'];
             $pass = md5($data['password']);

             $user = new UserModel;

             $fecth_user = $user->where('employee_code',$emp_code)->first();

            if(isset($fecth_user) && !empty($fecth_user))
            {
                $current_date = date('Y-m-d');
                $array = ['user_id' => $fecth_user['id'],'date' => $current_date];
                // laoding database
                $db      = \Config\Database::connect();

               if($fecth_user['password'] == $pass)
               {
                
                if($fecth_user['status'] == 0)
                {
                    echo json_encode( array( 
                        "status" => true, 
                        "message" => "Authentication Failed",
                        "data" => $fecth_user
                    ));
                }
                else
                {

                    $builder = $db->table('leaves');
                    $result = $builder->where($array)->get()->getResultArray();
  
                    if(isset($result) && !empty($result))
                    {
                      echo json_encode( array( 
                          "status" => true, 
                          "message" => "Please contact to hr",
                          "data" => $fecth_user
                      )); 
                    }
                    else
                    {
                      $builder = $db->table('checkins');
                      $result = $builder->where($array)->get()->getResultArray();

                    //   echo "<pre>";
                    //   print_r($result);
                    //   die;
  
                      if(isset($result) && !empty($result))
                      {
                          echo json_encode( array( 
                              "status" => true, 
                              "message" => "You have already checked-in for today",
                              "data" => $fecth_user
                          ));
                      }
                      else
                      {
                          $model = new CheckIn;
                          $newData = [
                             'user_id' => $fecth_user['id'],
                             'date' => $current_date,
                             'date_time' => date('Y-m-d h:i:s'),
                             'status' => 1
                          ];
  
                          $model->save($newData);
  
                          echo json_encode( array( 
                              "status" => true, 
                              "message" => "Registered for Check In Today",
                              "data" => $fecth_user
                          ));
  
                      }

                      $this->setUserSession($fecth_user);
  
                    }

                }
               

               }
               else
               {
                echo json_encode( array( 
                    "status" => false, 
                    "message" => "Authentication Failed"
                 ));
               }
            }
            else
            {
                echo json_encode( array( 
                    "status" => false, 
                    "message" => "Authentication Failed"
                 ));
            }
        }
    }


    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'user_name' => $user['name'],
            'emp_code' => $user['employee_code'],
            'user_login' => true
        ];

        

        session()->set($data);
        return true;
    }

    // this method is use for mark the user atteance leave
    public function leaves()
    {
        if($this->request->isAJAX())
        {
            $data = $this->request->getVar();
            $emp_code = $data['emp_code'];
            $pass = md5($data['password']);

            $user = new UserModel;

            $fecth_user = $user->where('employee_code',$emp_code)->first();

           if(isset($fecth_user) && !empty($fecth_user))
           {
               $current_date = date('Y-m-d');
               $array = ['user_id' => $fecth_user['id'],'date' => $current_date];
               // laoding database
               $db      = \Config\Database::connect();

              if($fecth_user['password'] == $pass)
              {
                  if($fecth_user['status'] == 0)
                  {

                    echo json_encode( array( 
                        "status" => true, 
                        "message" => "Authentication Failed",
                        "data" => $fecth_user
                    ));

                  }
                  else
                  {

                    $builder = $db->table('checkins');
                    $result = $builder->where($array)->get()->getResultArray();
   
                    if(isset($result) && !empty($result))
                    {
                      echo json_encode( array( 
                          "status" => true, 
                          "message" => "Please contact to hr",
                          "data" => $fecth_user
                      )); 
                    }
                    else
                    {
                      $builder = $db->table('leaves');
                      $result = $builder->where($array)->get()->getResultArray();
   
                      if(isset($result) && !empty($result))
                      {
                          echo json_encode( array( 
                              "status" => true, 
                              "message" => "Already registered for leave today",
                              "data" => $fecth_user
                          ));
                      }
                      else
                      {
                          $model = new Leaves;
                          $newData = [
                             'user_id' => $fecth_user['id'],
                             'date' => $current_date,
                             'date_time' => date('Y-m-d h:i:s'),
                             'status' => 1
                          ];
   
                          $model->save($newData);
   
                          echo json_encode( array( 
                              "status" => true, 
                              "message" => "Registered for Leave Today",
                              "data" => $fecth_user
                          ));
                      }
                    }

                  }
                
           
              }
              else
              {
               echo json_encode( array( 
                   "status" => false, 
                   "message" => "Authentication Failed"
                ));
              }
           }
           else
           {
               echo json_encode( array( 
                   "status" => false, 
                   "message" => "Authentication Failed"
                ));
           }
        }
    }
}

<div class="card">

            <div class="card-body">

                <div class="row">   

                    <div class="col-md-6">

                        <label  class="control-label label-custom required">Employee Code</label>

                        <div class="form-group ">

                            <?php

                                if(isset($emp_id) && !empty($emp_id))

                                {

                                    $code = $emp_id;

                                }

                                else

                                {

                                    $code = $fetch_user['employee_code'];

                                }

                            ?>

                            <input  type="text" name="employee_code" class="form-control" value="<?= $code ?>" readonly>

                        </div> 

                    </div>

                

                    <div class="col-md-6">

                        <label class="control-label label-custom required">Employee Email</label>

                        <div class="form-group ">

                            <input  type="email" name="email" class="form-control" value="<?= (isset($fetch_user) && !empty($fetch_user)) ? $fetch_user['email'] : "" ?>" placeholder="Enter Email" >

                            <?php if (isset($validation)) : ?>

                             <?php if($validation->getError('email')) {?>

                                <div class='text-danger'>

                                <?= $error = $validation->getError('email'); ?>

                                </div>

                              <?php }?>

                           <?php endif; ?>

                        </div> 

                    </div>



                    <div class="col-md-6">

                        <label class="control-label label-custom required">Employee Name</label>

                        <div class="form-group ">

                            <input  type="text" name="name" class="form-control" value="<?= (isset($fetch_user) && !empty($fetch_user)) ? $fetch_user['name'] : "" ?>" placeholder="Enter Name">

                            <?php if (isset($validation)) : ?>

                             <?php if($validation->getError('name')) {?>

                                <div class='text-danger'>

                                <?= $error = $validation->getError('name'); ?>

                                </div>

                              <?php }?>

                           <?php endif; ?>

                        </div> 

                    </div>



                    <div class="col-md-6">

                        <label class="control-label label-custom required">Employee Designation</label>

                        <div class="form-group ">

                        <select name="designation" class="form-control">

                            <option value="">Select Designation</option>

                                <?php  

                                if(isset($fetch_user) && !empty($fetch_user))

                                {

                                    if(isset($role) && count($role)>0)

                                    {

                                        foreach($role as $roles)

                                        {

                                            $active = ($roles['id'] == $fetch_user['role_id'] ) ?  "selected" : "" ;

                                            echo "<option value=".$roles['id']." $active>";

                                            echo  $roles['role_name'];

                                            echo "</option>";

                                        }

                                    }

                                }

                                else

                                {

                                    if(isset($role) && count($role)>0)

                                    {

                                        foreach($role as $roles)

                                        {

                                            echo "<option value=".$roles['id'].">";

                                            echo  $roles['role_name'];

                                            echo "</option>";

                                        }

                                    }

                                }

                                ?>

                            </select>

                            <?php if (isset($validation)) : ?>

                             <?php if($validation->getError('designation')) {?>

                                <div class='text-danger'>

                                <?= $error = $validation->getError('designation'); ?>

                                </div>

                              <?php }?>

                           <?php endif; ?>

                        </div> 

                    </div>



                    <div class="col-md-6">

                        <label class="control-label label-custom required">Passowrd</label>

                        <input type="password" name="password" class="form-control" value="<?= (isset($fetch_user) && !empty($fetch_user)) ? $fetch_user['password'] : "" ?>" placeholder="Enter Password">

                        <?php if (isset($validation)) : ?>

                             <?php if($validation->getError('password')) {?>

                                <div class='text-danger'>

                                <?= $error = $validation->getError('password'); ?>

                                </div>

                              <?php }?>

                           <?php endif; ?>

                    </div>



                 </div>

                    <br/>

                <div class="card-action">

                    <button type="button" id="sbt-btn" class="btn btn-primary btn-sm form_submit">Submit</button>

                    <a href="<?= base_url('admin/users') ?>">

                        <button type="button" class="btn btn-danger btn-sm">Cancel</button>

                    </a>

                </div>

                </div>

            </div>
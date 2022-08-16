<nav class="mt-2">

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



<li class="nav-item menu-open">

<a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= (current_url() == base_url('admin/dashboard')) ? 'active' : "";?>">

<i class="nav-icon fas fa-tachometer-alt"></i>

<p>Dashboard</p>

</a>

</li>







<li class="nav-item">

<a href="#" class="nav-link <?= (current_url() == base_url('admin/users') || current_url() == base_url('admin/add-users') || current_url() == base_url('admin/store-users') || current_url() == base_url('admin/edit-users/'.session()->get('user_id')) || current_url() == base_url('admin/show-users/'.session()->get('user_id')) ) ? 'active' : "";?>">

<i class="nav-icon fa fa-users"></i>

<p>

Users 

<i class="fas fa-angle-left right"></i> 

</p>

</a>

<ul class="nav nav-treeview">

<li class="nav-item">

<a href="<?= base_url('admin/users') ?>" class="nav-link">

<i class="far fa-circle nav-icon"></i>

<p>All Users</p>

</a>

</li>

</ul>



</li>





<li class="nav-item menu-open">

<a href="<?= base_url('admin/user-checkin') ?>" class="nav-link <?= (current_url() == base_url('admin/user-checkin') || current_url() == base_url('admin/user-leaves')) ? 'active' : "";?>">

<i class="nav-icon fas fa-calendar"></i>

<p>Attendance</p>

</a>

</li>


<li class="nav-item menu-open">

<a href="<?=  base_url('admin/pay-roll')  ?>"  class="nav-link  <?=  (current_url() ==  base_url('admin/pay-roll')) ? 'active' : "";   ?>">

<i class="nav-icon fas fa-money-bill-alt"></i>

<p>Payroll</p>

</a>

</li>












</ul>

</nav>



</div>



</aside>
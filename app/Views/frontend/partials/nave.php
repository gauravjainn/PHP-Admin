<nav class="navbar navbar-light bg-dark justify-content-between">
  <img src="http://localhost/AttendanceSystem/public/frontend/images/Logo.png" alt="">
  <form class="form-inline">
    <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
    <span class="text-white pr-3">Welcome <?= session()->get('user_name'); ?></span>
      
    <a href="<?=  base_url('users/logout')   ?>" style="text-decoration: none;" class="text-white">logout</a>
  </form>
</nav>
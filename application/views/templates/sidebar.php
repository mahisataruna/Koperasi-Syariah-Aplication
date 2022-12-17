   <!-- Sidebar -->
   <ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Mulai Sidebar Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
      <div class="sidebar-brand-icon">
        <img class="img-profile rounded-circle" width="45px" src="<?= base_url('assets/img/logo_kop.gif'); ?>">
      </div>
      <div class="sidebar-brand-text mx-1">
        <span>Bundo Saiyo Padang</span>
      </div>
    </a>
    <!-- End Sidebar Brand -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- QueryMenu dari database  -->

    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`, `menu`
    FROM `user_menu` JOIN `user_access_menu`
    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
    WHERE `user_access_menu`.`role_id` = $role_id
    ORDER BY `user_access_menu`.`menu_id` ASC  

    ";

    $menu = $this->db->query($queryMenu)->result_array();

    ?>

    <!-- Looping Menu -->
    <?php foreach ($menu as $m) : ?>
      
      <div class="sidebar-heading">
        <?= $m['menu']; ?>
      </div>

      <!-- Siapkan sub menu sesuai dengan tabel menu -->
      <?php
      $menuId = $m['id'];
      $querySubmenu = "SELECT *
      FROM `user_sub_menu` JOIN `user_menu`
      ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
      WHERE `user_sub_menu`.`menu_id` = $menuId 
      AND `user_sub_menu`.`is_active` = 1   
      ";
      $subMenu = $this->db->query($querySubmenu)->result_array();                
      ?> 

      <?php foreach ($subMenu as $sm) :?>
        <?php if ($title == $sm['title']) : ?>  
          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
            <?php else : ?>
              <li class="nav-item">
              <?php endif ; ?>  
              <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                <i class="<?= $sm['icon']; ?>"></i>
                <span><?= $sm['title']; ?></span>
              </a>
            </li>

          <?php endforeach; ?>

          <!-- Divider -->
          <hr class="sidebar-divider mt-3">

        <?php endforeach; ?>

        <!-- Akhir Conten -->

        <!-- Divider -->
        

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>
    <!-- End of Sidebar -->
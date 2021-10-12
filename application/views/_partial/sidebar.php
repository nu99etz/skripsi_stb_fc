<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url();?>assets/default.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('name'); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <?php foreach ($sidebar as $key) {
        if (!empty($key['child'])) {
      ?>
          <li class="treeview">
            <a href="#">
              <i class="<?php echo $key['icon']; ?>"></i> <span><?php echo $key['name']; ?></span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php foreach ($key['child'] as $key2) {
              ?>
                <li><a href="<?php echo $key2['url']; ?>"><i class="<?php echo $key2['icon']; ?>"></i> <?php echo $key2['name']; ?></a></li>
              <?php } ?>
            </ul>
          </li>
        <?php  } else if (empty($key['child'])) {
        ?>
          <li>
            <a href="<?php echo $key['url']; ?>">
              <i class="<?php echo $key['icon']; ?>"></i> <span><?php echo $key['name']; ?></span>
            </a>
          </li>
      <?php  }
      } ?>


    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<script>
    let _menu = $('.sidebar-menu').find('a');
    for(var i = 0; i < _menu.length; i++) {
        href = _menu.eq(i).attr('href');
        if (window.location.href == href) {
            _menu.eq(i).parents('li').addClass('active');
            _menu.eq(i).parents('li').parents('li').addClass('active');
        }
    }
</script>
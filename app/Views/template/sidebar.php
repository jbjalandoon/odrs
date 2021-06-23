
<nav class="menu" tabindex="0">
  <!-- <div class="sidebar-menu"> -->
    <div class="smartphone-menu-trigger"></div>
      <header class="avatar sticky">
        <img src="/img/pupt-logo.png" alt=""><br>
        <span><?=strtoupper(esc($_SESSION['role']))?></span>
      </header>
<!-- <div class="page-wrapper chiller-theme toggled">
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      //sidebar-header
      <div class="sidebar-menu mt-5"> -->
      <ul class="link">
          <?php foreach ($allModules as $module): ?>
            <li class="header-menu" tabindex="0">
              <span><?=esc(ucwords($module['module']))?></span>
            </li>
            <?php foreach ($allPermissions as $permission): ?>
              <?php if ($permission['module_id'] == $module['id'] && $permission['type_slug'] == 'view'): ?>
                <li tabindex="0">
                  <a href="<?=esc(base_url($permission['slug']))?>">
                    <i class="fa fa-<?=$permission['icon'] == NULL ? 'exclamation-triangle': esc($permission['icon'])?>"></i>
                    <span><?=esc(ucwords($permission['permission']))?></span>
                  </a>
                </li>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endforeach; ?>
          <!-- <li class="header-menu">
            <span>ONLINE REQUESTS</span>
          </li>
          <li>
            <a class="sideLink">
              <i class="fa fa-file-import"></i>
              <span>Pending Requests</span>
            </a>
          </li>
          <li>
            <a class="sideLink">
              <i class="fa fa-spinner"></i>
              <span>Office Approval</span>
            </a>
          </li>
          <li>
            <a class="sideLink">
              <i class="fa fa-spinner"></i>
              <span>On Process Requests</span>
            </a>
          </li>
          <li>
            <a class="sideLink">
              <i class="fa fa-clipboard-check"></i>
              <span>Processed Requests</span>
            </a>
          </li>
          <li>
            <a class="sideLink">
              <i class="fa fa-clipboard-check"></i>
              <span>Claimed Requests</span>
            </a>
          </li>
          <li class="header-menu">
            <span>STUDENT INFORMATION</span>
          </li>
          <li>
            <a class="sideLink disabled">
              <i class="fa fa-user"></i>
              <span>Undergraduate</span>
            </a>
          </li>
          <li>
            <a class="sideLink">
              <i class="fa fa-user-graduate"></i>
              <span>Alumni</span>
            </a>
          </li>
          <li class="header-menu">
            <span>SETTINGS</span>
          </li>
          <li>
            <a class="sideLink">
              <i class="fa fa-users"></i>
              <span>Roles</span>
            </a>
          </li>
          <li>
            <a class="sideLink">
              <i class="fa fa-users"></i>
              <span>Modules</span>
            </a>
          </li>
          <li>
            <a class="sideLink">
              <i class="fa fa-file-alt"></i>
              <span>Documents</span>
            </a>
          </li>
          <li>
            <a class="sideLink">
              <i class="fa fa-book-open"></i>
              <span>Courses</span>
            </a>
          </li>
          <li>
            <a class="sideLink">
              <i class="fa fa-book"></i>
              <span>Offices</span>
            </a>
          </li> -->
        </ul>
    <!-- sidebar-content  -->
  <!-- </div> -->
</nav>

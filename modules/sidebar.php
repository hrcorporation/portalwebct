  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-orange elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <img src="../assets/images/logos/Logo-v8.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">CONCRETOL</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item ">
                      <a href="../menu/dashboard.php" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">Modulos</li>
                  <li class="nav-item has-treeview">
                      <a href="index.php" class="nav-link">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                              Modulos
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                     
                
                          <?php
                                switch ($rol_user){
                                    // Modulo 
                                    case 1:
                                ?>
                          <li class="nav-item">
                              <a href="facturae/" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Factura </p>
                              </a>
                          </li>
                                    <?php break; 
                                    } ?>

                                     <?php
                                switch ($rol_user){
                                    // Modulo 
                                    case 3:
                                ?>
                          <li class="nav-item">
                              <a href="../forms/general.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Modulo 2</p>
                              </a>
                          </li>
                                    <?php break; 
                                    } ?>

                                     <?php
                                switch ($rol_user){
                                    // Modulo 
                                    case 2:
                                ?>
                          <li class="nav-item">
                              <a href="../forms/general.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Modulo 3</p>
                              </a>
                          </li>
                                    <?php break; 
                                    } ?>
                      </ul>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
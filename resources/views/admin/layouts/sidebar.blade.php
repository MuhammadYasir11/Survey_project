 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="#" class="brand-link">
         <img src="{{ asset('admin-assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">Laravel Survey</span>
     </a>
     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user (optional) -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                 <li class="nav-item">
                     <a href="{{ route('admin.dashboard') }}" class="nav-link">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <i class="fa-solid fa-gauge-high"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{ route('admin.home.list') }}" class="nav-link">
                         <i class="nav-icon fas fa-file-alt"></i>
                         <p>Survey List</p>
                     </a>

                 </li>
                 <li class="nav-item">
                     <a href="{{ route('admin.Category.create') }}" class="nav-link">
                         <i class="nav-icon fas fa-file-alt"></i>
                         <p>Create Category</p>
                     </a>

                 </li>
                 <li class="nav-item">
                     <a href="{{ route('admin.Survey.create') }}" class="nav-link">
                         <i class="nav-icon fas fa-file-alt"></i>
                         <p>Create Survey</p>
                     </a>

                 </li>


             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
 <!-- Content Wrapper. Contains page content -->
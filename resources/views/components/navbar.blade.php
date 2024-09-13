 <!-- Sidebar -->
 <ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fa-solid fa-chart-simple"></i>
         </div>
         <div class="sidebar-brand-text mx-3">TODO-LIST <sup>GROUP</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->

     {{ $dashboard }}


     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Pages Collapse Menu -->
     {{ $slot }}
     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>

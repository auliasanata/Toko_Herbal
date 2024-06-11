<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Toko Obat</title>

    <!-- Custom fonts for this template -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Page level custom styles -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
            /* Adjust the opacity as needed */
        }

        /* Style for the modal content */
        .modal-content {
            background-color: #fff;
            border-radius: 10px;
        }

        /* Style for the modal header */
        .modal-header {
            background-color: #f8f9fc;
            border-bottom: none;
        }

        /* Style for the modal body */
        .modal-body {
            padding: 20px;
        }

        /* Style for the modal footer */
        .modal-footer {
            border-top: none;
        }

        /* Style for the 'Batal' (Cancel) button */
        .btn-secondary {
            background-color: #6c757d;
        }

        /* Style for the 'Ya' (Yes) button */
        .btn-primary {
            background-color: #007bff;
        }

        /* Style for the close button */
        .close {
            color: #000;
            opacity: 1;
        }

        .sidebar-brand-text {
            font-family: 'Open Sans', sans-serif !important;
        }

        .sidebar-heading,
        .nav-link {
            font-family: 'Open Sans', sans-serif !important;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div style="width: 40%;">
Z                 </div>
                <div class="sidebar-brand-text mx-1 small" style="color: black; width: 60%;">
                    <b>Batra Herbal</b> <br> <b>Sri Mastuti</b>
                </div>
            </a>


            <br>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <hr class="sidebar-divider my-0">


            <div class="sidebar-heading" style="color: #898989; margin: top 50px;"><b>Dashboard</b></div>

            <li class="nav-item active">
                <a class="nav-link" href="index.html" style="color: #898989;">
                    <i class="fas fa-tachometer-alt fa-fw ml-3" style="color: #898989;"></i>
                    <span><b>Dashboard</b></span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading" style="color: #898989;"><b>Master</b></div>
            <li class="nav-item">
                <a class="nav-link" href="/obat" style="color: #898989;">
                    <i class="fas fa-pills fa-fw ml-3" style="color: #898989;"></i>
                    <span><b>Obat</b></span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/pesananadmin" style="color: #898989;">
                    <i class="fas fa-shopping-cart fa-fw ml-3" style="color: #898989;"></i>
                    <span><b>Pemesanan</b></span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/pengiriman" style="color: #898989;">
                    <i class="fas fa-truck fa-fw ml-3" style="color: #898989;"></i>
                    <span><b>Pengiriman</b></span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading" style="color: #898989;"><b>Data</b></div>

            <li class="nav-item">
                <a class="nav-link" href="/Datauser" style="color: #898989;">
                    <i class="fas fa-users fa-fw ml-3" style="color: #898989;"></i>
                    <span><b>User</b></span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/offline_transactions" style="color: #898989;">
                    <i class="fas fa-cash-register fa-fw ml-3" style="color: #898989;"></i>
                    <span><b>Transaksi Offline</b></span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/laporanpenjualan" style="color: #898989;">
                    <i class="fas fa-chart-line fa-fw ml-3" style="color: #898989;"></i>
                    <span><b>Laporan Penjualan</b></span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" href="/pemesanan" style="color: #898989;">
                    <i class="fas fa-chart-bar fa-fw ml-3" style="color: #898989;"></i>
                    <span><b>Laporan Pengeluaran</b></span>
                </a>
            </li> -->


            <hr class="sidebar-divider d-none d-md-block">


            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color: #75AC34; color:#fff">Logout</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>


            <!-- Sidebar Toggler (Sidebar) -->



        </ul>



        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow" style="background-color: #75AC34;">

                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle" style="background-color: #75AC34;">
                            <i class="fas fa-bars text-white"></i>
                        </button>
                    </div>


                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw text-white"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>


                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline small" style="color: #fff;">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('assets/img/undraw_profile.svg') }}">
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <div class="container-fluid">

                    @yield('content')

                </div>


            </div>


            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages -->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->

    <!-- Page level custom scripts -->

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>


</body>

</html>

</body>

</html>
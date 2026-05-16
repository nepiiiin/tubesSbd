<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dribbble - Dashboard</title>

    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        /* 1. Sidebar jadi Dark Mode ala Dribbble */
        .bg-gradient-primary {
            background: #0d0c22 !important;
            background-image: none !important;
        }

        /* 2. Warna teks primary (biru kaku) diganti jadi Pink Dribbble */
        .text-primary {
            color: #ea4c89 !important;
        }

        /* 3. Bikin Card (Kotak) lebih estetik: ujung melengkung & shadow halus */
        .card {
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04) !important;
        }
        .card-header {
            background-color: transparent !important;
            border-bottom: none !important;
            padding-top: 1.5rem !important;
        }

        /* 4. Tombol dibikin lebih membulat dan interaktif */
        .btn-primary {
            background-color: #ea4c89 !important;
            border-color: #ea4c89 !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #f082ac !important;
            border-color: #f082ac !important;
            transform: translateY(-2px);
        }

        /* 5. Merapikan Tabel biar nggak terlalu banyak garis kaku */
        .table-bordered {
            border: none !important;
        }
        .table-bordered th, .table-bordered td {
            border-left: none !important;
            border-right: none !important;
            border-top: 1px solid #f3f4f6 !important;
            vertical-align: middle !important;
        }
        .thead-light th {
            background-color: #fff !important;
            color: #6b7280 !important;
            font-size: 0.85rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            border-bottom: 2px solid #ea4c89 !important;
        }

        /* 6. Menyesuaikan aksen garis pinggir di Dashboard */
        .border-left-primary { border-left: 4px solid #ea4c89 !important; }
        .border-left-success { border-left: 4px solid #82d8d8 !important; }
        .border-left-warning { border-left: 4px solid #f2c94c !important; }

        /* 7. Bikin Background halaman sedikit lebih cerah biar card-nya pop-up */
        body {
            background-color: #fafafb !important;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Dribbble's Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Manajemen Data
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin/users') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Pengguna (Users)</span>
                </a>
            </li>
            
            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->full_name ?? 'Admin' }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('admin_assets/img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Dribbble Clone 2026</span>
                    </div>
                </div>
            </footer>
            </div>
        </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin mau keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah jika kamu ingin mengakhiri sesi.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="#">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
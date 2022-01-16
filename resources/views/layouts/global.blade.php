<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>ARSIP - @yield("title")</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('eatio/images/favicon.svg') }}">
    <link href="{{ asset('eatio/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('eatio/css/style.css') }}" rel="stylesheet">
    @yield("css")

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{route('home')}}" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('eatio/images/favicon.svg') }}" alt="">
                <img class="logo-compact" src="{{ asset('eatio/images/logo-text.png') }}" alt="">
                <img class="brand-title" src="{{ asset('eatio/images/logo-text.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->



        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">

                        <div class="header-left"></div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <div class="header-info">
                                        @if(\Auth::user())
                                        <span>Hello, <strong>{{Auth::user()->name}}</strong></span>
                                        @endif
                                    </div>
                                    <img src="{{ asset('eatio/images/profile/pic1.png') }}" width="20" alt="" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('users.profile', Auth::user()->id) }}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ml-2 text-dark">Profile </span>
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item ai-icon">
                                        @csrf
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <button class="ml-2 text-dark" style="cursor:pointer; background-color: transparent; border:none;">Sign Out</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a href="{{ route('home') }}">
                            <i class="fa fa-tachometer"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    @canany(['isAdmin','isStaff'])
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-download"></i>
                            <span class="nav-text">Impor Data Arsip</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('imporpib.hijau') }}">Import PIB Hijau</a></li>
                            <li><a href="{{ route('imporpib.merah') }}">Import PIB Merah Kuning</a></li>
                             <li><a href="{{ route('imporpib.bc25') }}">Import BC 2.5</a></li>
                        </ul>
                    </li>


                    <li><a href="{{ route('pendok.index') }}">
                            <i class="fa fa-file"></i>
                            <span class="nav-text">Pen. Dokumen</span>
                        </a>
                    </li>
                    @endcanany

                    <li><a href="{{ route('batching.index') }}">
                            <i class="fa fa-clone"></i>
                            <span class="nav-text">Batching</span>
                        </a>
                    </li>

                    @canany(['isAdmin','isRT'])
                    <li><a href="{{ route('kardus.index') }}">
                            <i class="fa fa-cube"></i>
                            <span class="nav-text">Kardus</span>
                        </a>
                    </li>

                    <li><a href="{{ route('gudang.index') }}">
                            <i class="fa fa-home"></i>
                            <span class="nav-text">Masuk ke Gudang</span>
                        </a>
                    </li>

                    <li><a href="{{ route('peminjaman.index') }}">
                            <i class="fa fa-retweet"></i>
                            <span class="nav-text">Peminjaman</span>
                        </a>
                    </li>
                    @endcanany

                    <li><a href="{{ route('cekstatus.index') }}">
                            <i class="fa fa-search"></i>
                            <span class="nav-text">Cek Status</span>
                        </a>
                    </li>


                    {{-- <li><a href="{{ route('cekstatus.pencarian_detail') }}">
                            <i class="fa fa-search"></i>
                            <span class="nav-text">Pencarian Dokumen</span>
                        </a>
                    </li> --}}

                    @can('isAdmin')
                    <li><a href="{{ route('users.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="nav-text">Manage Users</span>
                        </a>
                    </li>
                    @endcan


                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-wrench"></i>
                            <span class="nav-text">Reference</span>
                        </a>
                        <ul aria-expanded="false">
                            @canany(['isAdmin','isRT'])
                            <li><a href="{{ route('datagudang.index') }}">Set Gudang</a></li>
                            <li><a href="{{ route('rak.index') }}">Set Penomoran Rak</a></li>
                            @endcanany

                            @canany(['isAdmin','isStaff'])
                            <li><a href="{{ route('pfpd.index') }}">Set PFPD/KASI</a></li>
                            <li><a href="#">Set Petugas Penerima</a></li>
                            @endcanany

                            @can('isAdmin')
                            <li><a href="{{ route('bidang.index') }}">Set Nama Bidang</a></li>
                            <li><a href="{{ route('seksi.index') }}">Set Nama Seksi</a></li>
                            <li><a href="{{ route('pangkat.index') }}">Set Pangkat/Golongan</a></li>
                            <li><a href="{{ route('jabatan.index') }}">Set Nama Jabatan</a></li>
                            <li><a href="{{ route('jenisdok.index') }}">Set Jenis Dokumen</a></li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                @yield("content")
            </div>
        </div>
        <!--**********************************
        Main wrapper end
    ***********************************-->

        <!--**********************************
        Scripts
    ***********************************-->
        <!-- Required vendors -->
        <script src="{{ asset('eatio/vendor/global/global.min.js') }}"></script>
        <!-- <script src="{{ asset('eatio/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script> -->
        <script src="{{ asset('eatio/vendor/chart.js/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('eatio/js/custom.min.js') }}"></script>
        <script src="{{ asset('eatio/js/deznav-init.js') }}"></script>

        <!-- Apex Chart -->
        <script src="{{ asset('eatio/vendor/apexchart/apexchart.js') }}"></script>
        <!-- <script src="{{ asset('eatio/vendor/datatables/js/jquery.dataTables.min.js') }}"></script> -->


        @yield('js')


</body>

</html>

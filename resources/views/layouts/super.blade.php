<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Wemis</title>

    <link rel="shortcut icon" href="{{ url('images/favicon.png') }}" />

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="{{ url('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('multiselect/css/chosen.css') }}">
    <link rel="stylesheet" href="{{ url('multiselect/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('multiselect/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css">

    <!-- Add Bootstrap JS bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        .chosen-container {
            width: 100% !important;
        }

        .chosen-container-multi .chosen-choices {
            padding: 0 !important;
        }

        .chosen-container-multi .chosen-choices li.search-field input[type="text"] {
            padding-left: 10px !important;
        }

        .horizontal-menu .bottom-navbar .page-navigation>.nav-item.active>.nav-link:after {
            border-bottom: none;
        }

        .btn-theme {
            background-color: #260950;
            color: #fff;
            border: 1px solid #fff;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        .btn-theme:hover {
            background-color: #fff;
            color: #260950;
        }

        .sticky-nav {
            position: fixed !important;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            background-color: #f3f3f3 !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: #f8f9fa;
                padding: 1rem;
                margin-top: 0.5rem;
                border-radius: 0.25rem;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            }
        }
    </style>
    <style>
        .btn-outline-light {
            border-width: 2px;
            font-weight: 500;
            background-color: #2e046d !important;
            border-radius: 25px;
            color: #fff !important
        }

        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.9) !important;
            color: #000000 !important;
            transform: translateY(-2px);
            transition: 1s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: #260950;
            color: white;
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-content {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .form-control,
        .form-select {
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.25rem;
            color: #495057;
        }

        .btn-primary {
            background-color: #260950;
            border-color: #260950;
            padding: 0.375rem 1.25rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #1a0738;
            border-color: #1a0738;
        }

        .remove-row {
            transition: all 0.2s ease;
        }

        .remove-row:hover {
            transform: scale(1.05);
        }

        .add_more {
            transition: all 0.2s ease;
            border-radius: 0.375rem;
            padding: 0.25rem 0.75rem;
        }

        .add_more:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .bg-primary {
            background-color: #2e046d !important;
        }

        .card-title {
            color: #fff !important;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="horizontal-menu">
            <nav class="top-navbar p-0 navbar col-lg-12 col-12">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-center navbar-menu-wrapper">
                        <ul class="navbar-nav">
                        </ul>

                        <div class="d-flex align-items-center justify-content-center text-center navbar-brand-wrapper">
                            <a class="navbar-brand brand-logo" href="index.html">
                                <img src="{{ url('images/wemis.png') }}" alt="logo" />
                            </a>
                            <a class="navbar-brand brand-logo-mini" href="index.html">
                                <img src="{{ url('images/wemis.png') }}" alt="logo" />
                            </a>
                        </div>

                        <ul class="navbar-nav-right navbar-nav">
                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    id="profileDropdown">
                                    <span class="nav-profile-name">{{ auth()->user()->name }}</span>
                                    <span class="online-status"></span>
                                    <img src="{{ url('images/faces/face1.jpg') }}" alt="profile" />
                                </a>
                                <div class="dropdown-menu-right dropdown-menu navbar-dropdown"
                                    aria-labelledby="profileDropdown">
                                    <a class="dropdown-item">
                                        <i class="text-primary mdi mdi-settings"></i> Settings
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        onclick="document.getElementById('logout').submit();">
                                        <i class="me-2 text-primary mdi mdi-logout"></i> Signout
                                    </a>
                                    <form id="logout" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>

                        <button class="navbar-toggler navbar-toggler-right d-lg-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                </div>
            </nav>

            <nav class="bottom-navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav page-navigation">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('super.dashboard') }}">
                                    <i class="fas fa-tachometer-alt" style="font-size: 20px"></i>
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" id="elementsDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-cogs" style="font-size: 20px"></i>
                                    <span class="menu-title">Elements</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="dropdown-menu submenu" aria-labelledby="elementsDropdown">
                                    <ul>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{ route('elements') }}">Element</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{route('elements.types')}}">Element
                                                Types</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{route('modelNo')}}">Model Numbers</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{route('parts')}}">Part Numbers</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{route('tacs')}}">TAC Numbers</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{route('cop')}}">COP Numbers</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{route('testingagency')}}">Testing
                                                Agency</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{route('assignElement.admin')}}">Assign
                                                Element</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-users" style="font-size: 20px"></i>
                                    <span class="menu-title">Onboard Admin</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="dropdown-menu submenu" aria-labelledby="adminDropdown">
                                    <ul class="submenu-item">
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{ route('create.admin') }}">Create Admin</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{ route('admin.list') }}">Admin List</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                <footer class="footer" style="background-color: #260950">
                    <div class="footer-wrap" style="background-color: #260950">
                        <div class="d-sm-flex justify-content-sm-between justify-content-center">
                            <span class="d-block d-sm-inline-block text-muted text-sm-left text-center">
                                Copyright © <a href="" target="_blank">Wemis</a> 2025
                            </span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ url('vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('js/template.js') }}"></script>
    <script src="{{ url('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ url('vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ url('vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ url('vendors/justgage/raphael-2.1.4.min.js') }}"></script>
    <script src="{{ url('vendors/justgage/justgage.js') }}"></script>
    <script src="{{ url('js/dashboard.js') }}"></script>

    <script src="{{ url('/multiselect/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/main.js') }}"></script>

    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>

    <script>
        // Initialize DataTable
        new DataTable('.dataTable', {
            pageLength: 10,
            language: {
                search: "Search:",
                lengthMenu: "Display _MENU_ records per page",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    next: "Next",
                    previous: "Previous"
                }
            },
        });

        // Sticky Navbar
        $(window).on('scroll', function () {
            if ($(window).scrollTop() > 10) {
                $('.bottom-navbar').addClass('sticky-nav');
            } else {
                $('.bottom-navbar').removeClass('sticky-nav');
            }
        });

        // Auto-dismiss alerts
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 4000);
    </script>
</body>

</html>
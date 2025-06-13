<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Wemis</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ url('vendors/mdi/css/materialdesignicons.min.css') }}">
    {{--
    <link rel="stylesheet" href="{{ url('vendors/base/vendor.bundle.base.css') }}"> --}}
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('multiselect/css/chosen.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('multiselect/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ url('multiselect/css/style.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ url('images/favicon.png') }}" />
    {{-- font-awsome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- data tables --}}
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css">
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

        .btn-outline-light {
            border-width: 2px;
            font-weight: 500;
            background-color: #2e046d !important;
            border-radius: 25px;
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
            background-color: #260950!important;
            border-color: #260950!important;
            padding: 0.375rem 1.25rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #1a0738;
            border-color: #1a0738;
        }

        .card-header{
            background-color: var(--primary)
        }
        
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="horizontal-menu">
            <nav class="navbar top-navbar col-lg-12 col-12 p-0">
                <div class="container-fluid">
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-center">
                        <ul class="navbar-nav ">
                            {{-- <li class="nav-item ms-0 me-5 d-lg-flex d-none">
                                <a href="#" class="nav-link horizontal-nav-left-menu"><i
                                        class="mdi mdi-format-list-bulleted"></i></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                                    id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-bell mx-0"></i>
                                    <span class="count bg-success">2</span>
                                </a> --}}
                                {{-- <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                    aria-labelledby="notificationDropdown">
                                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-success">
                                                <i class="mdi mdi-information mx-0"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                            <p class="font-weight-light small-text mb-0 text-muted">
                                                Just now
                                            </p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-warning">
                                                <i class="mdi mdi-settings mx-0"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject font-weight-normal">Settings</h6>
                                            <p class="font-weight-light small-text mb-0 text-muted">
                                                Private message
                                            </p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-info">
                                                <i class="mdi mdi-account-box mx-0"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                            <p class="font-weight-light small-text mb-0 text-muted">
                                                2 days ago
                                            </p>
                                        </div>
                                    </a>
                                </div> --}}
                                {{--
                            </li> --}}
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                                    id="messageDropdown" href="#" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-email mx-0"></i>
                                    <span class="count bg-primary">4</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                    aria-labelledby="messageDropdown">
                                    <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                                        </div>
                                        <div class="preview-item-content flex-grow">
                                            <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                                            </h6>
                                            <p class="font-weight-light small-text text-muted mb-0">
                                                The meeting is cancelled
                                            </p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                                        </div>
                                        <div class="preview-item-content flex-grow">
                                            <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                                            </h6>
                                            <p class="font-weight-light small-text text-muted mb-0">
                                                New product launch
                                            </p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                                        </div>
                                        <div class="preview-item-content flex-grow">
                                            <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                                            </h6>
                                            <p class="font-weight-light small-text text-muted mb-0">
                                                Upcoming board meeting
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link count-indicator "><i
                                        class="mdi mdi-message-reply-text"></i></a>
                            </li>
                            <li class="nav-item nav-search d-none d-lg-block ms-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="search">
                                            <i class="mdi mdi-magnify"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="search" aria-label="search"
                                        aria-describedby="search">
                                </div>
                            </li> --}}
                        </ul>
                        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                            <a class="navbar-brand brand-logo" href="index.html"><img
                                    src="{{ url('images/wemis.png') }}" alt="logo" /></a>
                            <a class="navbar-brand brand-logo-mini" href="index.html"><img
                                    src="{{ url('images/wemis.png') }}" alt="logo" /></a>
                        </div>
                        <ul class="navbar-nav navbar-nav-right">
                            {{-- <li class="nav-item dropdown  d-lg-flex d-none">
                                <button type="button" class="btn btn-inverse-primary btn-sm">Product </button>
                            </li>
                            <li class="nav-item dropdown d-lg-flex d-none">
                                <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm"
                                    id="nreportDropdown" href="#" data-bs-toggle="dropdown">
                                    Reports
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                    aria-labelledby="nreportDropdown">
                                    <p class="mb-0 font-weight-medium float-left dropdown-header">Reports</p>
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-file-pdf text-primary"></i>
                                        Pdf
                                    </a>
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-file-excel text-primary"></i>
                                        Exel
                                    </a>
                                </div>
                            </li> --}}

                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    id="profileDropdown">
                                    <span class="nav-profile-name">{{ auth('admin')->user()->name }}</span>
                                    <span class="online-status"></span>
                                    <img src="{{ url('images/faces/face1.jpg') }}" alt="profile" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="profileDropdown">
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-settings text-primary"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        onclick="document.getElementById('logout').submit();"> <i
                                            class="mdi mdi-logout me-2 text-primary"></i> Signout </a></a>


                                    <form id="logout" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                            data-toggle="horizontal-menu-toggle">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                </div>
            </nav>
            <nav class="bottom-navbar">
                <div class="container">
                    <ul class="nav page-navigation">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="mdi mdi-file-document-box menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-cube-outline menu-icon"></i>
                                <span class="menu-title">Elements</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('admin.assignedElement', $id = auth('admin')->user()->id) }}">Elements
                                            List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('assigneElement.wlp')}}">Assign
                                            Elements</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.elements')}}">
                                <i class="fas fa-cogs" style="font-size: 20px"></i>
                                <span class="menu-title">Elements List</span>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('wlps') }}" class="nav-link">
                                <i class="mdi mdi-cube-outline menu-icon"></i>
                                <span class="menu-title">WLP/Reseller Mgt.</span>
                                <i class="menu-arrow"></i>
                            </a>
                            {{-- <div class="submenu">
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="">Create WLP</a></li>
                                    <li class="nav-item"><a class="nav-link" href="">WLP
                                            List</a></li>
                                </ul>
                            </div> --}}
                        </li>

                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-codepen menu-icon"></i>
                                <span class="menu-title">Client Account Mgt.</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('superadmin.create.admin') }}">Create Admin</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('superadmin.admin') }}">Admin List</a></li>
                                </ul>
                            </div>
                        </li> --}}


                        {{-- <li class="nav-item">
                            <a href="docs/documentation.html" class="nav-link">
                                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                                <span class="menu-title">Order Mgt.</span></a>

                            <div class="submenu">
                                <ul class="submenu-item"> --}}
                                    {{-- <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.create.subscription') }}">Create Subscription</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.view.subscriptionlist') }}">Subscription List</a>
                                    </li> --}}
                                    {{--
                                </ul>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </nav>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer" style="background-color: #260950">
                    <div class="footer-wrap" style="background-color: #260950">
                        <div class="d-sm-flex justify-content-sm-between justify-content-center">
                            <span class="d-block d-sm-inline-block text-muted text-sm-left text-center">Copyright © <a
                                    href="" target="_blank">Wemis
                                </a> 2025</span>
                            {{-- <span class="d-block float-sm-right float-none mt-1 mt-sm-0 text-center">Only the best
                                <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a>
                                templates</span> --}}
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const forms = document.querySelectorAll('form');

            forms.forEach(function (form) {
                let isSubmitting = false;

                form.addEventListener('submit', function (e) {
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (isSubmitting) {
                        e.preventDefault(); // Already submitted
                        return;
                    }

                    isSubmitting = true; // Flag set

                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.innerText = 'Submitting...';
                    }
                });
            });
        });
    </script>
    <script>
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
    </script>
    <!-- js-->
    <script src="{{ url('vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('js/template.js') }}"></script>
    <script src="{{ url('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ url('vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ url('vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ url('vendors/justgage/raphael-2.1.4.min.js') }}"></script>
    <script src="{{ url('vendors/justgage/justgage.js') }}"></script>
    <script src="{{ url('js/jquery.cookie.js" type="text/javascript') }}"></script>

    <script src="{{ url('js/dashboard.js') }}"></script>
    <script src="{{ url('/multiselect/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/popper.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/main.js') }}"></script>
    <script>
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 4000); // 4 seconds
    </script>
    <script>
        $('.country').on('change', function () {
            $('.state').empty();
            let value = this.value;
            let china = ['Beijing'];
            let india = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat',
                'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Maharashtra',
                'Madhya Pradesh', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab',
                'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Tripura', 'Telangana', 'Uttar Pradesh', 'Uttarakhand',
                'West Bengal', 'Andaman & Nicobar (UT)', 'Chandigarh (UT)',
                'Dadra & Nagar Haveli and Daman & Diu (UT)', 'Delhi [National Capital Territory (NCT)]',
                'Jammu & Kashmir (UT)', 'Ladakh (UT)', 'Lakshadweep (UT)', 'Puducherry (UT)'
            ];

            switch (value) {
                case "china":
                    for (let state of china) {
                        $('.state').append($('<option>', {
                            value: state,
                            text: state
                        }));
                    }
                    break;
                case "india":
                    for (let state of india) {
                        $('.state').append($('<option>', {
                            value: state,
                            text: state
                        }));
                    }
                    break;
                default:
                    break;
            }


        });
    </script>
    <!-- End  js -->
</body>

</html>
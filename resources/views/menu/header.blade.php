 <header class="topbar" data-navbarbg="skin1" >
            <nav class="navbar top-navbar navbar-expand-md navbar-dark" >
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand text-center">
                        <!-- Logo icon -->
                        <a href="{{url('/')}}" style="margin-left: -28px">
                            
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text text-white font-weight-bold">
                               <img src="{{asset('images/m-tech-logo.png')}}" width="250" height="75" alt="">
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin1">
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav w-100 align-items-center">
                        <li class="nav-item ml-0 ml-md-3 ml-lg-0">
                            <a class="nav-link search-bar" href="javascript:void(0)">
                                <form class="my-2 my-lg-0">
                                    <div class="customize-input customize-input-v4">
                                        <input class="form-control" type="search" placeholder="Search"
                                            aria-label="Search">
                                        <i class="form-control-icon" data-feather="search"></i>
                                    </div>
                                </form>
                            </a>
                        </li>
                        <li class="nav-item ml-auto">
                            <div class="upgrade-btn">
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                <button type="submit" class="btn btn-success">Logout</button>
                                </form>
                                {{-- <a href="#"
                                    class="btn btn-success text-white" target="_blank">Logout</a> --}}
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
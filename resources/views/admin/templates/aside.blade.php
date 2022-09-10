<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="info" style="position: static; text-align: center">
                @auth
                <p><i class="fa fa-user-circle"></i> {{ \Auth::user()->name }}</p>
                @endauth
                <!-- Status -->
                {{-- <a href="#"><i class="fa fa-circle text-success"></i> {{ \Auth::user()->email }}</a> --}}
            </div>
        </div>

        <!-- search form (Optional) -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> --}}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            {{-- <li class="header">HEADER</li> --}}
            <!-- Optionally, you can add icons to the links -->
            {{-- <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> --}}
            <li class="{{ (request()->is('dashboard*')) ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
            <li class="{{ (request()->is('calon-kepala-desa*')) ? 'active' : '' }}"><a href="{{ route('calkades') }}"><i class="fa fa-user"></i> <span>Calon Kepada Desa</span></a></li>
            <li class="{{ (request()->is('pemilih*')) ? 'active' : '' }}"><a href="{{ route('pemilih') }}"><i class="fa fa-users"></i> <span>Pemilih</span></a></li>
            <li class="{{ (request()->is('periode*')) ? 'active' : '' }}"><a href="{{ route('periode') }}"><i class="fa fa-calendar"></i> <span>Periode Pemilihan</span></a></li>
            {{-- <li class="{{ (request()->is('user*')) ? 'active' : '' }}"><a href="{{ route('user') }}"><i class="fa fa-key"></i> <span>Pengguna</span></a></li> --}}
            

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

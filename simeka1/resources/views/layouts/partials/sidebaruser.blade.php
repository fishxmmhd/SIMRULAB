<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/employee.png')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                </div>
            </div>
        @endif

       

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"></li> <!-- border menu -->
            <!-- Optionally, you can add icons to the links --><!-- 
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('Home') }}</span></a></li> -->
            <!-- <li><a href="/submenu"><i class='fa fa-link'></i> <span>{{ trans('Submenu') }}</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('Multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/pinjam">{{ trans('Pinjam') }}</a></li>
                    <li><a href="/bayar">{{ trans('Bayar') }}</a></li>
                </ul>
            </li> -->
              <li><a href="/pemakaian"><i class='fa fa-calendar'></i> <span>{{ trans('Pemakaian') }}</span></a></li>
              <li><a href="/formpengaduan"><i class='fa fa-calendar'></i> <span>{{ trans('Formulir Pengaduan') }}</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

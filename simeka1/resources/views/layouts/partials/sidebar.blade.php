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
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('Home') }}</span></a></li>
           <li><a href="/ruangan"><i class='fa fa-home'></i> <span>{{ trans('Ruangan') }}</span></a></li>
              <li><a href="/kegiatan"><i class='fa fa-list-alt'></i> <span>{{ trans('Kegiatan') }}</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
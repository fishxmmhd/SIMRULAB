<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Beranda')
        <!-- <small>@yield('contentheader_description', 'ini coba')</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</a></li>
        <li class="active">{{ trans('adminlte_lang::message.here') }}</li>
    </ol>
</section>
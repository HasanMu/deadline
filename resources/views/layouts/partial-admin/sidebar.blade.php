<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('assets/deafult-avatar.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="{{ (!Request::segment(2) ? 'treeview active' : '')}}">
          <a href="{{ route('admin.index') }}">
            <i class="fa fa-th"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="{{ (Request::segment(2) == 'users' ? 'treeview active' : '')}}">
          <a href="{{ route('admin.users.index') }}">
            <i class="fa fa-users"></i>
            <span>Users</span>
          </a>
        </li>

        <li class="{{ (Request::segment(3) == 'questions' || Request::segment(3) == 'class') ? 'active treeview menu-open' : 'treeview' }}">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Posts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (Request::segment(3) == 'questions') ? 'active' : '' }}"><a href="{{ route('admin.questions.index') }}"><i class="fa fa-circle-o"></i>Pertanyaan</a></li>
            <li class="{{ (Request::segment(3) == 'class') ? 'active' : '' }}"><a href="{{ route('admin.questions.index') }}"><i class="fa fa-circle-o"></i>Kelas</a></li>
          </ul>
        </li>

        <li class="treeview">
            <a href="pages/widgets.html">
              <i class="fa fa-edit"></i> <span>Posts Blog</span>
            </a>
        </li>
        <li class="{{ (Request::segment(2) == 'comments' || Request::segment(3) == 'comments') ? 'active treeview menu-open' : 'treeview' }}">
          <a href="#">
            <i class="fa fa-edit"></i>
            <span>Comments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (Request::segment(3) == 'comments') ? 'active' : '' }}"><a href="{{ route('admin.questions.index') }}"><i class="fa fa-circle-o"></i>Pertanyaan</a></li>
            <li class="{{ (Request::segment(3) == 'comments') ? 'active' : '' }}"><a href="{{ route('admin.questions.index') }}"><i class="fa fa-circle-o"></i>Kelas</a></li>
          </ul>
        </li>
        <li class="{{ (Request::segment(2) == 'categories' || Request::segment(2) == 'tags') ? 'active treeview menu-open' : 'treeview' }}">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>Manage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (Request::segment(2) == 'categories') ? 'active' : '' }}"><a href="{{ route('admin.categories.index') }}"><i class="fa fa-circle-o"></i>Kategori</a></li>
            <li class="{{ (Request::segment(2) == 'tags') ? 'active' : '' }}"><a href="{{ route('admin.tags.index') }}"><i class="fa fa-circle-o"></i>Tag</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>

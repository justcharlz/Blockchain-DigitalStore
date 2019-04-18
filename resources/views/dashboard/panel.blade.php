<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">{{Auth::user()->name}}</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<!--form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form-->
		<ul class="nav menu">
      <li class="nav-item @if(Request::is('dashboard', 'dashboard/*')) active @endif">
          <a class="nav-link" href="{!! url('dashboard') !!}"><span class="fas fa-tachometer-alt"></span> Dashboard</a>
      </li>
			<li class="nav-item @if(Request::is('marketplace', 'marketplace/*')) active @endif">
        <a class="nav-link" href="{!! url('/marketplace') !!}"><i class="fas fa-store"></i> MarketPlace</a>
      </li>
			<!--li><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>
			<li><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
			<li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li-->
      <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-music">&nbsp;</em> Beat Store <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse nav-item @if(Request::is('stores', 'stores/*')) active @endif" id="sub-item-1">
					<li><a class="nav-link" href="{!! url('stores/create') !!}"><span class="fas fa-cloud">&nbsp;</span> Upload Beat</a></li>
					<li><a class="nav-link" href="{!! url('stores') !!}">
						<span class="fa fa-shopping-cart">&nbsp;</span> My Store
					</a></li>
				</ul>
			</li>
      <li class="nav-item @if(Request::is('wallet', 'wallet/*')) active @endif">
        <a class="nav-link" href="{!! url('/wallet') !!}">
        <i class="fas fa-wallet">&nbsp;</i> Decent Wallet
      </a>
    </li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-user">&nbsp;</em> Account Settings <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse nav-item @if(Request::is('user/settings', 'user/password')) active @endif" id="sub-item-2">
					<li><a class="nav-link" href="{!! url('user/settings') !!}"><span class="fa fa-arrow-right">&nbsp;</span> User Detail
					</a></li>
					<li><a class="nav-link" href="{!! url('user/password') !!}">
						<i class="fas fa-key">&nbsp;</i> Change Password
					</a></li>
				</ul>
			</li>
      @if (Gate::allows('admin'))
          <li class="nav-item @if(Request::is('admin/dashboard', 'admin/dashboard/*')) active @endif">
              <a class="nav-link" href="{!! url('admin/dashboard') !!}"><span class="fas fa-tachometer-alt"></span> Admin Dashboard</a>
          </li>
          <li class="parent "><a data-toggle="collapse" href="#sub-item-3">
    				<em class="fas fa-users">&nbsp;</em> Users <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
    				</a>
    				<ul class="children collapse nav-item @if(Request::is('admin/users', 'admin/users/*')) active @endif" id="sub-item-3">
    					<li><a class="nav-link" href="{!! url('admin/users') !!}"><span class="fa fa-user-edit">&nbsp;</span> Users Detail
    					</a></li>
    					<li><a class="nav-link" href="{!! url('admin/users/invite') !!}">
    						<i class="fas fa-user-plus">&nbsp;</i> Invite Users
    					</a></li>
              <li><a class="nav-link" href="{!! url('teams') !!}">
    						<i class="fas fa-user-cog">&nbsp;</i> Teams
    					</a></li>
    				</ul>
    			</li>
          <li class="nav-item @if(Request::is('admin/roles', 'admin/roles/*')) active @endif">
              <a class="nav-link" href="{!! url('admin/roles') !!}"><span class="fas fa-lock"></span> Roles</a>
          </li>
      @endif

        @if (Auth::user())
        <li class="nav-item ">
			<a href="/logout"><span class="fa fa-power-off"></span> Logout</a>
        </li>
      @endif

		</ul>
	</div><!--/.sidebar-->

<!--li class="nav-item @if(Request::is('dashboard', 'dashboard/*')) active @endif">
    <a class="nav-link" href="{!! url('dashboard') !!}"><span class="fas fa-tachometer-alt"></span> Dashboard</a>
</li>
<li class="nav-item @if(Request::is('dashboard/dashboard', 'user/password')) active @endif">
    <a class="nav-link" href="{!! url('/stores') !!}"><span class="fas fa-cloud"></span> Upload Beat</a>
</li>
<li class="nav-item @if(Request::is('user/settings', 'user/password')) active @endif">
    <a class="nav-link" href="{!! url('user/settings') !!}"><span class="fas fa-user"></span> Settings</a>
</li>
<li class="nav-item @if(Request::is('teams', 'teams/*')) active @endif">
    <a class="nav-link" href="{!! url('teams') !!}"><span class="fas fa-users"></span> Teams</a>
</li-->

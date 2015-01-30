<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
	<div class="container-fluid">
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="pull-left">{{ HTML::image('images/flash.png', 'Flash', array('class' => 'img-responsive')) }}</li>
				<li class="pull-left">{{ link_to_route('project.create', trans('flash.nav_creator')) }}</li>
				<li class="pull-left">
					{{ html_entity_decode(link_to_route('project.index', trans('flash.nav_list').'<span style="margin-left:5px;"  class="badge pull-right">'.count(Project::getProjectType()).'</span>')) }}
				</li>
				<li class="pull-left">
					{{ html_entity_decode(link_to('scheduler', trans('flash.scheduler').'<span style="margin-left:5px" class="badge pull-right master-tasks">'.count(Task::getScheduledTask()).'</span>')) }}
				</li>
				<li class="pull-left">
					{{ html_entity_decode(link_to('billing', trans('flash.nav_billing').'<span style="margin-left:5px;"  class="badge pull-right">'.count(Project::getProjectType('billing')).'</span>')) }}
				</li>
				<li class="pull-left">
					{{ html_entity_decode(link_to('archive', trans('flash.nav_archive').'<span style="margin-left:5px;"  class="badge pull-right">'.count(Project::getProjectType('archive')).'</span>')) }}
				</li>

				<li class="nav-date"><h4>{{ date($USER_INFO->global_date_format, time()) }}</h4></li>

				<li class="pull-right">{{ link_to_action('SessionController@destroy', 'Logout') }}</li>
				<li class="pull-right">{{ link_to_action('UserController@index', 'Users ') }}</li>
				<li class="pull-right dropdown">
					<a class="dropdown-toggle" href="/" data-toggle="dropdown">Admin<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ action('AdminController@processes') }}">Modify Processes</a></li>
						<li><a href="{{ action('UploadController@users') }}">Upload Users</a></li>
						<li><a href="{{ action('UploadController@customers') }}">Customers</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
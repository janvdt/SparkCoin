<div class="navigation">
	<div class="logo"></div>
	<ul>
		<li>{{HTML::link('projects', 'All Projects')}}</li>
		<li>{{HTML::link('projects/create', 'Create Project')}}</li>
		<li><a href ="{{ URL::action('ProfileController@show',array(Auth::user()->id)) }}">Dashboard</a></li>
	</ul>
</div>
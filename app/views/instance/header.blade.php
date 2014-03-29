<div class="site-header">
	<ul>
		<li>Home</li>
		<li>{{HTML::link('projects', 'All Projects')}}</li>
		<li>{{HTML::link('projects/create', 'Create Project')}}</li>
		<li>{{HTML::link('dashboard', 'My Account')}}</li>
	</ul>
	<div>
		<a href ="{{ URL::action('ProfileController@show',array(Auth::user()->id)) }}">
			<p>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
			<img class="barpic" src="{{ url(Auth::user()->profileUser()->getImagePathname()) }}" width="25" alt="">
		</a>
</div>
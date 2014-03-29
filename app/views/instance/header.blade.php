<div class="site-header">
	<ul>
		<li>Home</li>
		<li>{{HTML::link('projects', 'All Projects')}}</li>
		<li>{{HTML::link('projects/create', 'Create Project')}}</li>
		<li>{{HTML::link('dashboard', 'My Account')}}</li>
	</ul>
	<div>
		<p>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
	<img class="barpic" src="{{ url(Auth::user()->profileUser()->getImagePathname()) }}" width="25" alt="">
</div>
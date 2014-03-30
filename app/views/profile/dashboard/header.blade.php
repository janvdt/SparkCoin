<div class="dashboard">
	<h2>Dashboard</h2>
<ul>
	<li><a href ="{{ URL::action('ProfileController@showYours') }}">Your Projects</a></li>
	<li><a href ="{{ URL::action('ProfileController@showProgress') }}">Your Progress</li>
	<li>Personal Information</li>
</ul>
</div>
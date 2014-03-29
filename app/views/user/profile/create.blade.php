<h1>Step 2/3 </h1>

<h2>Biography</h2>
	<div class="">
		<form class="form-horizontal" method="POST" action="{{ URL::action('ProfileController@store') }}">
			<div class="">
				<label class="control-label"><h5>Biography</h5>  </label>
				<div class="">
					<textarea class="input-xlarge" type="text" size="100" name="biography" placeholder="Biography" value=""></textarea>
					<span class="help-inline">required</span>
					<span class="help-inline">{{ $errors->first('biography') }}</span>
				</div>
			</div>
			
					
			<div class="form-actions">
				<a href="" class="btn">Cancel</a>
				<button type="submit" class="btn btn-inverse">Save</button>
			</div>
		</form>
	</div>
</div>
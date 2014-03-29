@extends('layout')

@section('content')

<div>
<form class="form-horizontal" method="POST" id="authenticationform" action="{{ URL::action('UserController@validateauthentication')}}" >
	<table class="identify_table">
		<tbody>
			<tr>
				<td rowspan="4" class="identify_image_cell">
					<img src="/img/cardreader.png">
				</td>
				<td>
					<table cellpadding="0" cellspacing="0" border="0">
						<tbody>
							<tr>
						    	<td class="identify_label">
						        	1. Steek uw ING-bankkaart in de ING Card Reader en druk op:
								</td>
								
								<td>
									<img border="0" src="/img/identify.png" alt="Identify"> 
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table cellpadding="0" cellspacing="0" border="0">
						<tbody>
							<tr>
								<td class="identify_label">
									2. Voer de pincode in van uw ING-bankkaart en druk op:
								</td>
								
								<td>
									<img border="0" src="/img/ok.png"> 
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			
			<tr>
				<td valign="top" class="identify_label"> 3. Voer, zonder spaties, de cijfers in die op het scherm van uw ING Card Reader verschijnen.
				</td>
			</tr>
			<tr>
				<td class="bottom_input_cell">
					<input name="txtIdentification"> 
				</td>
			</tr>
		</tbody>
	</table>
	
		<button class="btncheck">Check</button>
	<div class="form-actions">
		<a href="" class="btn">Cancel</a>
		<button type="submit" class="btn btn-inverse">Authenticate</button>
	</div>
</form>
</div>

@section('scripts')
	
	$(".btncheck").click(function(){ 

		$.ajax({
			url:"/openlogin/rest/session?apikey=PLy844B0CxUIE56PvLz1T9IMGpTBAmKA",
			dataType: "jsonp",
			success: function(data){

			console.log(data);
		}
			
	});
});
@stop
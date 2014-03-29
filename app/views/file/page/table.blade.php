@if (count($images))
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th></th>
			<th>Title</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		@foreach ($images as $image)
		<tr>
			<td class="file-thumbnail"><img src="/{{ $image->getSize('thumb')->getPathname() }}"></td>
			<td>{{ $image->title }}</td>
			<td><a class="btn select-image" href="#" data-dismiss="modal" data-image-id="{{ $image->id }}" data-image-title="{{ $image->title }}">Select</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif
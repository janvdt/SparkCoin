@if (count($documents))
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th></th>
			<th>Title</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		@foreach ($documents as $document)
		<tr>
			<td>{{ $document->title }}</td>
			<td><a class="btn select-document" href="#" data-dismiss="modal" data-document-id="{{ $document->id }}" data-document-title="{{ $document->title }}">Select</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif
@extends ('layouts._app')

@section('title', 'Inventory List')

@section('content')
	<div>
		<a href="{{ route('inventoryCreate') }}">Add item</a>
	</div>

	<div>
		@if($records->count())
		<p class='title'>Inventory</p>
		<table>
			<thead>
				<tr>
					<th>Description</th>
					<th>Quantity</th>
					<th>Weight</th>
					<th>Price</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach($records as $record)
				<tr>
					<td>{{ $record->description }}</td>
					<td>{{ $record->quantity }}</td>
					<td>{{ $record->weight}} {{ $record->weight_units }}s</td>
					<td>${{ $record->price }} / {{ $record->price_units }}</td>
					<td><a href="{{ route('inventoryEdit', [$record->id]) }}">Edit</a></td>
					<td><a href="{{ route('inventoryDelete', [$record->id]) }}">Delete</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endisset

		@if($records->isEmpty())
		<p>No inventory could be found.</p>
		@endempty
	</div>
@endsection
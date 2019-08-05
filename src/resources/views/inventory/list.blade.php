@extends ('layouts._app')

@section('title', 'Inventory List')

@section('content')
	<div>
		<a href="{{ route('inventoryCreate') }}">Add item</a>
	</div>

	<div>
		@if($records->count())
		<span class='title'>Inventory</span>
		<table>
			<thead>
				<tr>
					<th>Description</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Seller</th>
				</tr>
			</thead>
			<tbody>
				@foreach($records as $record)
				<tr>
					<td>{{ $record->description }}</td>
					<td>{{ $record->quantity }}</td>
					<td>${{ $record->price }} / {{ $record->units }}</td>
					<td>{{ $record->user->first_name }}</td>
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
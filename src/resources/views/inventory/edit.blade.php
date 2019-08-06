@extends ('layouts._app')

@section('title', 'Edit Inventory Item {{ $record->description }}')

@section('content')

<form method="POST" action="{{ route('inventoryUpdate', $record->id) }}">
	@csrf

	<label for="description">Description:</label>
	<input type="text" name="description" value="{{ $record->description }}" />
	<br />

	<label for="quantity">Quantity:</label>
	<input type="number" name="quantity" value="{{ $record->quantity }}" />
	<br />

	<label for="price">Price:</label>
	<input type="text" name="price_per_unit" value="{{ $record->price_per_unit }}" />
	<br />

	<label for="units">Units:</label>
	<select name="units">
		<option value="">Select</option>
		<option value="lb" {{ $record->units == "lb" ? "selected" : "" }}>lbs</option>
		<option value="kg" {{ $record->units == "kg" ? "selected" : "" }}>kg</option>
		<option value="ea" {{ $record->units == "ea" ? "selected" : "" }}>each</option>
	</select>
	<br />

	<input type="submit" value="Submit" />
</form>

@endsection
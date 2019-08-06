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

	<label for="weight">Weight:</label>
	<input type="text" name="weight" value="{{ $record->weight }}" />
	<br />

	<label for="weight_units">Price Units:</label>
	<select name="weight_units">
		<option value="">Select</option>
		<option value="lb" {{ $record->weight_units == "lb" ? "selected" : "" }}>lbs</option>
		<option value="kg" {{ $record->weight_units == "kg" ? "selected" : "" }}>kg</option>
	</select>
	<br />

	<label for="price">Price:</label>
	<input type="text" name="price" value="{{ $record->price }}" />
	<br />

	<label for="price_units">Price Units:</label>
	<select name="price_units">
		<option value="">Select</option>
		<option value="lb" {{ $record->price_units == "lb" ? "selected" : "" }}>lbs</option>
		<option value="kg" {{ $record->price_units == "kg" ? "selected" : "" }}>kg</option>
		<option value="ea" {{ $record->price_units == "ea" ? "selected" : "" }}>each</option>
	</select>
	<br />

	<input type="submit" value="Submit" />
</form>

@endsection
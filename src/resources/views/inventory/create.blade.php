@extends ('layouts._app')

@section('title', 'Create Inventory Item')

@section('content')

<form method="POST" action="{{ route('inventoryStore') }}">
	@csrf

	<label for="description">Description:</label>
	<input type="text" name="description" />
	<br />

	<label for="quantity">Quantity:</label>
	<input type="number" name="quantity" />
	<br />

	<label for="weight">Weight:</label>
	<input type="text" name="weight" />
	<br />

	<label for="weight_units">Weight Units:</label>
	<select name="weight_units">
		<option value="">Select</option>
		<option value="lb">lbs</option>
		<option value="kg">kg</option>
	</select>
	<br />

	<label for="price">Price:</label>
	<input type="text" name="price" />
	<br />

	<label for="price_units">Units:</label>
	<select name="price_units">
		<option value="">Select</option>
		<option value="lb">lbs</option>
		<option value="kg">kg</option>
		<option value="ea">each</option>
	</select>
	<br />

	<input type="submit" value="Submit" />
</form>

@endsection
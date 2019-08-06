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

	<label for="price">Price:</label>
	<input type="text" name="price_per_unit" />
	<br />

	<label for="units">Units:</label>
	<select name="units">
		<option value="">Select</option>
		<option value="lb">lbs</option>
		<option value="kg">kg</option>
		<option value="ea">each</option>
	</select>
	<br />

	<input type="submit" value="Submit" />
</form>

@endsection
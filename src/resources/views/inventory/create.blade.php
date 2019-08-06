@extends ('layouts._app')

@section('title', 'Create Inventory Item')

@section('content')

<form method="POST" action="{{ route('inventoryStore') }}">
	@csrf

	@if ($errors->has('description'))
	<div class="error">{{ $errors->first('description') }}</div>
	@endif
	<label for="description">Description:</label>
	<input type="text" name="description" />
	<br />

	@if ($errors->has('quantity'))
	<div class="error">{{ $errors->first('quantity') }}</div>
	@endif
	<label for="quantity">Quantity:</label>
	<input type="number" name="quantity" />
	<br />

	@if ($errors->has('weight'))
	<div class="error">{{ $errors->first('weight') }}</div>
	@endif
	<label for="weight">Weight:</label>
	<input type="text" name="weight" />
	<br />

	@if ($errors->has('weight_units'))
	<div class="error">{{ $errors->first('weight_units') }}</div>
	@endif
	<label for="weight_units">Weight Units:</label>
	<select name="weight_units">
		<option value="">Select</option>
		<option value="lb">lbs</option>
		<option value="kg">kg</option>
	</select>
	<br />

	@if ($errors->has('price'))
	<div class="error">{{ $errors->first('price') }}</div>
	@endif
	<label for="price">Price:</label>
	<input type="text" name="price" />
	<br />

	@if ($errors->has('price_units'))
	<div class="error">{{ $errors->first('price_units') }}</div>
	@endif
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
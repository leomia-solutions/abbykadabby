@extends ('layouts._app')

@section('title', 'Inventory List')

@section('content')
<form method="post" action="{{ route('inventoryStore') }}">
	<label for="description">Description:</label>
	<input type="text" name="description" />
	<br />
	<input type="submit" value="Submit" />
</form>
@endsection
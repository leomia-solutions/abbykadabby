<html>
    <head>
    	@if (env('APP_ENV') == 'prd')

		<!-- production version, optimized for size and speed -->
		<script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>

		@else

		<!-- development version, includes helpful console warnings -->
		<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

		@endif

		@yield('js')

        <title>Fresh Tomatoes - @yield('title')</title>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
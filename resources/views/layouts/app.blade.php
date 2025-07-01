<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'MLP To-Do')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Container -->
    <div class="todo-container text-center">

         <!-- Flash Message -->
       @if(session('success'))
    <x-flash-message :message="session('success')" />
    @endif

        <!-- Validation Errors -->
      <x-validation-errors />

        {{-- Page Content --}}
        @yield('content')
    </div>

    <!-- Footer -->
   @include('components.footer')

</body>
</html>

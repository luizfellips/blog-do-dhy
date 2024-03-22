<!doctype html>
<html>

<head>
    @include('includes.head')
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1 0 auto;
        }
    </style>
</head>
@push('styles')
@endpush

<body>
    <div id="main" class="content container">
        @include('layouts.navigation')
        <x-flash-message />
        {{ $slot }}
    </div>
    <footer class="container-fluid position-relative bottom-0" id="footer">
        @include('layouts.footer')
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>

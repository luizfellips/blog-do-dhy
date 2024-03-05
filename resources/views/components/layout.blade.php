<!doctype html>
<html>

<head>
    @include('includes.head')
</head>

<body style="padding-block-start: 120px;">
    <wrapper style="height: 100vh">
        @include('layouts.navigation')

        <div id="main" class="container">
            {{ $slot }}
        </div>
    </wrapper>
    <footer class="container-fluid position-relative bottom-0" id="footer">
        @include('layouts.footer')
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>

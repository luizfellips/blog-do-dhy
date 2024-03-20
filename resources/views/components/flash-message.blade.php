

@if (session()->has('message'))
    @php
        $status = session('status');
    @endphp
    <div class="FlashMessage {{ $status === 'error' ? ' FlashMessage-Error' : '' }}" id="flash-message">
        <p id="message">
            {{ session('message') }}
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var flashMessage = document.getElementById('flash-message');
            var messageElement = document.getElementById('message');

            // Show the flash message
            flashMessage.style.display = 'flex';
            messageElement.innerText = '{{ session('message') }}';

            // Hide the flash message after 3 seconds
            setTimeout(function() {
                flashMessage.style.display = 'none';
            }, 3000);
        });
    </script>
    @php
        session()->forget('message');
    @endphp
@endif

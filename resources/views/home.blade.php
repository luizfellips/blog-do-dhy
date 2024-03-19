<x-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
    @endpush
    <x-carousel :carouselNoticias="$carouselNoticias" />
    <!--cards-->
    <x-cards :noticias="$noticias" />
</x-layout>

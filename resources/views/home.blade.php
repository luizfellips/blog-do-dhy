<x-layout>

    @push('styles')
        <link rel="stylesheet" href="{{asset('css/page/styles.css')}}">
    @endpush
    <x-carousel />
    <!--cards-->
    <x-cards :noticias="$noticias"/>
</x-layout>
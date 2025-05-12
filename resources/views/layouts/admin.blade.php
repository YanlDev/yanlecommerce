{{--@props(['breadcrumbs'=>[], 'actionLink'=>[]])--}}
@props(['breadcrumbs' => [], 'actionLink' => null])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/e1238f483a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

{{--INICIALIZAMOS ALPINE CON x-data  --}}

<body class="font-sans antialiased"
      x-data="{
        sidebarOpen: false
      }"
      :class="{
        'overflow-y-hidden': sidebarOpen
      }"
>
{{-- CORTINA NEGRA PARA CUANDO EL SIDEBAR SE ABRA ESTA SE MUESTRE Y SI SE HACE CLICK SE CIERRA EL SIDEBAR   --}}
<div class="fixed inset-0 bg-gray-900 opacity-50 z-20 sm:hidden"
     style="display:none"
     {{--  SOLO SE MUESTRA SI SIDEBAROPEN ES TRUE      --}}
     x-show="sidebarOpen"
     x-on:click="sidebarOpen = false"
>
</div>

@include('layouts.partials.admin.navbar')
@include('layouts.partials.admin.sidebar')


<div class="p-4 sm:ml-64">
    <div class="mt-14">
        @include('layouts.partials.admin.breadcrum')
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
            {{$slot}}
        </div>
    </div>
</div>

@livewireScripts
@stack('warning-alert')

@if(session('swal'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swalConfig = @json(session('swal'));
            Swal.fire(swalConfig)
        })
    </script>
@endif
<script >
    Livewire.on('swal', data =>{
        // console.log(data)
        Swal.fire(data[0])
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="antialiased">
<div>
    <div class="relative bg-cover bg-center bg-[url(../images/hero.jpg)] min-h-[75vh]">

        <div class="absolute inset-0 bg-gray-700 opacity-70"></div>

        <div class="relative z-10 flex flex-col items-center justify-center h-full">
            <nav class="p-16 flex justify-between items-center text-white w-full">
                <p class="text-2xl">Laptops Intercorp</p>

                <div>
                    <a href="{{ route('welcome') }}"
                       class="text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Inicio</a>
                    <a href="{{ route('products.index') }}"
                       class="ml-4 text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Laptops</a>
                    <a href="#"
                       class="ml-4 text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Contacto</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="ml-4 text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                               class="ml-4 text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Login</a>

                            @if (Illuminate\Support\Facades\Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="ml-4 text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registro</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>

            <div class="flex flex-col justify-center items-center w-1/2 mx-auto text-center">
                <h1 class="font-bold text-5xl text-white">
                    Tu laptop favorita para tus negocios o para uso personal
                </h1>

                <div class="w-1/6 h-1 bg-amber-600 my-8 mx-auto"></div>
            </div>

            <p class="text-white text-xl mb-12 text-center w-1/2">
                Manejamos diferentes tipos de laptops tanto para uso personal como para uso empresarial!
            </p>

            <a href="#about" class="bg-orange-600 font-bold text-white py-4 px-8 rounded-full mb-12">
                Info
            </a>
        </div>
    </div>

    <!-- Section Below the Image -->
    <div class="bg-orange-600 text-white text-center p-16">
        <h3 id="about" class="font-bold text-3xl">¿Quiénes somos?</h3>

        <div class="bg-white h-1 w-1/6 mx-auto my-4"></div>

        <p>
            Somos una empresa en cual nos dedicamos a la venta de laptops para uso personal y empresarial, con
            experiencia de 15 años vendiendo en todo el pais, no esperes mas y invierte en una laptop para el
            futuro
        </p>

        <button class="bg-white font-bold text-black uppercase p-6 rounded-full my-6 hover:bg-gray-300 transition">
            Laptops
        </button>
    </div>

    <!-- Additional Content -->
    <div class="text-center p-16">
        <h3 class="text-3xl font-bold mb-8">Llegadas recientes</h3>

        <div class="w-1/6 bg-orange-600 mx-auto h-1"></div>

        <div class="flex w-full">
            @foreach($latestProducts as $product)
                <div class="flex-col justify-center items-center my-8 flex-1 p-4">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-1/5 rounded-lg">

                    <div class="m-6">
                        <h4 class="font-bold text-2xl">{{ $product->name }}</h4>
                        <p class="text-gray-600 my-4">{{ $product->description }}</p>
                        <a href="{{ route('orders.create', compact('product')) }}"
                           class="uppercase text-sm font-bold text-white bg-orange-600 p-6 rounded-full">Comprar
                            ahora
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class=" w-1/2 mx-auto text-center">
        <h3 class="text-3xl font-bold mb-8">Contáctanos</h3>

        <div class="w-1/6 bg-orange-600 mx-auto h-1 my-5"></div>

        <p>¿Listo para empezar tu proyecto con nosotros? Envíanos un mensaje y te responderemos lo antes posible.</p>


        <form action="{{ route('contact') }}" method="POST" class="flex flex-col items-center">
            @csrf
            <input type="text" name="name" placeholder="Nombre" class="w-full p-4 my-2 mt-8 rounded-lg">
            <input type="email" name="email" placeholder="Correo" class="w-full p-4 my-2 rounded-lg">
            <textarea name="message" placeholder="Mensaje" class="w-full p-4 my-2 rounded-lg"></textarea>
            <button type="submit"
                    class="uppercase mt-8 hover:bg-orange-900 transition w-full bg-orange-600 text-white font-bold p-4 rounded-full">
                Enviar
            </button>
        </form>
    </div>

    <p class="mt-64 text-sm text-center mb-8">Copyright © 2024 - Laptops Intercorp</p>

</div>
</body>
</html>

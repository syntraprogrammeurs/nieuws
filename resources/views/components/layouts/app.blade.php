<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $seo_title ?? 'PinNews - Ontdek het laatste nieuws' }}</title>
    <meta name="description" content="{{ $seo_description ?? 'Blijf op de hoogte van het laatste nieuws in design, tech en meer.' }}">

    <!-- OpenGraph -->
    <meta property="og:title" content="{{ $seo_title ?? 'PinNews' }}">
    <meta property="og:description" content="{{ $seo_description ?? '' }}">
    <meta property="og:image" content="{{ $seo_image ?? '' }}">
    <meta property="og:url" content="{{ $seo_url ?? url()->current() }}">
    <meta property="og:type" content="website">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-plum-black font-sans antialiased">
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md pb-4 pt-4 px-6 flex items-center justify-between">
        <div class="flex items-center gap-4 w-full">
            <a href="/" wire:navigate class="flex items-center justify-center w-12 h-12 rounded-full bg-warm-light hover:bg-sand-gray transition-colors text-pin-red font-bold text-xl">P</a>
            <a href="/" wire:navigate class="text-base font-semibold px-4 py-3 rounded-pin hover:bg-fog transition {{ request()->is('/') ? 'bg-fog' : '' }}">Home</a>
            <a href="/ontdekken" wire:navigate class="text-base font-semibold px-4 py-3 rounded-pin hover:bg-fog transition {{ request()->is('ontdekken*') ? 'bg-fog' : '' }}">Ontdekken</a>
            
            <div class="flex-grow hidden md:flex items-center bg-fog rounded-full px-4 py-3 border border-transparent hover:border-warm-silver transition-all">
                <svg class="w-5 h-5 text-olive-gray mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Zoek naar nieuws, design, tech..." class="bg-transparent border-none outline-none w-full text-plum-black placeholder-olive-gray text-base">
            </div>
        </div>
        <div class="flex items-center gap-2 ml-4">
            @auth
                <a href="/dashboard" wire:navigate class="text-base font-semibold px-4 py-3 rounded-pin hover:bg-fog transition">Dashboard</a>
            @else
                <a href="/login" wire:navigate class="text-base font-semibold px-4 py-3 rounded-pin hover:bg-fog transition">Inloggen</a>
                <button class="bg-pin-red text-white font-semibold text-[15px] px-4 py-3 rounded-pin hover:bg-red-700 transition w-max">Abonneren</button>
            @endauth
        </div>
    </header>

    <main class="max-w-[1680px] mx-auto px-4 sm:px-6 pt-6 pb-12">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>

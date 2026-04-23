<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Admin Dashboard - PinNews' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-plum-black font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-plum-black text-white p-6 hidden md:block">
            <div class="mb-8 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-pin-red flex items-center justify-center font-bold text-lg">P</div>
                <span class="text-xl font-bold tracking-tight">Admin</span>
            </div>

            <nav class="space-y-2">
                <a href="/dashboard" wire:navigate class="block px-4 py-2 rounded-pin hover:bg-white/10 {{ request()->is('dashboard') ? 'bg-white/10' : '' }}">Dashboard</a>
                <a href="/dashboard/artikels" wire:navigate class="block px-4 py-2 rounded-pin hover:bg-white/10 {{ request()->is('dashboard/artikels*') ? 'bg-white/10' : '' }}">Artikels</a>
                <a href="/dashboard/categorieen" wire:navigate class="block px-4 py-2 rounded-pin hover:bg-white/10 {{ request()->is('dashboard/categorieen*') ? 'bg-white/10' : '' }}">Categorieën</a>
            </nav>

            <div class="mt-auto pt-8 border-t border-white/10">
                <a href="/" wire:navigate class="text-sm text-warm-silver hover:text-white transition">Naar de site</a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b border-sand-gray p-4 flex items-center justify-between">
                <h1 class="font-semibold text-lg">{{ $title ?? 'Dashboard' }}</h1>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-olive-gray">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-pin-red font-semibold">Uitloggen</button>
                    </form>
                </div>
            </header>

            <main class="p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>

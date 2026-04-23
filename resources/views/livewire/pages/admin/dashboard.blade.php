<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-pin border border-sand-gray shadow-sm">
            <p class="text-sm text-olive-gray font-medium uppercase tracking-wider mb-1">Artikels</p>
            <p class="text-3xl font-bold text-plum-black">{{ $stats['articles'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-pin border border-sand-gray shadow-sm">
            <p class="text-sm text-olive-gray font-medium uppercase tracking-wider mb-1">Categorieën</p>
            <p class="text-3xl font-bold text-plum-black">{{ $stats['categories'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-pin border border-sand-gray shadow-sm">
            <p class="text-sm text-olive-gray font-medium uppercase tracking-wider mb-1">Totaal Views</p>
            <p class="text-3xl font-bold text-plum-black">{{ number_format($stats['views']) }}</p>
        </div>
        <div class="bg-white p-6 rounded-pin border border-sand-gray shadow-sm">
            <p class="text-sm text-olive-gray font-medium uppercase tracking-wider mb-1">Auteurs</p>
            <p class="text-3xl font-bold text-plum-black">{{ $stats['authors'] }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-pin border border-sand-gray shadow-sm">
        <h3 class="text-lg font-bold mb-4">Recente Activiteit</h3>
        <p class="text-olive-gray italic">Hier komen binnenkort de laatste updates...</p>
    </div>
</div>

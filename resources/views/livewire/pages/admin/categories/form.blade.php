<div>
    <div class="mb-6">
        <a href="/dashboard/categorieen" wire:navigate class="text-sm text-olive-gray hover:text-plum-black transition">← Terug naar overzicht</a>
        <h2 class="text-2xl font-bold mt-2">{{ $category ? 'Bewerk Categorie' : 'Nieuwe Categorie' }}</h2>
    </div>

    <form wire:submit="save" class="bg-white p-8 rounded-pin border border-sand-gray shadow-sm max-w-2xl">
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-semibold mb-2">Naam</label>
                <input type="text" id="name" wire:model.live="name" class="w-full bg-fog border border-transparent rounded-pin px-4 py-3 focus:bg-white focus:border-warm-silver outline-none transition">
                @error('name') <span class="text-pin-red text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-semibold mb-2">Slug</label>
                <input type="text" id="slug" wire:model="slug" class="w-full bg-fog border border-transparent rounded-pin px-4 py-3 focus:bg-white focus:border-warm-silver outline-none transition">
                @error('slug') <span class="text-pin-red text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold mb-2">Beschrijving</label>
                <textarea id="description" wire:model="description" rows="4" class="w-full bg-fog border border-transparent rounded-pin px-4 py-3 focus:bg-white focus:border-warm-silver outline-none transition"></textarea>
                @error('description') <span class="text-pin-red text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-plum-black text-white font-semibold px-6 py-3 rounded-pin hover:bg-black transition">
                    {{ $category ? 'Wijzigingen Opslaan' : 'Categorie Aanmaken' }}
                </button>
            </div>
        </div>
    </form>
</div>

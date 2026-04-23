<div>
    <div class="mb-6">
        <a href="/dashboard/artikels" wire:navigate class="text-sm text-olive-gray hover:text-plum-black transition">← Terug naar overzicht</a>
        <h2 class="text-2xl font-bold mt-2">{{ $article ? 'Bewerk Artikel' : 'Nieuw Artikel' }}</h2>
    </div>

    <form wire:submit="save" class="bg-white p-8 rounded-pin border border-sand-gray shadow-sm max-w-4xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div>
                    <label for="title" class="block text-sm font-semibold mb-2">Titel</label>
                    <input type="text" id="title" wire:model.live="title" class="w-full bg-fog border border-transparent rounded-pin px-4 py-3 focus:bg-white focus:border-warm-silver outline-none transition">
                    @error('title') <span class="text-pin-red text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-semibold mb-2">Slug</label>
                    <input type="text" id="slug" wire:model="slug" class="w-full bg-fog border border-transparent rounded-pin px-4 py-3 focus:bg-white focus:border-warm-silver outline-none transition">
                    @error('slug') <span class="text-pin-red text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="excerpt" class="block text-sm font-semibold mb-2">Inleiding (Excerpt)</label>
                    <textarea id="excerpt" wire:model="excerpt" rows="3" class="w-full bg-fog border border-transparent rounded-pin px-4 py-3 focus:bg-white focus:border-warm-silver outline-none transition"></textarea>
                    @error('excerpt') <span class="text-pin-red text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-semibold mb-2">Inhoud (Content)</label>
                    <textarea id="content" wire:model="content" rows="12" class="w-full bg-fog border border-transparent rounded-pin px-4 py-3 focus:bg-white focus:border-warm-silver outline-none transition"></textarea>
                    @error('content') <span class="text-pin-red text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold mb-2">Afbeelding</label>
                    <div class="relative group aspect-square bg-fog rounded-pin-card overflow-hidden border-2 border-dashed border-sand-gray hover:border-warm-silver transition flex items-center justify-center cursor-pointer">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                        @elseif ($article && $article->image)
                            <img src="{{ $article->image }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-center p-4">
                                <svg class="w-10 h-10 text-olive-gray mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/></svg>
                                <span class="text-xs text-olive-gray">Klik om een foto te uploaden</span>
                            </div>
                        @endif
                        <input type="file" wire:model="image" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                    @error('image') <span class="text-pin-red text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-semibold mb-2">Categorie</label>
                    <select id="category_id" wire:model="category_id" class="w-full bg-fog border border-transparent rounded-pin px-4 py-3 focus:bg-white focus:border-warm-silver outline-none transition">
                        <option value="">Kies een categorie</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-pin-red text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-semibold mb-2">Status</label>
                    <select id="status" wire:model="status" class="w-full bg-fog border border-transparent rounded-pin px-4 py-3 focus:bg-white focus:border-warm-silver outline-none transition">
                        <option value="draft">Concept (Draft)</option>
                        <option value="published">Gepubliceerd</option>
                    </select>
                    @error('status') <span class="text-pin-red text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-pin-red text-white font-semibold px-6 py-4 rounded-pin hover:bg-red-700 transition shadow-lg shadow-pin-red/20">
                        {{ $article ? 'Artikel Bijwerken' : 'Artikel Publiceren' }}
                    </button>
                    <div wire:loading wire:target="image" class="mt-2 text-xs text-olive-gray text-center italic">Afbeelding wordt geüpload...</div>
                </div>
            </div>
        </div>
    </form>
</div>

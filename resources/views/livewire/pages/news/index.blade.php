<div>
    <div class="mb-8 gsap-hero">
        <div class="flex flex-col md:flex-row gap-6 items-center justify-between">
            <div class="flex flex-wrap gap-3">
                <button wire:click="selectCategory(null)" class="{{ is_null($selectedCategory) ? 'bg-plum-black text-white' : 'bg-sand-gray text-plum-black' }} px-4 py-2 rounded-pin text-[15px] font-semibold transition">Voor jou</button>
                @foreach($categories as $category)
                    <button wire:click="selectCategory({{ $category->id }})" class="{{ $selectedCategory == $category->id ? 'bg-plum-black text-white' : 'bg-sand-gray text-plum-black' }} px-4 py-2 rounded-pin text-[15px] font-semibold hover:bg-warm-silver transition">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <div class="w-full md:w-64 relative">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Zoek artikels..." class="w-full bg-fog border border-transparent rounded-full px-10 py-3 focus:bg-white focus:border-warm-silver outline-none transition text-sm">
                <svg class="w-4 h-4 text-olive-gray absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round"/></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($articles as $article)
            <div class="gsap-card group cursor-pointer">
                <a href="/artikel/{{ $article->slug }}" wire:navigate>
                    <div class="rounded-pin-card overflow-hidden">
                        <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="w-full h-auto aspect-square object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="mt-2">
                        <h3 class="font-semibold text-base">{{ $article->title }}</h3>
                        <p class="text-xs text-olive-gray mt-1">
                            {{ $article->category->name }} • {{ $article->published_at->diffForHumans() }}
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-12">
        {{ $articles->links() }}
    </div>
</div>

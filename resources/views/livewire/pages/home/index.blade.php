<div>
    @if($this->featuredArticle)
        <div class="relative rounded-pin-hero overflow-hidden gsap-hero mb-12 min-h-[400px] flex items-center justify-center p-8 md:p-16 {{ $this->featuredArticle->image ? '' : 'bg-fog' }}"
             style="{{ $this->featuredArticle->image ? 'background-image: url('.asset($this->featuredArticle->image).'); background-size: cover; background-position: center;' : '' }}">
            
            @if($this->featuredArticle->image)
                <div class="absolute inset-0 bg-white/70 backdrop-blur-[2px]"></div>
            @endif

            <div class="relative z-10 flex flex-col items-center text-center">
                <span class="bg-white/80 text-plum-black text-sm font-bold px-4 py-1 rounded-full mb-6 shadow-sm">Uitgelicht</span>
                <h1 class="text-4xl md:text-[60px] lg:text-[70px] font-semibold leading-tight tracking-pin-tight mb-6 max-w-4xl text-plum-black">
                    {{ $this->featuredArticle->title }}
                </h1>
                <p class="text-plum-black/80 text-lg max-w-2xl mb-8 font-medium">
                    {{ $this->featuredArticle->excerpt }}
                </p>
                <a href="/artikel/{{ $this->featuredArticle->slug }}" wire:navigate class="bg-pin-red text-white font-semibold text-base px-8 py-4 rounded-pin hover:bg-red-700 transition shadow-xl shadow-pin-red/30">
                    Lees het volledige artikel
                </a>
            </div>
        </div>
    @endif

    <h2 class="text-[28px] font-bold tracking-pin-tight text-plum-black mb-6 px-2 gsap-hero">Trending Vandaag</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($this->trendingArticles as $article)
            <div class="gsap-card group cursor-pointer">
                <a href="/artikel/{{ $article->slug }}" wire:navigate>
                    <div class="relative rounded-pin-card overflow-hidden">
                        <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="w-full h-auto aspect-square object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                    </div>
                    <div class="mt-2 px-1">
                        <h3 class="text-base font-semibold leading-snug">{{ $article->title }}</h3>
                        <p class="text-xs text-olive-gray mt-1">
                            {{ $article->category->name }} • {{ $article->published_at->diffForHumans() }}
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

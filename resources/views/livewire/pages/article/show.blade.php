<main class="max-w-3xl mx-auto px-4 sm:px-6 pt-2 pb-20">
    <article class="gsap-hero">
        <div class="rounded-pin-hero overflow-hidden mb-8 shadow-sm">
            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover max-h-[500px]">
        </div>

        <div class="px-2 md:px-8">
            <div class="flex items-center gap-3 mb-6">
                <span class="bg-fog text-plum-black text-xs font-bold px-3 py-1 rounded-full">{{ $article->category->name }}</span>
                <span class="text-olive-gray text-xs">Gepubliceerd op {{ $article->published_at->format('d F Y') }}</span>
                <span class="text-olive-gray text-xs ml-auto">{{ $article->views }} weergaven</span>
            </div>

            <h1 class="text-[28px] md:text-4xl font-bold tracking-pin-tight mb-6">{{ $article->title }}</h1>
            
            <div class="flex items-center gap-4 mb-10 pb-10 border-b border-sand-gray">
                <div class="w-12 h-12 rounded-full bg-sand-gray overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&auto=format&fit=crop" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="font-semibold text-[15px]">{{ $article->author->name }}</p>
                    <p class="text-xs text-olive-gray">Redactie</p>
                </div>
                <button class="ml-auto bg-sand-gray text-plum-black font-semibold text-[15px] px-4 py-2 rounded-pin hover:bg-warm-silver transition">Volgen</button>
            </div>

            <div class="prose prose-lg text-plum-black leading-relaxed space-y-6">
                {!! nl2br(e($article->content)) !!}
            </div>

            <div class="mt-16 bg-[hsla(60,20%,98%,.5)] border border-sand-gray rounded-pin p-8 text-center flex flex-col items-center">
                <h3 class="text-xl font-bold tracking-pin-tight mb-2">Vond je dit interessant?</h3>
                <p class="text-olive-gray text-sm mb-6">Sla dit artikel op in je persoonlijke borden of deel het met je netwerk.</p>
                <div class="flex gap-4">
                    <button class="bg-pin-red text-white font-semibold px-6 py-3 rounded-pin hover:bg-red-700 transition">Bewaren</button>
                    <button class="bg-sand-gray text-plum-black font-semibold px-6 py-3 rounded-pin hover:bg-warm-silver transition">Delen</button>
                </div>
            </div>
        </div>
    </article>
</main>

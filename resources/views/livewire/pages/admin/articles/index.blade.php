<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Artikels</h2>
        <a href="/dashboard/artikels/create" wire:navigate class="bg-pin-red text-white font-semibold px-4 py-2 rounded-pin hover:bg-red-700 transition">Nieuw Artikel</a>
    </div>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-pin mb-6">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-pin border border-sand-gray shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-sand-gray">
                <tr>
                    <th class="px-6 py-3 text-sm font-semibold text-olive-gray">Titel</th>
                    <th class="px-6 py-3 text-sm font-semibold text-olive-gray">Categorie</th>
                    <th class="px-6 py-3 text-sm font-semibold text-olive-gray">Status</th>
                    <th class="px-6 py-3 text-sm font-semibold text-olive-gray">Views</th>
                    <th class="px-6 py-3 text-sm font-semibold text-olive-gray text-right">Acties</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sand-gray">
                @foreach($articles as $article)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-plum-black">{{ $article->title }}</div>
                            <div class="text-xs text-olive-gray">{{ $article->slug }}</div>
                        </td>
                        <td class="px-6 py-4">{{ $article->category->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-bold {{ $article->status->value === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($article->status->value) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $article->views }}</td>
                        <td class="px-6 py-4 text-right space-x-3 text-sm">
                            <a href="/artikel/{{ $article->slug }}" target="_blank" class="text-olive-gray hover:text-plum-black font-semibold transition">Bekijk</a>
                            <a href="/dashboard/artikels/{{ $article->id }}/edit" wire:navigate class="text-plum-black hover:text-pin-red font-semibold transition">Bewerk</a>
                            <button wire:click="delete({{ $article->id }})" wire:confirm="Weet je zeker dat je dit artikel wilt verwijderen?" class="text-pin-red font-semibold">Verwijder</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $articles->links() }}
    </div>
</div>

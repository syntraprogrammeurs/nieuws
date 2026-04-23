<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Categorieën</h2>
        <a href="/dashboard/categorieen/create" wire:navigate class="bg-pin-red text-white font-semibold px-4 py-2 rounded-pin hover:bg-red-700 transition">Nieuwe Categorie</a>
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
                    <th class="px-6 py-3 text-sm font-semibold text-olive-gray">Naam</th>
                    <th class="px-6 py-3 text-sm font-semibold text-olive-gray">Slug</th>
                    <th class="px-6 py-3 text-sm font-semibold text-olive-gray">Artikels</th>
                    <th class="px-6 py-3 text-sm font-semibold text-olive-gray text-right">Acties</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sand-gray">
                @foreach($categories as $category)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-olive-gray">{{ $category->slug }}</td>
                        <td class="px-6 py-4">{{ $category->articles()->count() }}</td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="/dashboard/categorieen/{{ $category->id }}/edit" wire:navigate class="text-plum-black hover:text-pin-red font-semibold transition">Bewerk</a>
                            <button wire:click="delete({{ $category->id }})" wire:confirm="Weet je zeker dat je deze categorie wilt verwijderen?" class="text-pin-red font-semibold">Verwijder</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

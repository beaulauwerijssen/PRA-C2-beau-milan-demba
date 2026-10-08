<x-layouts.app>
    <div class="row">
        <h1 class="title">Productcategorieën</h1>
    </div>

    <div class="container" style="margin-top: 20px;">
        <div class="categories-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
            @foreach($categories as $category)
                <div class="category-card" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; background-color: #fff;">
                    <h2 style="font-size: 1.5rem; margin-bottom: 10px; color: #333;">{{ $category->name }}</h2>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @forelse($category->brands as $brand)
                            <li style="margin-bottom: 8px;">
                                <a href="{{ url($brand->id . '/' . $brand->name_url_encoded) }}" style="color: #007bff; text-decoration: none;">
                                    {{ $brand->name }}
                                </a>
                            </li>
                        @empty
                            <li style="color: #888; font-style: italic;">Nog geen merken</li>
                        @endforelse
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>

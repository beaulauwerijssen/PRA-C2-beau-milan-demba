<x-layouts.app>
    <x-slot:breadcrumb>
        <li>{{ $letter }}</li>
    </x-slot:breadcrumb>

    <h1>{{ __('misc.brands_starting_with', ['letter' => $letter]) }}</h1>

    @if ($brands->isEmpty())
        <p>{{ __('misc.no_brands_for_letter', ['letter' => $letter]) }}</p>
    @else
        <ul>
            @foreach ($brands as $brand)
                <li>
                    <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">
                        {{ $brand->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</x-layouts.app>

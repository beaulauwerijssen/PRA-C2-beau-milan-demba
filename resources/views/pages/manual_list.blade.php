<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
    </x-slot:breadcrumb>


    <h1>{{ $brand->name }}</h1>

    <p>{{ __('introduction_texts.type_list', ['brand'=>$brand->name]) }}</p>

    <div class="button">

        @if ($popularBrandManuals->isEmpty())
            <p>Voor dit merk zijn nog geen handleidingen beschikbaar.</p>
        @else
            <ul>
                @foreach ($popularBrandManuals as $manual)
                    <p>
                        <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/">
                            {{ $manual->name }}
                        </a>
                    </p>
                @endforeach
            </ul>
        @endif
    </div>
</x-layouts.app>

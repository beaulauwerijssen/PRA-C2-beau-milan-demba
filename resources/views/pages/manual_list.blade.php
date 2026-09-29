<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
    </x-slot:breadcrumb>


    <h1>{{ $brand->name }}</h1>

    <p>{{ __('introduction_texts.type_list', ['brand'=>$brand->name]) }}</p>

    <div class="mt-4 mb-4">
        <h2>Meest bekeken handleidingen</h2>

        @if ($popularBrandManuals->isEmpty())
            <p>Voor dit merk zijn nog geen handleidingen beschikbaar.</p>
        @else
            <ul>
                @foreach ($popularBrandManuals as $manual)
                    <li>
                        <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/">
                            {{ $manual->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

        @foreach ($manuals as $manual)

            @if ($manual->locally_available)
                <a class="btn btn-primary" href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" title="{{ $manual->name }}">{{ $manual->name }}</a>
                ({{$manual->filesize_human_readable}})
            @else
                <a class="btn btn-primary" href="{{ $manual->url }}" target="new" title="{{ $manual->name }}">{{ $manual->name }}</a>
            @endif

            <br />
        @endforeach

</x-layouts.app>

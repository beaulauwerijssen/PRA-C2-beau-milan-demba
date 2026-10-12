<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="{{ __('misc.manuals_for', ['brand' => $brand->name]) }}" title="{{ __('misc.manuals_for', ['brand' => $brand->name]) }}">{{ $brand->name }}</a></li>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" alt="{{ __('misc.view_manual_for', ['brand' => $brand->name, 'manual' => $manual->name]) }}" title="{{ __('misc.view_manual_for', ['brand' => $brand->name, 'manual' => $manual->name]) }}">{{ $manual->name }}</a></li>
    </x-slot:breadcrumb>

    <h1>{{ $brand->name }} - {{ $manual->name }}</h1>

    @if ($manual->locally_available)
        <iframe src="{{ $manual->url }}" width="780" height="600" frameborder="0" marginheight="0" marginwidth="0">
        {{ __('misc.iframes_not_supported') }}<br />
        <a class="btn btn-primary" href="{{ $manual->url }}" target="new" title="{{ __('misc.download_manual_alt') }}">{{ __('misc.download_manual') }}</a>
        </iframe>
    @else
        <a class="btn btn-primary" href="{{ $manual->url }}" target="new" title="{{ __('misc.download_manual_alt') }}">{{ __('misc.download_manual') }}</a>
    @endif

</x-layouts.app>

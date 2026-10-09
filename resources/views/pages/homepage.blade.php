<x-layouts.app>

    <x-slot:introduction_text>
        <p><img src="img/afbl_logo.png" align="right" width="100" height="100">{{ __('introduction_texts.homepage_line_1') }}</p>
        <p>{{ __('introduction_texts.homepage_line_2') }}</p>
        <p>{{ __('introduction_texts.homepage_line_3') }}</p>
    </x-slot:introduction_text>

    <h1>
        <x-slot:title>
            {{ __('misc.all_brands') }}
        </x-slot:title>
    </h1>

    <p>{{ __('misc.created_by', ['name' => $name, 'count' => $brandCount]) }}</p>

    <?php
    $size = count($brands);
    $columns = 3;
    $chunk_size = ceil($size / $columns);
    $letters = $brands->map(fn ($brand) => strtoupper(substr($brand->name, 0, 1)))->unique();
    $seen = [];
    ?>

    <nav aria-label="{{ __('misc.brand_navigation') }}">
        <ul class="brand-letter-navigation">
            @foreach (range('A', 'Z') as $letter)
                @if ($letters->contains($letter))
                    <li><a href="{{ route('brands.letter', ['letter' => $letter]) }}">{{ $letter }}</a></li>
                @endif
            @endforeach
        </ul>
    </nav>

    <div class="row">

            @foreach($brands->chunk($chunk_size) as $chunk)
            <div class="col-md-4 brand-list-container">
                    <ul>
                        @foreach($chunk as $brand)

                            <?php
                            $current_first_letter = strtoupper(substr($brand->name, 0, 1));

                            if (!isset($header_first_letter) || (isset($header_first_letter) && $current_first_letter != $header_first_letter)) {
                                $heading_id = '';
                                if (in_array($current_first_letter, range('A', 'Z'), true) && !isset($seen[$current_first_letter])) {
                                    $heading_id = ' id="brand-letter-' . $current_first_letter . '"';
                                    $seen[$current_first_letter] = true;
                                }
                                echo '</ul>
						<h2' . $heading_id . '>' . $current_first_letter . '</h2>
						<ul>';
                            }
                            $header_first_letter = $current_first_letter
                            ?>

                            <li>
                                <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">{{ $brand->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <?php
                unset($header_first_letter);
                ?>
            @endforeach

    </div>

    <div class="mt-5">
        <h2>{{ __('misc.most_viewed_manuals') }}</h2>

        @if ($popularManuals->isEmpty())
            <p>{{ __('misc.no_manuals') }}</p>
        @else
            <ul>
                @foreach ($popularManuals as $manual)
                    <li>
                        <a href="/{{ $manual->brand_id }}/{{ $manual->brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/">
                            {{ $manual->brand->name }}: {{ $manual->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</x-layouts.app>

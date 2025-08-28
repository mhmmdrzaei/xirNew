@extends('layouts.app')

@section('content')
  <article >
    <header class="single-artist__header">
      @if(has_post_thumbnail())
        {!! get_the_post_thumbnail(get_the_ID(), 'full', ['class'=>'single-artist__image']) !!}
      @endif

      <h1 class="single-artist__title">{!! get_the_title() !!}</h1>

      @php $links = get_field('social_media_links') ?: []; @endphp
      @if(!empty($links))
        <ul class="social-links flex gap-2 mt-4">
          @foreach($links as $row)
            @php
              $title = $row['social_platform'] ?? '';
              $url   = $row['social_link'] ?? '';
            @endphp
            @if($title && $url)
              <li>
                <x-button href="{{ esc_url($url) }}" target="_blank" variant="ghost">
                  {{ $title }}
                </x-button>
              </li>
            @endif
          @endforeach
        </ul>
      @endif
    </header>

    <div class="single-artist__content prose">
      @php the_content() @endphp
    </div>
  </article>
@endsection

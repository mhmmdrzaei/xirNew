@extends('layouts.app')

@section('content')
@php 
  $about = get_page_by_path('about'); 
@endphp

@if ($about)
  @php
    // Get content with proper formatting
    $content = apply_filters('the_content', $about->post_content);
    // Split into paragraphs
    preg_match('/<p>(.*?)<\/p>/', $content, $matches);
    $first_paragraph = $matches[0] ?? '';
  @endphp

  <section class="home-intro wrap">
    <div class="intro">
      {!! $first_paragraph !!}
    </div>

    <x-button href="{{ get_permalink($about) }}">Read more</x-button>
  </section>
@else
  <p>Create a page with slug “about” to show intro here.</p>
@endif
  </section>

  <section class="home-current-resident wrap">
    @php
      $current = new WP_Query([
        'post_type' => 'artist',
        'posts_per_page' => 1,
        'tax_query' => [[
          'taxonomy' => 'resident_status',
          'field' => 'slug',
          'terms' => ['current'],
        ]],
        'orderby' => 'date',
        'order' => 'DESC',
      ]);
    @endphp

    @if($current->have_posts())
      <h2>Current Resident</h2>
      @while($current->have_posts()) @php $current->the_post(); @endphp
        <article class="resident-card">
          <a href="{{ get_permalink() }}">
            @if(has_post_thumbnail())
              {!! get_the_post_thumbnail(get_the_ID(), 'large', ['class'=>'resident-card__image']) !!}
            @endif
            <h3 class="resident-card__title">{{ get_the_title() }}</h3>
          </a>
        </article>
      @endwhile
      @php wp_reset_postdata(); @endphp
    @endif
  </section>
@endsection

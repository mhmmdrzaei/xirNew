{{-- resources/views/template-artists.blade.php --}}
{{--
  Template Name: Artists
--}}

@extends('layouts.app')

@section('content')
  <section class="artists wrap">
    <h1>{{ get_the_title() }}</h1>

    @php
      $artists = new WP_Query([
        'post_type'      => 'artist',   // or 'artists' depending on your slug
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
      ]);
    @endphp

    @if($artists->have_posts())
      <div class="artists-grid">
        @while($artists->have_posts()) @php $artists->the_post() @endphp
          <article {{ post_class('artist-card') }}>
            {{-- Featured Image --}}
            @if(has_post_thumbnail())
              <a href="{{ get_permalink() }}">
                {!! get_the_post_thumbnail(null, 'medium', ['class' => 'artist-thumb']) !!}
              </a>
            @endif

            {{-- Title --}}
            <h2 class="artist-title">
              <a href="{{ get_permalink() }}">{{ get_the_title() }}</a>
            </h2>

            {{-- Residence Year (ACF field) --}}
            @if($year = get_field('residence_year'))
              <p class="artist-year">{{ $year }}</p>
            @endif
          </article>
        @endwhile
      </div>
      @php wp_reset_postdata() @endphp
    @else
      <p>No artists found.</p>
    @endif
  </section>
@endsection

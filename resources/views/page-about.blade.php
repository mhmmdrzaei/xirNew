{{-- resources/views/template-about.blade.php --}}
{{--
  Template Name: About
--}}

@extends('layouts.app')

@section('content')
  <section class="about wrap">
    @while(have_posts()) @php the_post() @endphp
      @php
        // Get full content
        $content = apply_filters('the_content', get_the_content());

        // Grab the first paragraph
        preg_match('/<p>(.*?)<\/p>/', $content, $matches);
        $intro = $matches[0] ?? '';

        // Remove first paragraph
        $rest = preg_replace('/<p>(.*?)<\/p>/', '', $content, 1);
      @endphp

      {{-- Intro Paragraph --}}
      @if($intro)
        <div class="about-intro">
          {!! $intro !!}
        </div>
      @endif

      {{-- Rest of the Content --}}
      <div class="about-content">
        {!! $rest !!}
      </div>

      {{-- Columns Repeater --}}
      @if(have_rows('columns'))
        <div class="about-columns grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
          @while(have_rows('columns')) @php the_row() @endphp
            @php 
              $label = get_sub_field('column_content')['column_label'] ?? '';
              $col_content = get_sub_field('column_content')['column_content'] ?? '';
            @endphp

            <div class="about-column p-4 border rounded">
              @if($label)
                <h3 class="column-label text-lg font-semibold mb-2">{{ $label }}</h3>
              @endif
              @if($col_content)
                <div class="column-content prose">{!! $col_content !!}</div>
              @endif
            </div>
          @endwhile
        </div>
      @endif

      {{-- Funder Info --}}
      @if($funder = get_field('funder_info'))
        <div class="about-funder mt-12 prose">
          {!! $funder !!}
        </div>
      @endif

      {{-- Contact Repeater --}}
      @if(have_rows('contact'))
        <div class="about-contact mt-12">
          <h2 class="text-xl font-bold mb-4">Contact</h2>
          <ul class="space-y-3">
            @while(have_rows('contact')) @php the_row() @endphp
              @php 
                $label   = get_sub_field('contact_info')['contact_label'] ?? '';
                $address = get_sub_field('contact_info')['contact_address'] ?? '';
              @endphp

              <li>
                @if($label)
                  <strong>{{ $label }}:</strong>
                @endif
                @if($address)
                  <a href="mailto:{{ $address }}" class="text-blue-600 hover:underline">
                    {{ $address }}
                  </a>
                @endif
              </li>
            @endwhile
          </ul>
        </div>
      @endif

    @endwhile
  </section>
@endsection

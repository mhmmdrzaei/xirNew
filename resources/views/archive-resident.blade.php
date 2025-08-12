@extends('layouts.app')

@section('content')
  <div class="wrap">
    <h1 class="page-title">Residents</h1>

    @if (have_posts())
      <div class="grid grid--residents">
        @while(have_posts()) @php the_post(); @endphp
          <article {{ post_class('resident-card') }}>
            <a href="{{ get_permalink() }}">
              @if(has_post_thumbnail())
                {!! get_the_post_thumbnail(get_the_ID(), 'large', ['class'=>'resident-card__image']) !!}
              @endif
              <h2 class="resident-card__title">{{ get_the_title() }}</h2>
              @php $year = get_field('residence_year'); @endphp
              @if($year)
                <div class="resident-card__meta">{{ $year }}</div>
              @endif
            </a>
          </article>
        @endwhile
      </div>

      {!! get_the_posts_pagination() !!}
    @else
      <p>No residents found.</p>
    @endif
  </div>
@endsection

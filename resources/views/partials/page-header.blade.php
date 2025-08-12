<header class="site-header" role="banner">
  <div class="wrap">
    <div class="brand">
      @if(function_exists('the_custom_logo') && has_custom_logo())
        {!! get_custom_logo() !!}
      @else
        <a class="site-title" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
      @endif
    </div>

    <nav class="nav-primary" aria-label="Primary">
      {!! wp_nav_menu([
        'theme_location' => 'primary',
        'menu_class' => 'menu menu--primary',
        'container' => false,
        'echo' => false,
      ]) !!}
    </nav>
  </div>
</header>

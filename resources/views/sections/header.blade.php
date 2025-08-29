<header class="header">
  <div class="header-left">
    <label class="x-cross">
      <input type="checkbox" class="x-checkbox" />
      <span class="x-box"></span>
    </label>

    <h1 class="site-title">
      <a href="{{ home_url('/') }}">{{ get_bloginfo('name') }}</a>
    </h1>
  </div>

  <nav class="main-nav">
    @if(has_nav_menu('primary_navigation'))
      {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'container' => false,
          'menu_class' => 'menu-list',
          'fallback_cb' => false,
          'echo' => false,
      ]) !!}
    @endif
  </nav>

  <button class="hamburger" id="menu-toggle" aria-label="Toggle Menu">
    <span></span>
    <span></span>
    <span></span>
  </button>
</header>

<div id="mobile-menu" class="mobile-menu">
  <nav>
    @if(has_nav_menu('primary_navigation'))
      {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'container' => false,
          'menu_class' => 'menu-list',
          'echo' => false,
      ]) !!}
    @endif
  </nav>
</div>

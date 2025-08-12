<footer class="site-footer" role="contentinfo">
  <div class="wrap">
    <nav class="nav-footer" aria-label="Footer">
      {!! wp_nav_menu([
        'theme_location' => 'footer',
        'menu_class' => 'menu menu--footer',
        'container' => false,
        'echo' => false,
      ]) !!}
    </nav>
    <p class="copy">© {{ date('Y') }} {{ get_bloginfo('name') }}</p>
  </div>
</footer>

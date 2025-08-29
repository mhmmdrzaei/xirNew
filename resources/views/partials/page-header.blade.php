<header class="header flex items-center justify-between p-6">
  {{-- Site title + decorative input --}}
  <div class="flex items-center gap-4">
    <a href="{{ home_url('/') }}" class="site-title text-[50px] text-black no-underline
 uppercase font-bold">
      {{ get_bloginfo('name') }}
    </a>

    {{-- Toggleable decorative input --}}
    <label class="relative">
      <input type="checkbox" class="peer hidden" />
      <span
        class="w-[66px] h-[66px] border border-black rounded-[11px] flex items-center justify-center text-[50px] leading-none cursor-pointer select-none font-bold peer-checked:after:content-['X']">
      </span>
    </label>
  </div>

  {{-- Navigation (desktop) --}}
  <nav class="main-nav hidden md:flex gap-12 text-[30px] uppercase font-bold">
    @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'flex gap-12',
          'echo' => false
      ]) !!}
    @endif
  </nav>

  {{-- Hamburger button (mobile only) --}}
  <button class="md:hidden flex flex-col gap-1 z-50" id="menu-toggle" aria-label="Toggle Menu">
    <span class="w-8 h-1 bg-black"></span>
    <span class="w-8 h-1 bg-black"></span>
    <span class="w-8 h-1 bg-black"></span>
  </button>
</header>

{{-- Mobile Menu Overlay --}}
<div id="mobile-menu" class="fixed inset-0 bg-white flex flex-col items-center justify-center hidden z-40 md:hidden">
  <nav class="flex flex-col gap-8 text-[30px] uppercase font-bold text-center">
    @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'flex flex-col gap-8',
          'echo' => false
      ]) !!}
    @endif
  </nav>
</div>

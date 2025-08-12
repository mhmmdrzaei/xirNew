@props([
  'href' => '#',
  'variant' => 'primary',
  'target' => null,
])

<a href="{{ $href }}"
   @if($target) target="{{ $target }}" rel="noopener noreferrer" @endif
   {{ $attributes->merge(['class' => 'btn btn--'.$variant]) }}>
  {{ $slot }}
</a>

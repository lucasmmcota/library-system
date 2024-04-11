@if (!empty($dataTarget))
    <a class="text-secondary" title="{{ $title }}" data-target="{{ $dataTarget }}" data-toggle="{{ $dataToggle }}">
@else
    <a class="text-secondary" title="{{ $title }}" href="{{ $route }}" @if (!empty($target)) target="{{ $target }}" @endif>
@endif
    <i class="{{ $icon }}"></i>
</a>

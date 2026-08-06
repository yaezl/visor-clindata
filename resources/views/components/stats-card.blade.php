@props([
    'label'  => '',
    'value'  => 0,
    'color'  => 'primary',   // primary | success | warning | info
])

<div class="stats-card">
    <span class="stats-card__label">{{ $label }}</span>
    <span class="stats-card__value stats-card__value--{{ $color }}">{{ $value }}</span>
</div>
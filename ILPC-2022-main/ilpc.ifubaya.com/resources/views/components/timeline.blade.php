<li class="timeline-item">
    <span class="timeline-point {{ $iconColor }}">
        <i data-feather="{{ $icon }}"></i>
    </span>
    <div class="timeline-event">
        {{ $slot }}
    </div>
    <br>
</li>
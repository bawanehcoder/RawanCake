<div class="down">
    <div class="data">
        {{-- remaining time --}}
        <p class="time">
            <i class="far fa-clock"></i>
            <?php $endsAt = \Illuminate\Support\Carbon::parse($time) ?>
            <span data-countdown="{{ $endsAt }}">{{ $endsAt->format('%D:%H:%I:%S') }}</span>
        </p>
    </div>
</div>

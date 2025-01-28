<p class="time ">
    <i class="fa fa-clock fa-clock"></i>
    <span class="row " data-countdown="{{ $end_time }}">{{ now()->diff($end_time)->format('%D:%H:%I:%S') }}</span>
</p>




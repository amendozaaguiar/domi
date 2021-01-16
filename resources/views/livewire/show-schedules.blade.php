<div>
    @include('errors.errors')
    <ul class="list-group">
        <div class="row">
            @foreach ($schedules as $schedule)
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-2" wire:click="store_schedule_requests({{$schedule->id }})">
                    <li class="list-group-item justify-content-between
                        @if(!empty($schedule_requests->where('schedule_id', '=', $schedule->id)->first()))
                            @php($exists_schedule_request = true)
                            bg-success
                        @else
                            @php($exists_schedule_request = false)
                        @endif

                        @if($schedule->maximum_allocation - $schedule->allocations==0 && !$exists_schedule_request)
                            bg-danger
                        @endif
                        ">
                        <div class="row">
                            <div class="col-6">
                                Horario: {{ $schedule->time }}
                            </div>
                            <div class="col-6">
                                <h5 class="float-right">
                                    <span class="badgetext badge badge-primary badge-pill">{{ $schedule->maximum_allocation - $schedule->allocations }}</span>
                                </h5>
                            </div>
                        </div>
                    </li>
                </div>
            @endforeach
        </div>
    </ul>
</div>

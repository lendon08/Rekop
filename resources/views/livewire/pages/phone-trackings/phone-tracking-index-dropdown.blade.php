<div>
    @if(!empty($sched['call_request_url']))
        {{ $sched['bin_name'] }}   
        @if($sched['start_sched'] === $sched['end_sched'])
            (No Schedule)
        @else
        {{ " (". date("h:ia", strtotime($sched['start_sched']))."-".date("h:ia", strtotime($sched['end_sched'])).")" }}
        @endif
    @endif
</div>
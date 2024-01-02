<div>
    {{ $sched['fwd'] }}   
    @if(is_null($sched['fwd'])==1)
        
    @else
    {{ " (". date("h:ia", strtotime($sched['start_sched']))."-".date("h:ia", strtotime($sched['end_sched'])).")" }}
    @endif

</div>
@if (Session::has('loginas') )
    <div class="bg-lime-100 text-center py-4 border-b border-lime-400 text-black">
        <i class="fa fa-exclamation-triangle text-lime-400"></i>&nbsp;
        Opgelet, u handelt namens een andere gebruiker (<span class="font-bold">{{auth()->user()->name}}</span>).
        Vergeet niet uit te loggen als u klaar bent!&nbsp;&nbsp;
        <a class="p-1 bg-lime-400 text-white rounded" href="{{route('stoploginas', 1)}}"><i class="fas fa-sign-in-alt"></i>&nbsp;Terug naar admin</a>
    </div>
@endif

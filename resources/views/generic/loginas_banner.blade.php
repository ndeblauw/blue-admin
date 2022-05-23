@if (Session::has('loginas') )
    <div class="bg-lime-100 text-center py-4 border-b border-lime-400 text-black">
        <i class="fa fa-exclamation-triangle text-lime-400"></i>&nbsp;
        Attention, you are acting on behalf of another user (<span class="font-bold">{{auth()->user()->name}}</span>).
        Don't forget to logout when ready!&nbsp;&nbsp;
        <a class="p-1 bg-lime-400 text-white rounded" href="{{route('stoploginas', 1)}}"><i class="fas fa-sign-in-alt"></i>&nbsp;Back to admin</a>
    </div>
@endif

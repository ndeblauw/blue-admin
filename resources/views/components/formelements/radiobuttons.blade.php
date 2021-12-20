<div class="space-y-6 sm:space-y-5">
    <div class="sm:grid sm:grid-cols-6 sm:gap-4 sm:items-start sm:pt-5">
        @include('BlueAdminFormelements::_label')
        <div class="mt-1 sm:mt-0 sm:col-span-5 @if($inline) flex flex-row gap-x-4 @endif">
            @foreach($options as $option => $label)
                <div class="leading-loose">
                    <label class="">
                        <input type="radio" class="" name="{{$name}}" value="{{$option}}" id="{{$name}}-{{$option}}"
                               @if($option == old($name, $value)) checked @endif >
                        {{$label}}
                    </label>
                </div>
            @endforeach
            @include('BlueAdminFormelements::_errorandcomment')
        </div>
    </div>
</div>

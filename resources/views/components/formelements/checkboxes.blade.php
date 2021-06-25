<div class="space-y-6 sm:space-y-5">
    <div class="sm:grid sm:grid-cols-6 sm:gap-4 sm:items-start sm:pt-5">
        @include('BlueAdminFormelements::_label')
        <div class="mt-1 sm:mt-0 sm:col-span-5">
            @foreach($options as $optionValue => $optionLabel)
                <div class="leading-loose @if($inline) @endif">
                    <label class="">
                        <input type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-blue-600 border-gray-300 rounded" name="{{$name}}[]" value="{{$optionValue}}" id="{{$name}}-{{$optionValue}}"
                               @if(in_array($optionValue, old($name,$values))) checked @endif >
                        {{$optionLabel}}
                    </label>
                </div>
            @endforeach
            @include('BlueAdminFormelements::_errorandcomment')
        </div>
    </div>
</div>

<div class="space-y-6 sm:space-y-5">
    <div class="sm:grid sm:grid-cols-6 sm:gap-4 sm:items-start sm:pt-5">
        @include('BlueAdminFormelements::_label')
        <div class="mt-1 sm:mt-0 sm:col-span-5">
            <label>
                <input type="hidden" name="{{$name}}" value="{{ $disabled ? ($value ? 1 : 0) : 0 }}">
                <input {{ ($disabled) ? 'disabled' : '' }}
                        type="checkbox" id="{{$id}}" name="{{$name}}" value="1"
                       class="focus:ring-indigo-500 h-4 w-4 text-blue-600 border-gray-300 rounded {{ ($disabled) ? '!text-blue-200' : '' }}"
                       @if(old($name,$value)) checked @endif >
                <span class="{{ ($disabled) ? 'text-gray-400' : '' }}">{{ ($legend =='') ? 'Yes': $legend}}</span>
            </label>
            @include('BlueAdminFormelements::_errorandcomment')
        </div>
    </div>
</div>

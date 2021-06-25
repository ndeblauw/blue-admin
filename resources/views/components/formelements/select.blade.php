<div class="space-y-6 sm:space-y-5">
    <div class="sm:grid sm:grid-cols-6 sm:gap-4 sm:items-start sm:pt-5">
        @include('BlueAdminFormelements::_label')
        <div class="mt-1 sm:mt-0 sm:col-span-5">
            <select
                name="{{$name}}"
                id="{{$id}}"
                class="max-w-lg block {{$size ?? 'w-full'}} shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-lg sm:text-sm {{ $errors->first($name) ? 'border-red-300' : 'border-gray-300' }} rounded-md"
                {{ $required ? 'required' : '' }}
                {{$disabled}}
            >
                @if (empty($value))
                    <option value="" hidden selected>---Select---</option>
                @endif
                    @if($allowNullOption)
                        <option @if($value == null)selected="selected" @endif value="">-</option>
                    @endif
                @foreach($options as $optionValue => $optionLabel)
                    <option @if($optionValue == old($name, $value)) selected @endif value="{{$optionValue}}">{{$optionLabel}}</option>
                @endforeach
            </select>

            @include('BlueAdminFormelements::_errorandcomment')
        </div>
    </div>
</div>

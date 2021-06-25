<div class="space-y-6 sm:space-y-5">
    <div class="sm:grid sm:grid-cols-6 sm:gap-4 sm:items-start sm:pt-5">
        @include('BlueAdminFormelements::_label')
        <div class="mt-1 sm:mt-0 sm:col-span-5 text-black">
            <select
                name="{{$name}}[]"
                id="{{$id}}"
                class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-lg sm:text-sm {{ $errors->first($name) ? 'border-red-300' : 'border-gray-300' }} rounded-md"
                {{ $required ? 'required' : '' }}
                {{$disabled}}
                multiple
            >
                @if($allowNullOption)
                    <option @if($values == [])selected="selected" @endif value="">-</option>
                @endif
                @foreach($options as $optionValue => $optionLabel)
                    <option @if(in_array($optionValue, old($name,$values))) selected @endif value="{{$optionValue}}" class="text-black">{{$optionLabel}}</option>
                @endforeach
            </select>

            <script>
                var {{$id}} = new Choices(
                    '#{{$id}}',
                    {
                        removeItemButton: true,
                        shouldSort: false,
                    }
                );
            </script>

            @include('BlueAdminFormelements::_errorandcomment')
        </div>
    </div>
</div>

@push('blueadmin_header')
    {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/base.min.css"/>--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
@endpush

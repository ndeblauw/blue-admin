<div class="space-y-6 sm:space-y-5">
    <div class="sm:grid sm:grid-cols-6 sm:gap-4 sm:items-start sm:pt-5">
        @include('BlueAdminFormelements::_label')
        <div class="mt-1 sm:mt-0 sm:col-span-5"
            x-data="{ selectedOption: '' }"
            x-init="() => {
                select2_{{$id}} = $($refs.select).select2();
                select2_{{$id}}.on('select2_{{$id}}:select', (event) => {
                    selectedOption = event.target.value;
                });
                $watch('selectedOption', (value) => {
                    select2_{{$id}}.val(value).trigger('change');
                });
            }"
        >
            <select x-ref="select" data-placeholder="Select an option"
                name="{{$name}}"
                id="{{$id}}"
                class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-lg sm:text-sm {{ $errors->first($name) ? 'border-red-300' : 'border-gray-300' }} rounded-md"
                {{ $required ? 'required' : '' }}
                {{$disabled}}
            >
                @if (empty($value))
                    <option></option>
                @else
                    @if( $allowNullOption)
                        <option @if($value == null)selected="selected" @endif value="">-</option>
                    @endif
                @endif
                @foreach($options as $optionValue => $optionLabel)
                    <option @if($optionValue == old($name, $value)) selected @endif value="{{$optionValue}}">{{$optionLabel}}</option>
                @endforeach
            </select>

            @include('BlueAdminFormelements::_errorandcomment')
        </div>
    </div>
</div>

@push('blueadmin_header')
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css'>
@endpush

@push('blueadmin_scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js'></script>
@endpush

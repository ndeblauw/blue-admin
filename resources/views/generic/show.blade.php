<x-ba-admin-layout>

        <div class="bg-white shadow overflow-hidden sm:rounded-b-lg border-t-2 border-{{$config->color ?? 'blue-500'}}">

            {{-- Card Top Header --}}
            <div class="px-4 py-5 sm:px-6 flex justify-between bg-gray-50">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{__('Details for')}} <span class="font-bold">{{$model->title}}</span>
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        {{ __('Record of type') }} {{$config->name_to_use}}
                    </p>
                </div>
                <div class="my-auto flex gap-x-2">
                    <x-ba-admin-button href="{{$config->getEditUrl($model->id)}}" class="py-1 bg-blue-500">Edit</x-ba-admin-button>
                    <form action="{{$config->getDestroyUrl($model->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <x-button class="py-1 bg-blue-300">Delete</x-button>
                    </form>
                </div>

            </div>

            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    @foreach($attributesToShow as $attribute)
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-5 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                {{$attribute}}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-4">
                                @if($model->$attribute === true) <i class="fad fa-check-square text-green-300"></i> @endif
                                @if($model->$attribute === false) <i class="fal fa-square"></i> @endif
                                {{ is_object($model->$attribute) ? 'Object - cannot show details' : $model->$attribute }}
                            </dd>
                        </div>
                    @endforeach

                </dl>
            </div>
            <div class="text-sm text-gray-400 px-6 float-right">
                Last updated <span class="font-bold">{{$model->updated_at->diffForHumans()}}</span> ({{$model->updated_at}})
                <span class="text-blue-300">|</span>
                Created <span class="font-bold">{{$model->created_at->diffForHumans()}}</span> ({{$model->created_at}})
            </div>
        </div>


</x-ba-admin-layout>

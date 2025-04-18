<x-ba-admin-layout title="Details for {{$model->title ?? $model->name}}" :showTitle="false">

    <flux:heading size="xl" level="1" class="flex justify-between items-center mb-2">
        <div>Details for {{$model->title ?? $model->name}}</div>

        <div class="flex gap-x-4">
            @if(auth()->user()->isAdmin() && get_class($model) === \App\Models\User::class)
                <flux:button href="{{route('loginas', ['user' => $model])}}" icon="shield-exclamation" variant="filled" size="sm" class="!text-pink-500 hover:!bg-pink-50">Impersonate</flux:button>
            @endif

            @if( View::exists('admin.'.$config->modelsname().'._form'))
                <flux:button href="{{$config->getEditUrl($model->getKey())}}" icon="pencil" variant="filled" size="sm">Edit</flux:button>
            @endif
            <x-ba-delete-button action="{{$config->getDestroyUrl($model->getKey()) }}" />
        </div>

    </flux:heading>

    <flux:separator />

    <div class="mt-8 overflow-hidden border border-zinc-200 rounded-lg">

            <div class="px-4 py-5 sm:p-0">
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

        </div>
        <div class="text-xs mt-1 text-zinc-400 pr-2 float-right">
            Last updated <span class="font-bold">{{$model->updated_at->diffForHumans()}}</span> ({{$model->updated_at}})
            <span class="text-zinc-500">|</span>
            Created <span class="font-bold">{{$model->created_at->diffForHumans()}}</span> ({{$model->created_at}})
        </div>


</x-ba-admin-layout>

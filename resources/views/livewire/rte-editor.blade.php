<div>
    <input type="hidden" name="{{$name}}" wire:model="content">
    <flux:editor
            wire:model="content"
            toolbar="heading | bold italic | link | bullet ordered ~ undo redo"
            class="{{ $errors->first($name) ? '!border-red-300' : '' }}"
    ></flux:editor>
</div>

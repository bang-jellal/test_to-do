<div class="flex-sb-m w-full p-b-30">
    <div class="contact100-form-checkbox">
        <input class="input-checkbox100 todo" id="todo-{{ $item->id }}" type="checkbox" value="{{ $item->id }}">
        <label class="label-checkbox100" for="todo-{{ $item->id }}">
            {{ $item->name }}
        </label>
    </div>
</div>
@props(['id', 'name', 'value' => ''])

<div
    x-data="{ 
        content: @entangle($attributes->wire('model')),
        setValue() {
            if (this.$refs.trix && this.$refs.trix.editor) {
                this.$refs.trix.editor.loadHTML(this.content || '')
            }
        }
    }"
    x-init="setValue()"
    x-on:trix-initialize="setValue()"
    @reset-trix.window="setValue()"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    wire:ignore>
    <input id="{{ $id }}" type="hidden" name="{{ $name }}">
    <trix-editor x-ref="trix" input="{{ $id }}" x-on:trix-change="content = $event.target.value" class="trix-content border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm min-h-[300px]"></trix-editor>
</div>

@once
@push('styles')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<style>
    .trix-content {
        width: 100%;
    }

    trix-toolbar [data-trix-button-group="file-tools"] {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpush
@endonce
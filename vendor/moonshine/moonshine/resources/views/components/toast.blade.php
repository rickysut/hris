@props([
    'type' => 'default',
    'content' => '',
    'showOnCreate' => true
])

@if($showOnCreate)
<div x-data
     x-init="$nextTick(() => { $dispatch('toast', {type: '{{ $type }}', text: '{{ $content }}'}) })"
></div>
@else
    <div x-data="{ show(){$dispatch('toast', {type: '{{ $type }}', text: '{{ $content }}'})} }">
        {{ $slot }}
    </div>
@endif

@pushonce('scripts')
    <div x-data="toasts()" class="toast-container" @toast.window="add($event.detail)">
        <template x-for="toast of toasts" :key="toast.id">
            <div
                x-show="visible.includes(toast)"
                x-transition:enter="transition ease-in duration-200"
                x-transition:enter-start="transform opacity-0 translate-y-2"
                x-transition:enter-end="transform opacity-100"
                x-transition:leave="transition ease-out duration-500"
                x-transition:leave-start="transform translate-x-0 opacity-100"
                x-transition:leave-end="transform translate-x-full opacity-0"
                @click="remove(toast.id)"
                class="toast-item"
                :class="{
                    'toast-success': toast.type === 'success',
                    'toast-info': toast.type === 'info',
                    'toast-warning': toast.type === 'warning',
                    'toast-error': toast.type === 'error',
                }"
                x-text="toast.text"
            ></div>
        </template>
    </div>
@endpushonce


@inject('dialog', 'App\Services\DialogCvaService')

<dialog wire:ignore.self x-effect="__dialogOpen ? $el.showModal() : $el.close()" x-on:cancel="__dialogOpen = false"
    {{ $attributes->twMerge($dialog(['side' => 'center', 'variant' => 'dialog']), 'bg-white backdrop:bg-background/30 relative left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2') }}>
    {{ $slot }}

    <button
        class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none data-[state=open]:bg-accent data-[state=open]:text-muted-foreground"
        variant="ghost" size="icon" x-on:click="__dialogOpen = false">
        <x-lucide-x class="size-4" />
        <span class="sr-only">Close</span>
    </button>
</dialog>

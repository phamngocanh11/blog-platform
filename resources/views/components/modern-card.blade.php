{{-- Modern Design Card Component --}}
@props(['title' => 'Card Title', 'description' => 'Card description'])

<article {{ $attributes->merge(['class' => 'group cursor-pointer flex flex-col bg-surface-container-lowest rounded-lg border border-outline-variant hover:shadow-lg transition-all duration-300']) }}>
    {{-- Image --}}
    @if(isset($image))
        <div class="relative w-full h-64 overflow-hidden rounded-t-lg bg-surface-variant">
            {{ $image }}
        </div>
    @endif

    {{-- Content --}}
    <div class="flex flex-col space-y-3 p-6 flex-grow">
        {{-- Title --}}
        <h3 class="font-display text-headline-md text-on-surface group-hover:text-primary transition-colors">
            {{ $title }}
        </h3>

        {{-- Description --}}
        <p class="font-body text-body-md text-on-surface-variant line-clamp-3">
            {{ $description }}
        </p>

        {{-- Footer Slot --}}
        @if(isset($footer))
            <div class="mt-auto pt-4 border-t border-outline-variant">
                {{ $footer }}
            </div>
        @endif
    </div>
</article>

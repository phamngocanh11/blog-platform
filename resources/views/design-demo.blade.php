<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Design Demo - .Blog</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Newsreader:opsz,wght@6..72,500;6..72,600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface">
    <div class="min-h-screen">
        {{-- Header --}}
        <header class="bg-surface-container-lowest border-b border-outline-variant">
            <div class="max-w-container mx-auto px-6 py-8">
                <h1 class="font-display text-display-xl text-on-surface">
                    Modern Design System
                </h1>
                <p class="font-body text-body-lg text-on-surface-variant mt-4">
                    Testing the new Literary Modernist theme
                </p>
            </div>
        </header>

        {{-- Main Content --}}
        <main class="max-w-container mx-auto px-6 py-section-gap">
            {{-- Typography Section --}}
            <section class="mb-section-gap">
                <h2 class="font-display text-headline-lg text-on-surface mb-8">Typography</h2>
                
                <div class="space-y-6 bg-surface-container-lowest p-8 rounded-lg">
                    <div>
                        <p class="font-body text-label-sm text-on-surface-variant mb-2">Display XL (Newsreader)</p>
                        <h1 class="font-display text-display-xl text-on-surface">The Art of Writing</h1>
                    </div>
                    
                    <div>
                        <p class="font-body text-label-sm text-on-surface-variant mb-2">Headline Large (Newsreader)</p>
                        <h2 class="font-display text-headline-lg text-on-surface">Modern Typography</h2>
                    </div>
                    
                    <div>
                        <p class="font-body text-label-sm text-on-surface-variant mb-2">Headline Medium (Newsreader)</p>
                        <h3 class="font-display text-headline-md text-on-surface">Editorial Design</h3>
                    </div>
                    
                    <div>
                        <p class="font-body text-label-sm text-on-surface-variant mb-2">Body Large (Inter)</p>
                        <p class="font-body text-body-lg text-on-surface">
                            This is body text in large size. Perfect for introductions and important paragraphs that need emphasis.
                        </p>
                    </div>
                    
                    <div>
                        <p class="font-body text-label-sm text-on-surface-variant mb-2">Body Medium (Inter)</p>
                        <p class="font-body text-body-md text-on-surface">
                            This is the standard body text. It's optimized for readability with proper line height and spacing.
                        </p>
                    </div>
                </div>
            </section>

            {{-- Colors Section --}}
            <section class="mb-section-gap">
                <h2 class="font-display text-headline-lg text-on-surface mb-8">Color Palette</h2>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    {{-- Primary --}}
                    <div class="space-y-2">
                        <div class="h-24 bg-primary rounded-lg"></div>
                        <p class="font-body text-body-md text-on-surface">Primary</p>
                        <p class="font-body text-label-sm text-on-surface-variant">#000000</p>
                    </div>
                    
                    {{-- Secondary --}}
                    <div class="space-y-2">
                        <div class="h-24 bg-secondary rounded-lg"></div>
                        <p class="font-body text-body-md text-on-surface">Secondary</p>
                        <p class="font-body text-label-sm text-on-surface-variant">#316763</p>
                    </div>
                    
                    {{-- Surface --}}
                    <div class="space-y-2">
                        <div class="h-24 bg-surface border border-outline-variant rounded-lg"></div>
                        <p class="font-body text-body-md text-on-surface">Surface</p>
                        <p class="font-body text-label-sm text-on-surface-variant">#fcf8fa</p>
                    </div>
                    
                    {{-- Error --}}
                    <div class="space-y-2">
                        <div class="h-24 bg-error rounded-lg"></div>
                        <p class="font-body text-body-md text-on-surface">Error</p>
                        <p class="font-body text-label-sm text-on-surface-variant">#ba1a1a</p>
                    </div>
                </div>
            </section>

            {{-- Components Section --}}
            <section class="mb-section-gap">
                <h2 class="font-display text-headline-lg text-on-surface mb-8">Components</h2>
                
                {{-- Buttons --}}
                <div class="mb-8">
                    <h3 class="font-display text-headline-md text-on-surface mb-4">Buttons</h3>
                    <div class="flex flex-wrap gap-4">
                        <button class="px-6 py-3 bg-primary text-on-primary font-body text-body-md rounded-lg hover:bg-primary/90 transition-colors">
                            Primary Button
                        </button>
                        <button class="px-6 py-3 bg-secondary text-on-secondary font-body text-body-md rounded-lg hover:bg-secondary/90 transition-colors">
                            Secondary Button
                        </button>
                        <button class="px-6 py-3 bg-surface-container text-on-surface font-body text-body-md rounded-lg border border-outline-variant hover:bg-surface-container-high transition-colors">
                            Outlined Button
                        </button>
                    </div>
                </div>

                {{-- Cards --}}
                <div class="mb-8">
                    <h3 class="font-display text-headline-md text-on-surface mb-4">Cards</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <x-modern-card 
                            title="Modern Architecture" 
                            description="Exploring the intersection of form and function in contemporary design. A deep dive into minimalist principles."
                        >
                            <x-slot:footer>
                                <div class="flex items-center justify-between">
                                    <span class="font-body text-label-sm text-on-surface-variant">5 min read</span>
                                    <span class="font-body text-label-sm text-secondary">Design</span>
                                </div>
                            </x-slot:footer>
                        </x-modern-card>

                        <x-modern-card 
                            title="Typography Matters" 
                            description="Why choosing the right typeface can make or break your editorial design. Learn the fundamentals."
                        >
                            <x-slot:footer>
                                <div class="flex items-center justify-between">
                                    <span class="font-body text-label-sm text-on-surface-variant">8 min read</span>
                                    <span class="font-body text-label-sm text-secondary">Typography</span>
                                </div>
                            </x-slot:footer>
                        </x-modern-card>

                        <x-modern-card 
                            title="Minimalist Approach" 
                            description="Less is more. Discover how minimalism creates powerful and memorable user experiences."
                        >
                            <x-slot:footer>
                                <div class="flex items-center justify-between">
                                    <span class="font-body text-label-sm text-on-surface-variant">6 min read</span>
                                    <span class="font-body text-label-sm text-secondary">UX</span>
                                </div>
                            </x-slot:footer>
                        </x-modern-card>
                    </div>
                </div>

                {{-- Form Elements --}}
                <div class="mb-8">
                    <h3 class="font-display text-headline-md text-on-surface mb-4">Form Elements</h3>
                    <div class="max-w-2xl space-y-4 bg-surface-container-lowest p-8 rounded-lg">
                        <div>
                            <label class="font-body text-body-md text-on-surface mb-2 block">Input Field</label>
                            <input type="text" placeholder="Enter text..." 
                                class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg text-on-surface focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none transition-all">
                        </div>
                        
                        <div>
                            <label class="font-body text-body-md text-on-surface mb-2 block">Textarea</label>
                            <textarea rows="4" placeholder="Enter your message..." 
                                class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg text-on-surface focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none transition-all"></textarea>
                        </div>
                        
                        <div>
                            <label class="font-body text-body-md text-on-surface mb-2 block">Select</label>
                            <select class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg text-on-surface focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none transition-all">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Reading Width Demo --}}
            <section class="mb-section-gap">
                <h2 class="font-display text-headline-lg text-on-surface mb-8">Reading Width (720px)</h2>
                
                <article class="max-w-reading mx-auto bg-surface-container-lowest p-12 rounded-lg">
                    <h1 class="font-display text-headline-lg text-on-surface mb-6">
                        The Importance of Line Length
                    </h1>
                    
                    <p class="font-body text-body-lg text-on-surface mb-4">
                        The optimal line length for body text is generally considered to be between 50-75 characters per line. 
                        This reading width constraint ensures comfortable reading without eye strain.
                    </p>
                    
                    <p class="font-body text-body-md text-on-surface-variant mb-4">
                        When lines are too long, readers have difficulty tracking from the end of one line to the beginning 
                        of the next. When lines are too short, the eye must move too frequently, breaking the reader's rhythm.
                    </p>
                    
                    <p class="font-body text-body-md text-on-surface-variant">
                        This container is constrained to 720px (max-w-reading), which provides an optimal reading experience 
                        for long-form content. Notice how comfortable it is to read this text compared to full-width paragraphs.
                    </p>
                </article>
            </section>
        </main>

        {{-- Footer --}}
        <footer class="bg-surface-container-lowest border-t border-outline-variant mt-section-gap">
            <div class="max-w-container mx-auto px-6 py-12 text-center">
                <p class="font-body text-body-md text-on-surface-variant">
                    Modern Design System Demo • Literary Modernist Theme
                </p>
            </div>
        </footer>
    </div>
</body>
</html>

{{-- Modern Header Navigation --}}
<header class="bg-surface-container-lowest border-b border-outline-variant sticky top-0 z-50 backdrop-blur-sm bg-surface/95">
    <nav class="max-w-container mx-auto px-6">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('blogs.index') }}" class="flex items-center space-x-2">
                    <span class="font-display text-2xl font-semibold text-primary">.Blog</span>
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('blogs.index') }}" 
                   class="font-body text-body-md text-on-surface hover:text-primary transition-colors {{ request()->routeIs('blogs.index') ? 'text-primary font-semibold' : '' }}">
                    Home
                </a>
                
                @auth
                    <a href="{{ route('userposts.index') }}" 
                       class="font-body text-body-md text-on-surface hover:text-primary transition-colors {{ request()->routeIs('userposts.*') ? 'text-primary font-semibold' : '' }}">
                        My Posts
                    </a>
                    
                    <a href="{{ route('userposts.create') }}" 
                       class="font-body text-body-md text-on-surface hover:text-primary transition-colors">
                        Write
                    </a>
                @endauth

                <a href="{{ route('search.index') }}" 
                   class="font-body text-body-md text-on-surface hover:text-primary transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </a>
            </div>

            {{-- User Menu --}}
            <div class="flex items-center space-x-4">
                @auth
                    {{-- User Dropdown --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-surface-container transition-colors">
                            <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" 
                                 alt="{{ Auth::user()->name }}"
                                 class="w-8 h-8 rounded-full ring-2 ring-outline-variant">
                            <span class="font-body text-body-md text-on-surface hidden md:block">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-on-surface-variant" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-surface-container-lowest rounded-lg shadow-lg border border-outline-variant py-2"
                             style="display: none;">
                            
                            <a href="{{ route('userprofile.index') }}" 
                               class="block px-4 py-2 font-body text-body-md text-on-surface hover:bg-surface-container transition-colors">
                                Profile
                            </a>
                            
                            <a href="{{ route('userposts.index') }}" 
                               class="block px-4 py-2 font-body text-body-md text-on-surface hover:bg-surface-container transition-colors">
                                My Posts
                            </a>

                            @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="block px-4 py-2 font-body text-body-md text-secondary hover:bg-surface-container transition-colors">
                                    Admin Dashboard
                                </a>
                            @endif

                            <div class="border-t border-outline-variant my-2"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="block w-full text-left px-4 py-2 font-body text-body-md text-error hover:bg-error-container transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Login/Register Buttons --}}
                    <a href="{{ route('login') }}" 
                       class="font-body text-body-md text-on-surface hover:text-primary transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" 
                       class="px-4 py-2 bg-primary text-on-primary font-body text-body-md rounded-lg hover:bg-primary/90 transition-colors">
                        Sign Up
                    </a>
                @endauth

                {{-- Mobile Menu Button --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="md:hidden p-2 rounded-lg hover:bg-surface-container transition-colors"
                        x-data="{ mobileMenuOpen: false }">
                    <svg class="w-6 h-6 text-on-surface" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenuOpen" 
             x-data="{ mobileMenuOpen: false }"
             @click.away="mobileMenuOpen = false"
             class="md:hidden border-t border-outline-variant py-4"
             style="display: none;">
            <div class="space-y-2">
                <a href="{{ route('blogs.index') }}" 
                   class="block px-4 py-2 font-body text-body-md text-on-surface hover:bg-surface-container rounded-lg transition-colors">
                    Home
                </a>
                
                @auth
                    <a href="{{ route('userposts.index') }}" 
                       class="block px-4 py-2 font-body text-body-md text-on-surface hover:bg-surface-container rounded-lg transition-colors">
                        My Posts
                    </a>
                    
                    <a href="{{ route('userposts.create') }}" 
                       class="block px-4 py-2 font-body text-body-md text-on-surface hover:bg-surface-container rounded-lg transition-colors">
                        Write
                    </a>
                @endauth

                <a href="{{ route('search.index') }}" 
                   class="block px-4 py-2 font-body text-body-md text-on-surface hover:bg-surface-container rounded-lg transition-colors">
                    Search
                </a>
            </div>
        </div>
    </nav>
</header>

{{-- Alpine.js for dropdowns (if not already included) --}}
@once
    @push('scripts')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
@endonce

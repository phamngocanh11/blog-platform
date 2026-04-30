<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - .Blog</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Newsreader:opsz,wght@6..72,500;6..72,600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('blogs.index') }}" class="inline-block">
                <h1 class="font-display text-4xl font-semibold text-primary">.Blog</h1>
            </a>
            <p class="font-body text-body-md text-on-surface-variant mt-2">
                Create your account and start writing
            </p>
        </div>

        {{-- Register Card --}}
        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-8 shadow-lg">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block font-body text-body-md text-on-surface mb-2">
                        Full Name
                    </label>
                    <input id="name" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}"
                           required 
                           autofocus 
                           autocomplete="name"
                           class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg text-on-surface font-body text-body-md focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none transition-all placeholder:text-on-surface-variant"
                           placeholder="John Doe">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Email Address --}}
                <div>
                    <label for="email" class="block font-body text-body-md text-on-surface mb-2">
                        Email Address
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           required 
                           autocomplete="username"
                           class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg text-on-surface font-body text-body-md focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none transition-all placeholder:text-on-surface-variant"
                           placeholder="your@email.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block font-body text-body-md text-on-surface mb-2">
                        Password
                    </label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="new-password"
                           class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg text-on-surface font-body text-body-md focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none transition-all placeholder:text-on-surface-variant"
                           placeholder="Create a strong password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <p class="mt-1 font-body text-xs text-on-surface-variant">
                        Must be at least 8 characters
                    </p>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block font-body text-body-md text-on-surface mb-2">
                        Confirm Password
                    </label>
                    <input id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg text-on-surface font-body text-body-md focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none transition-all placeholder:text-on-surface-variant"
                           placeholder="Confirm your password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                {{-- Terms & Conditions --}}
                <div class="flex items-start">
                    <input id="terms" 
                           type="checkbox" 
                           required
                           class="w-4 h-4 mt-1 text-secondary bg-surface border-outline-variant rounded focus:ring-secondary focus:ring-2 cursor-pointer">
                    <label for="terms" class="ml-2 font-body text-sm text-on-surface-variant cursor-pointer">
                        I agree to the 
                        <a href="#" class="text-secondary hover:text-primary transition-colors">Terms of Service</a> 
                        and 
                        <a href="#" class="text-secondary hover:text-primary transition-colors">Privacy Policy</a>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" 
                        class="w-full px-6 py-3 bg-primary text-on-primary font-body text-body-md font-semibold rounded-lg hover:bg-primary/90 transition-all shadow-sm hover:shadow-md">
                    Create Account
                </button>

                {{-- Divider --}}
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline-variant"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-surface-container-lowest font-body text-body-md text-on-surface-variant">
                            Or sign up with
                        </span>
                    </div>
                </div>

                {{-- Social Sign Up (Optional) --}}
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" 
                            class="flex items-center justify-center px-4 py-3 bg-surface border border-outline-variant rounded-lg font-body text-body-md text-on-surface hover:bg-surface-container transition-all">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Google
                    </button>
                    
                    <button type="button" 
                            class="flex items-center justify-center px-4 py-3 bg-surface border border-outline-variant rounded-lg font-body text-body-md text-on-surface hover:bg-surface-container transition-all">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                        GitHub
                    </button>
                </div>
            </form>
        </div>

        {{-- Sign In Link --}}
        <p class="text-center mt-6 font-body text-body-md text-on-surface-variant">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-secondary hover:text-primary font-semibold transition-colors">
                Sign In
            </a>
        </p>

        {{-- Back to Home --}}
        <div class="text-center mt-4">
            <a href="{{ route('blogs.index') }}" 
               class="inline-flex items-center font-body text-body-md text-on-surface-variant hover:text-primary transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Home
            </a>
        </div>
    </div>
</body>
</html>

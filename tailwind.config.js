import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            // Font Families - Modern Design System
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans], // Keep original
                display: ['Newsreader', 'serif'], // For headlines and titles
                body: ['Inter', 'sans-serif'], // For body text and UI
            },

            // Color Palette - Literary Modernist Theme
            colors: {
                // Surface Colors
                'surface': '#fcf8fa',
                'surface-dim': '#dcd9db',
                'surface-bright': '#fcf8fa',
                'surface-container-lowest': '#ffffff',
                'surface-container-low': '#f6f3f5',
                'surface-container': '#f0edef',
                'surface-container-high': '#eae7e9',
                'surface-container-highest': '#e4e2e4',
                'surface-variant': '#e4e2e4',
                
                // On-Surface Colors
                'on-surface': '#1b1b1d',
                'on-surface-variant': '#45464d',
                'on-background': '#1b1b1d',
                
                // Primary Colors
                'primary': '#000000',
                'on-primary': '#ffffff',
                'primary-container': '#131b2e',
                'on-primary-container': '#7c839b',
                'primary-fixed': '#dae2fd',
                'primary-fixed-dim': '#bec6e0',
                'on-primary-fixed': '#131b2e',
                'on-primary-fixed-variant': '#3f465c',
                
                // Secondary Colors
                'secondary': '#316763',
                'on-secondary': '#ffffff',
                'secondary-container': '#b5ede7',
                'on-secondary-container': '#376d69',
                'secondary-fixed': '#b5ede7',
                'secondary-fixed-dim': '#9ad1cb',
                'on-secondary-fixed': '#00201e',
                'on-secondary-fixed-variant': '#144f4b',
                
                // Tertiary Colors
                'tertiary': '#000000',
                'on-tertiary': '#ffffff',
                'tertiary-container': '#271901',
                'on-tertiary-container': '#98805d',
                'tertiary-fixed': '#fcdeb5',
                'tertiary-fixed-dim': '#dec29a',
                'on-tertiary-fixed': '#271901',
                'on-tertiary-fixed-variant': '#574425',
                
                // Inverse Colors
                'inverse-surface': '#303032',
                'inverse-on-surface': '#f3f0f2',
                'inverse-primary': '#bec6e0',
                
                // Outline Colors
                'outline': '#76777d',
                'outline-variant': '#c6c6cd',
                
                // Error Colors
                'error': '#ba1a1a',
                'on-error': '#ffffff',
                'error-container': '#ffdad6',
                'on-error-container': '#93000a',
                
                // Background
                'background': '#fcf8fa',
                
                // Surface Tint
                'surface-tint': '#565e74',
            },

            // Border Radius
            borderRadius: {
                'sm': '0.25rem',    // 4px
                'DEFAULT': '0.5rem', // 8px
                'md': '0.75rem',     // 12px
                'lg': '1rem',        // 16px
                'xl': '1.5rem',      // 24px
                'full': '9999px',
            },

            // Spacing - Design System
            spacing: {
                'gutter': '24px',
                'section-gap': '80px',
            },

            // Max Width
            maxWidth: {
                'reading': '720px',  // Optimal reading width
                'container': '1280px',
            },

            // Font Sizes - Typography Scale
            fontSize: {
                'display-xl': ['64px', { lineHeight: '1.1', letterSpacing: '-0.02em', fontWeight: '600' }],
                'headline-lg': ['40px', { lineHeight: '1.2', fontWeight: '500' }],
                'headline-md': ['32px', { lineHeight: '1.3', fontWeight: '500' }],
                'body-lg': ['18px', { lineHeight: '1.7', fontWeight: '400' }],
                'body-md': ['16px', { lineHeight: '1.6', fontWeight: '400' }],
                'label-sm': ['14px', { lineHeight: '1.2', letterSpacing: '0.05em', fontWeight: '600' }],
            },
        },
    },

    plugins: [forms],
};

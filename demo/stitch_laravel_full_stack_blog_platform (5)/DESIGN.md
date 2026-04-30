---
name: Literary Modernist
colors:
  surface: '#fcf8fa'
  surface-dim: '#dcd9db'
  surface-bright: '#fcf8fa'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f6f3f5'
  surface-container: '#f0edef'
  surface-container-high: '#eae7e9'
  surface-container-highest: '#e4e2e4'
  on-surface: '#1b1b1d'
  on-surface-variant: '#45464d'
  inverse-surface: '#303032'
  inverse-on-surface: '#f3f0f2'
  outline: '#76777d'
  outline-variant: '#c6c6cd'
  surface-tint: '#565e74'
  primary: '#000000'
  on-primary: '#ffffff'
  primary-container: '#131b2e'
  on-primary-container: '#7c839b'
  inverse-primary: '#bec6e0'
  secondary: '#316763'
  on-secondary: '#ffffff'
  secondary-container: '#b5ede7'
  on-secondary-container: '#376d69'
  tertiary: '#000000'
  on-tertiary: '#ffffff'
  tertiary-container: '#271901'
  on-tertiary-container: '#98805d'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#dae2fd'
  primary-fixed-dim: '#bec6e0'
  on-primary-fixed: '#131b2e'
  on-primary-fixed-variant: '#3f465c'
  secondary-fixed: '#b5ede7'
  secondary-fixed-dim: '#9ad1cb'
  on-secondary-fixed: '#00201e'
  on-secondary-fixed-variant: '#144f4b'
  tertiary-fixed: '#fcdeb5'
  tertiary-fixed-dim: '#dec29a'
  on-tertiary-fixed: '#271901'
  on-tertiary-fixed-variant: '#574425'
  background: '#fcf8fa'
  on-background: '#1b1b1d'
  surface-variant: '#e4e2e4'
typography:
  display-xl:
    fontFamily: Newsreader
    fontSize: 64px
    fontWeight: '600'
    lineHeight: '1.1'
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Newsreader
    fontSize: 40px
    fontWeight: '500'
    lineHeight: '1.2'
  headline-md:
    fontFamily: Newsreader
    fontSize: 32px
    fontWeight: '500'
    lineHeight: '1.3'
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.7'
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  label-sm:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '600'
    lineHeight: '1.2'
    letterSpacing: 0.05em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base-unit: 8px
  container-max: 1280px
  reading-width: 720px
  gutter: 24px
  section-gap: 80px
---

## Brand & Style

The brand personality of the design system is intellectual, serene, and authoritative. It is designed for a blog platform that treats long-form content as an art form, catering to writers, journalists, and avid readers who value deep focus over algorithmic noise. 

The design style follows a **Minimalist-Modern** approach with an editorial tilt. It prioritizes the "quiet" moments of reading by utilizing vast amounts of white space and high-contrast typography. The emotional response should be one of sophisticated calm—moving away from the frantic energy of social media toward a structured, digital library aesthetic.

## Colors

The palette is anchored by "Midnight Slate" (Primary) and "Deep Forest Teal" (Secondary) to establish a professional, grounded atmosphere. To ensure reading comfort, the system avoids pure white backgrounds, opting instead for a soft "Paper Gray" (#F8FAFC) that reduces eye strain during long sessions.

The accent color, "Electric Coral," is reserved strictly for high-priority calls to action, active states, and critical highlights. This vibrant pop breaks the monochromatic seriousness of the primary palette, guiding the user's eye to conversion points without disrupting the literary flow.

## Typography

The typography system is the backbone of the identity. **Newsreader** is utilized for headlines to provide a classic, editorial feel that evokes the prestige of traditional print journalism. It should be typeset with generous leading to allow the letterforms to breathe.

For body copy and UI interactions, **Inter** provides a neutral, highly legible contrast. Body text should maintain a line height of 1.7x to optimize the reading experience. Labels and metadata (categories, dates, author names) use Inter in all-caps with increased letter spacing to create a clear visual distinction from the narrative text.

## Layout & Spacing

The design system employs a **Fixed Grid** model for desktop, centered on a 12-column structure. However, the internal reading experience is governed by a strict "Reading Width" constraint of 720px to maintain optimal line lengths (50-75 characters).

The spacing rhythm is expansive. Sections are separated by large gaps (80px+) to prevent the layout from feeling cluttered. Margins around content should be generous, treating the digital screen like a printed page where the "margins" are just as important as the text.

## Elevation & Depth

Visual hierarchy is achieved through **Tonal Layers** and **Ambient Shadows**. Instead of heavy shadows, the system uses "Tinted Air Shadows"—extremely diffused, low-opacity shadows (2-4% opacity) that take on a slight hint of the primary teal color.

Surfaces do not "float" high above the background; they sit just a millimeter above it. This creates a subtle sense of tactility without breaking the clean, flat aesthetic. Navigation sidebars and sticky headers should use a backdrop-blur effect (glassmorphism) when overlapping content to maintain a sense of context.

## Shapes

The design system uses a **Rounded** shape language. A base radius of 8px (0.5rem) is applied to standard UI elements like inputs and buttons, while larger containers like article cards and the editor interface use 12px-16px. This softening of the edges balances the "sharpness" of the serif typography, making the professional environment feel accessible and modern rather than cold or archaic.

## Components

### Cards
Article cards feature a "Lift" hover effect where the shadow deepens slightly and the image undergoes a subtle scale-up (1.02x). Borders should be a hairline 1px in a light gray-blue, disappearing on hover in favor of the shadow.

### Inputs & Editor
The text editor is "Chrome-less," meaning borders only appear on focus. This mimics a blank sheet of paper. For standard form inputs (comments, settings), use a soft-gray background with a 1px inset border that transitions to the primary teal on focus.

### Navigation Sidebar
The sidebar is semi-transparent with a subtle vertical divider. Navigation links use the label-sm typography style. Active states are indicated by a small "Electric Coral" vertical pill to the left of the menu item.

### Buttons
Primary buttons are solid "Midnight Slate" with white text. Secondary buttons are outlined with "Deep Forest Teal." The accent color is used exclusively for the "Publish" or "Subscribe" actions to denote high-value intent.
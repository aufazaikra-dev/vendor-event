<svg viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
  <defs>
    <linearGradient id="ev-gold-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#FDE047" />
      <stop offset="50%" stop-color="#C5A028" />
      <stop offset="100%" stop-color="#854D0E" />
    </linearGradient>
    <filter id="ev-glow" x="-20%" y="-20%" width="140%" height="140%">
      <feGaussianBlur stdDeviation="2.5" result="blur"/>
      <feComposite in="SourceGraphic" in2="blur" operator="over"/>
    </filter>
  </defs>
  
  <g filter="url(#ev-glow)">
      <!-- Outer elegant rings -->
      <circle cx="60" cy="60" r="52" fill="none" stroke="url(#ev-gold-gradient)" stroke-width="1.5" opacity="0.9" />
      <circle cx="60" cy="60" r="46" fill="none" stroke="url(#ev-gold-gradient)" stroke-width="0.75" opacity="0.6" stroke-dasharray="4 4"/>
      
      <!-- Elegant E -->
      <path d="M 40 45 L 40 75 M 40 45 L 54 45 M 40 60 L 50 60 M 40 75 L 54 75" fill="none" stroke="url(#ev-gold-gradient)" stroke-width="5" stroke-linecap="butt" />
      
      <!-- Elegant V -->
      <path d="M 64 45 L 73 75 L 82 45" fill="none" stroke="url(#ev-gold-gradient)" stroke-width="5" stroke-linecap="butt" stroke-linejoin="miter" />
      
      <!-- Small decorative diamond at the bottom -->
      <polygon points="60,82 62,85 60,88 58,85" fill="url(#ev-gold-gradient)" />
  </g>
</svg>

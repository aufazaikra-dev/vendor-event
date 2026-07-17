@if ($paginator->hasPages())
<nav style="display:flex; flex-direction:column; align-items:center; gap:10px; margin-top:4px;">

    {{-- Info --}}
    <p style="font-size:12px; color:#9a9ab0; margin:0;">
        Menampilkan <strong style="color:#1a1a2e;">{{ $paginator->firstItem() }}</strong>–<strong style="color:#1a1a2e;">{{ $paginator->lastItem() }}</strong>
        dari <strong style="color:#B8860B;">{{ $paginator->total() }}</strong> data
    </p>

    {{-- Buttons --}}
    <div style="display:flex; align-items:center; gap:6px; flex-wrap:wrap; justify-content:center;">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span style="padding:7px 16px; border-radius:8px; background:#f4f6f8; color:#c4c9d4; font-size:13px; font-weight:600; cursor:not-allowed; border:1px solid #e8eaed; user-select:none;">
                ‹ Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               style="padding:7px 16px; border-radius:8px; background:#fff; border:1px solid rgba(184,134,11,0.25); color:#B8860B; font-size:13px; font-weight:600; text-decoration:none; transition:all 0.2s;"
               onmouseover="this.style.background='rgba(184,134,11,0.1)'; this.style.borderColor='#B8860B';"
               onmouseout="this.style.background='#fff'; this.style.borderColor='rgba(184,134,11,0.25)';">
                ‹ Prev
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="padding:7px 4px; color:#9a9ab0; font-size:13px; font-weight:600;">…</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="padding:7px 13px; border-radius:8px; background:linear-gradient(135deg,#B8860B,#D4A017); color:#fff; font-size:13px; font-weight:700; min-width:36px; text-align:center; box-shadow:0 2px 8px rgba(184,134,11,0.3); border:1px solid transparent;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           style="padding:7px 13px; border-radius:8px; background:#fff; border:1px solid rgba(184,134,11,0.2); color:#4a4a6a; font-size:13px; font-weight:600; text-decoration:none; min-width:36px; text-align:center; display:inline-block; transition:all 0.2s;"
                           onmouseover="this.style.background='rgba(184,134,11,0.08)'; this.style.color='#B8860B'; this.style.borderColor='rgba(184,134,11,0.4)';"
                           onmouseout="this.style.background='#fff'; this.style.color='#4a4a6a'; this.style.borderColor='rgba(184,134,11,0.2)';">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               style="padding:7px 16px; border-radius:8px; background:#fff; border:1px solid rgba(184,134,11,0.25); color:#B8860B; font-size:13px; font-weight:600; text-decoration:none; transition:all 0.2s;"
               onmouseover="this.style.background='rgba(184,134,11,0.1)'; this.style.borderColor='#B8860B';"
               onmouseout="this.style.background='#fff'; this.style.borderColor='rgba(184,134,11,0.25)';">
                Next ›
            </a>
        @else
            <span style="padding:7px 16px; border-radius:8px; background:#f4f6f8; color:#c4c9d4; font-size:13px; font-weight:600; cursor:not-allowed; border:1px solid #e8eaed; user-select:none;">
                Next ›
            </span>
        @endif

    </div>
</nav>
@endif

@if ($paginator->hasPages())
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div style="font-size:12px;color:var(--md-sys-color-on-surface-variant);">
            Menampilkan
            <span style="font-weight:600;color:var(--md-sys-color-on-surface);">{{ $paginator->firstItem() }}</span>
            sampai
            <span style="font-weight:600;color:var(--md-sys-color-on-surface);">{{ $paginator->lastItem() }}</span>
            dari
            <span style="font-weight:600;color:var(--md-sys-color-on-surface);">{{ $paginator->total() }}</span>
        </div>

        <div class="d-flex gap-1 align-items-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:var(--md-sys-color-surface-container-low);border:1px solid var(--md-sys-color-outline-variant);opacity:0.4;cursor:default;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:var(--md-sys-color-surface-container-low);border:1px solid var(--md-sys-color-outline-variant);color:var(--md-sys-color-on-surface-variant);text-decoration:none;transition:all 0.2s ease;" onmouseover="this.style.borderColor='var(--md-sys-color-primary)';this.style.color='var(--md-sys-color-primary)'" onmouseout="this.style.borderColor='var(--md-sys-color-outline-variant)';this.style.color='var(--md-sys-color-on-surface-variant)'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;background:var(--md-sys-color-primary);color:white;border:1px solid var(--md-sys-color-primary);">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:500;color:var(--md-sys-color-on-surface-variant);background:var(--md-sys-color-surface-container-low);border:1px solid var(--md-sys-color-outline-variant);text-decoration:none;transition:all 0.2s ease;" onmouseover="this.style.borderColor='var(--md-sys-color-primary)';this.style.color='var(--md-sys-color-primary)'" onmouseout="this.style.borderColor='var(--md-sys-color-outline-variant)';this.style.color='var(--md-sys-color-on-surface-variant)'">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:var(--md-sys-color-surface-container-low);border:1px solid var(--md-sys-color-outline-variant);color:var(--md-sys-color-on-surface-variant);text-decoration:none;transition:all 0.2s ease;" onmouseover="this.style.borderColor='var(--md-sys-color-primary)';this.style.color='var(--md-sys-color-primary)'" onmouseout="this.style.borderColor='var(--md-sys-color-outline-variant)';this.style.color='var(--md-sys-color-on-surface-variant)'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            @else
                <span style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:var(--md-sys-color-surface-container-low);border:1px solid var(--md-sys-color-outline-variant);opacity:0.4;cursor:default;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </span>
            @endif
        </div>
    </div>
@endif

@if ($posts->lastPage() > 1)
    <ul class="pagination">
        @if ($posts->onFirstPage())
            <li class="paginate_button page-item previous disabled" id="basic-datatables_previous">
                <span class="page-link">{{ __('Previous') }}</span>
            </li>
        @else
            <li class="paginate_button page-item previous" id="basic-datatables_previous">
                <a href="{{ $posts->previousPageUrl() }}" class="page-link" aria-controls="basic-datatables" tabindex="0">{{ __('Previous') }}</a>
            </li>
        @endif

        @for ($i = 1; $i <= $posts->lastPage(); $i++)
            <li class="paginate_button page-item {{ $posts->currentPage() == $i ? 'active' : '' }}">
                <a href="{{ $posts->url($i) }}" class="page-link" aria-controls="basic-datatables" tabindex="0">{{ $i }}</a>
            </li>
        @endfor

        @if ($posts->hasMorePages())
            <li class="paginate_button page-item next" id="basic-datatables_next">
                <a href="{{ $posts->nextPageUrl() }}" class="page-link" aria-controls="basic-datatables" tabindex="0">{{ __('Next') }}</a>
            </li>
        @else
            <li class="paginate_button page-item next disabled" id="basic-datatables_next">
                <span class="page-link">{{ __('Next') }}</span>
            </li>
        @endif
    </ul>
@endif

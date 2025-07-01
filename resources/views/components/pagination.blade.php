@props(['paginator'])

@if ($paginator->hasPages())
    <nav class="mt-4 d-flex justify-content-center">
        <ul class="pagination pagination-sm mb-0 gap-2">
            {{-- Previous Page Link --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $paginator->onFirstPage() ? 'true' : 'false' }}">
                    &laquo; Prev
                </a>
            </li>

            {{-- Page Numbers --}}
            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                <li class="page-item {{ $paginator->currentPage() === $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Next Page Link --}}
            <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    Next &raquo;
                </a>
            </li>
        </ul>
    </nav>
@endif

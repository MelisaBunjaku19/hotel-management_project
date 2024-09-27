@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link pagination-button" aria-hidden="true">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link pagination-button" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link pagination-button" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link pagination-button" aria-hidden="true">Next</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>

.pagination-button {
    display: inline-block;
    padding: 10px 20px; /* Increase padding for larger buttons */
    margin: 0 5px; /* Add some space between buttons */
    font-size: 16px; /* Increase font size */
    font-weight: bold; /* Make the text bold */
    color: #fff; /* Text color */
    background-color: #007bff; /* Primary color */
    border: none; /* Remove border */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s, transform 0.2s; /* Smooth transitions */
}

.pagination-button:hover {
    background-color: #0056b3; /* Darker shade on hover */
    transform: translateY(-2px); /* Slight lift effect */
}

.pagination-button:disabled {
    background-color: #6c757d; /* Grey background for disabled state */
    color: #fff; /* White text for disabled */
    cursor: not-allowed; /* Change cursor to indicate disabled state */
}

.pagination {
    margin-top: 20px; /* Space above pagination */
}

</style>
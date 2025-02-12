<div class="edit-delete-action">
@if (!empty($showViewButton))
    <a class="me-2 edit-icon p-2" href="{{ route('dashboard.' . $entity->blob . '.show', $entity) }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-eye action-eye">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>
        </svg>
    </a>
@endif

@if (!empty($showEditButton))
    <a class="me-2  p-2" href="{{ route('dashboard.' . $entity->blob . '.edit', $entity) }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
    </a>
@endif


@if (!empty($showDeleteButton))
    <a class="confirm-text p-2" href="{{ route('dashboard.' . $entity->blob . '.delete', $entity) }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
    </a>
@endif


@foreach ($otherUrls ?? [] as $otherUrl)
            <a class="dropdown-item me-1 {{ isset($otherUrl['color']) ?$otherUrl['color'] : '' }}" href="{{ $otherUrl['url'] }}">
                {{-- <i class='{{ $otherUrl['icon'] }}'></i> --}}
                @langucw($otherUrl['title'])
            </a>
        @endforeach
</div>





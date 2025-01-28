

<div class="d-flex flex-row justify-content-between profile gap-2">
    <div class="d-flex flex-row w-50 align-items-center p-5  card-counter copy-to-clipboard" data-clipboard-text="{{ getLogged()->getReferralUrl() }}">
        <h3 class="mx-4">@langucw('copy referral link')</h3>
    </div>
    <div class="d-flex flex-row  w-50 align-items-center p-5  card-counter">
        <div class="counter">{{ getLogged()->usersIReferred()->count() }}</div>
        <h3 class="mx-4">@langucw('referrals count')</h3>
    </div>
</div>

<br>








@push('scripts')
    <script>
        var clipboard = new ClipboardJS('.copy-to-clipboard');
        clipboard.on('success', function(e) {
            e.clearSelection();
            toastr.success('{{ __('copied successfully') }}', '{{ __('copied') }}', {
                timeOut: 5000,
                "positionClass": "toast-bottom-right",

            })
        });

    </script>
@endpush

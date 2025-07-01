@if ($errors->any())
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <div id="errorToast" class="toast text-white bg-danger border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
@endif

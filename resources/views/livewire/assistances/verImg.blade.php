{{-- <div wire:ignore.self class="modal fade" id="theModal-img" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div>
            <div class="modal-body">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff">&times;</span>
                </button> --}}
                {{-- <img src="{{ asset('storage/assistances/' . $comprobante)}}"
                alt="Sin Comprobante" class="rounded">
            </div>
        </div>
    </div>
</div> --}}

<div wire:ignore.self class="modal fade" id="theModal-img" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" style="background: #414141">
                
            </div>
            <div class="modal-body">
                
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/assistances/' .$comprobante)}}"
                            alt="Sin Comprobante" class="d-block w-100">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
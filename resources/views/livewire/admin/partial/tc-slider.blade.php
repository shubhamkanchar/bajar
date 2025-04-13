<div class="slider-form {{$sliderStatus}}">
    <div class="slider-content">
        <div class="row">
            <div class="col-md-8">
                <p class="fw-bold fs-3">Update {{ $title }}</p>
            </div>
            <div class="col-md-4 text-md-end mb-2">
                <a class="btn btn-default rounded-5 bg-custom-secondary" role="button" wire:click="closeSlider">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <textarea class="form-control mt-3 mb-3" placeholder="{{ $title }}" rows="20" wire:model="description"></textarea>
                @error('description')
                {{$message}}
                @enderror
            </div>
            <div class="col-md-12 mt-4">
                <button class="btn btn-dark" wire:click="update">Update</button>
            </div>
        </div>
    </div>
</div>

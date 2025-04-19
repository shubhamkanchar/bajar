<div class="slider-form {{$sliderStatus}}">
    <div class="slider-content">
        <div class="row">
            <div class="col-12 text-md-end mb-2">
                <a class="btn btn-default rounded-5 bg-custom-secondary" role="button" wire:click="closeSlider">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
            <div class="col-md-12">
                <div class="dashed-border w-100 text-center " style="height: 50vh">
                    @if($banner)
                        <img src="{{$banner->temporaryUrl()}}" class="img-fluid" style="width: 100%;height: 100%;object-fit: cover;">
                        @error('banner')
                        {{$message}}
                        @enderror
                    @else
                        <span class="d-flex flex-column align-items-center justify-content-center text-center" style="height: 100%;">
                            <input type="file" wire:model="banner" id="blogImage" hidden="" accept="image/*">
                            <label for="blogImage" class="d-flex flex-column align-items-center justify-content-center" style="cursor: pointer; height: 100%;">
                                <i class="fa-regular fa-square-plus fs-1 text-secondary"></i>
                                <p class="mb-0">Add Ads Image</p>
                            </label>
                        </span>
                        @error('banner')
                        {{$message}}
                        @enderror
                    @endif
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                <button class="btn btn-dark" wire:click="publishAds">Add</button>
            </div>
        </div>
    </div>
</div>

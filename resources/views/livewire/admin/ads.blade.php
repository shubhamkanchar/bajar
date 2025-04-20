<div>
    <div class="row m-4">
        <div class="col-md-12 text-end">
            <button class="btn btn-dark m-3" wire:click="openSlider()">Add</button>
        </div>
        @foreach ($this->ads as $ad)
            <div class="col-md-3 position-relative my-2">
                <div class="ratio ratio-21x9">
                    <img class="w-100 object-fit-cover" src="{{ asset('storage/' . $ad->image) }}">
                </div>
                <a class="position-absolute top-0 end-0 pe-3 pt-1" style="z-index: 1"
                    wire:click="deleteAd('{{ $ad->id }}')"
                    wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect width="30" height="30" rx="15" transform="matrix(-1 0 0 1 30 0)"
                            fill="white" fill-opacity="0.6" />
                        <path
                            d="M20.4948 13.1016C20.4948 13.1016 20.0876 18.1528 19.8513 20.2806C19.7388 21.2968 19.1111 21.8923 18.0828 21.9111C16.1261 21.9463 14.1671 21.9486 12.2111 21.9073C11.2218 21.8871 10.6046 21.2841 10.4943 20.2858C10.2566 18.1393 9.85156 13.1016 9.85156 13.1016"
                            stroke="#EC1D25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M21.531 10.6797H8.8125" stroke="#EC1D25" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M19.0829 10.6793C18.4941 10.6793 17.9871 10.263 17.8716 9.68625L17.6894 8.77425C17.5769 8.3535 17.1959 8.0625 16.7616 8.0625H13.5869C13.1526 8.0625 12.7716 8.3535 12.6591 8.77425L12.4769 9.68625C12.3614 10.263 11.8544 10.6793 11.2656 10.6793"
                            stroke="#EC1D25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        @endforeach
    </div>
    @include('livewire.admin.partial.ads-slider')
</div>

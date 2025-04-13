<div>
    <div class="row m-4">
        <div class="col-md-12">
            <h5 class="fw-bold">Terms and Conditions</h5>
        </div>
        <div class="col-md-4">
            <div class="dashed-border" wire:click="openSlider('tc')">
                <div class="justify-content-center align-items-center d-flex p-5">
                    <i class="fa-regular fa-square-plus fs-1 pe-3 text-secondary openSlider" role="button"></i>
                    <span class="fs-6 fw-bold">Update<br> Terms and conditions</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-center">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="20" r="20" fill="#E8E8E8" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M22.7369 10.7578H16.0849C14.0049 10.7498 12.3009 12.4068 12.2509 14.4868V25.2238C12.2059 27.3258 13.8739 29.0658 15.9749 29.1108C16.0119 29.1108 16.0489 29.1118 16.0849 29.1108H24.0729C26.1629 29.0368 27.8149 27.3148 27.8029 25.2238V16.0338L22.7369 10.7578Z"
                    stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M22.4766 10.75V13.659C22.4766 15.079 23.6256 16.23 25.0456 16.234H27.7996" stroke="black"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M19.6406 23.9472V17.9062" stroke="black" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M17.2969 21.5938L19.6419 23.9488L21.9869 21.5938" stroke="black" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div>Last Updated</div>
            <div>{{ $tcDate?->format('d M Y'); }}</div>
        </div>
        <hr class="mt-4">
        <div class="col-md-12">
            <h5 class="fw-bold">Privacy Policy</h5>
        </div>
        <div class="col-md-4">
            <div class="dashed-border" wire:click="openSlider('pp')">
                <div class="justify-content-center align-items-center d-flex p-5">
                    <i class="fa-regular fa-square-plus fs-1 pe-3 text-secondary openSlider" role="button"></i>
                    <span class="fs-6 fw-bold">Update<br> Privacy Policy</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-center">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="20" r="20" fill="#E8E8E8" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M22.7369 10.7578H16.0849C14.0049 10.7498 12.3009 12.4068 12.2509 14.4868V25.2238C12.2059 27.3258 13.8739 29.0658 15.9749 29.1108C16.0119 29.1108 16.0489 29.1118 16.0849 29.1108H24.0729C26.1629 29.0368 27.8149 27.3148 27.8029 25.2238V16.0338L22.7369 10.7578Z"
                    stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M22.4766 10.75V13.659C22.4766 15.079 23.6256 16.23 25.0456 16.234H27.7996" stroke="black"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M19.6406 23.9472V17.9062" stroke="black" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M17.2969 21.5938L19.6419 23.9488L21.9869 21.5938" stroke="black" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div>Last Updated</div>
            <div>{{ $ppDate?->format('d M Y'); }}</div>
        </div>
    </div>
    @include('livewire.admin.partial.tc-slider')
</div>

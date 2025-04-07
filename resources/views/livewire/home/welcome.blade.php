<div>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 bg-secondary-subtle text-center rounded-4">
                <div class="pt-3">
                    I am looking for
                </div>
                <div class="d-flex justify-content-center mb-4">
                    <div class="mt-2 d-flex justify-content-between bg-white rounded-5 p-2 border"
                        style="width:fit-content">
                        <button type="button"
                            class="btn rounded-5 @if ($section == 'product') btn-dark @endif email-toggle-btn ps-4 pe-4 pt-2 pb-2"
                            data-item="email" wire:click="setSection('product')">Material</button>
                        <button type="button"
                            class="btn rounded-5 @if ($section == 'service') btn-dark @endif  email-toggle-btn pt-2 pb-2 ps-4 pe-4"
                            data-item="phone" wire:click="setSection('service')">Services</button>
                    </div>
                </div>
                <div class="d-md-flex justify-content-center mb-3">
                    <div class="mt-2 bg-white rounded-5 p-2 border me-2">
                        <input class="form-control rounded-5 mt-1 border border-0" name="city" placeholder="City">
                    </div>
                    <div class="mt-2 d-flex align-items-center justify-content-between bg-white rounded-5 p-2 border">

                        <svg class="ms-2" width="40" height="40" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.39687 14.7937C5.32954 14.7937 3.5799 14.0778 2.14794 12.6458C0.715979 11.2138 0 9.4642 0 7.39687C0 5.32954 0.715979 3.5799 2.14794 2.14794C3.5799 0.715979 5.32954 0 7.39687 0C9.4642 0 11.2138 0.715979 12.6458 2.14794C14.0778 3.5799 14.7937 5.32954 14.7937 7.39687C14.7937 8.23139 14.661 9.01849 14.3954 9.75818C14.1299 10.4979 13.7696 11.1522 13.3144 11.7212L19.6871 18.0939C19.8957 18.3025 20 18.568 20 18.8905C20 19.2129 19.8957 19.4784 19.6871 19.6871C19.4784 19.8957 19.2129 20 18.8905 20C18.568 20 18.3025 19.8957 18.0939 19.6871L11.7212 13.3144C11.1522 13.7696 10.4979 14.1299 9.75818 14.3954C9.01849 14.661 8.23139 14.7937 7.39687 14.7937ZM7.39687 12.5178C8.81935 12.5178 10.0284 12.0199 11.0242 11.0242C12.0199 10.0284 12.5178 8.81935 12.5178 7.39687C12.5178 5.9744 12.0199 4.76529 11.0242 3.76956C10.0284 2.77383 8.81935 2.27596 7.39687 2.27596C5.9744 2.27596 4.76529 2.77383 3.76956 3.76956C2.77383 4.76529 2.27596 5.9744 2.27596 7.39687C2.27596 8.81935 2.77383 10.0284 3.76956 11.0242C4.76529 12.0199 5.9744 12.5178 7.39687 12.5178Z"
                                fill="#CCCCCC" />
                        </svg>

                        <input class="form-control border border-0 rounded-5 me-2" type="text" placeholder="Search">
                        <button type="button" class="btn btn-secondary rounded-5 email-toggle-btn pt-2 pb-2 ps-4 pe-4"
                            data-item="phone">Search</button>
                    </div>
                </div>
            </div>

            {{-- Top Material Categories --}}
            <div class="col-md-12 text-center" wire:show="section == 'product'" x-transition.duration.500ms>
                {{-- <div class="text-warning mt-5 fw-bold fs-5">Material</div> --}}
                <div class="h3 fw-bold mt-5">Top Material Categories</div>
                <span>Your one-stop destination for premium building materials <br> from trusted sellers in your
                    area.</span>
                <div class="row mt-5 text-md-start justify-content-center">
                    @foreach ($data as $item)
                        <div class="col-md-3 col-lg-2 col-3">
                            <img class="w-100 category-image"
                                src="{{ asset('assets/material/' . strtolower(str_replace(' ', '_', $item->title)) . '.png') }}">
                            <p>{{ $item->title }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Top Service Providers --}}
            <div class="col-md-12 text-center" wire:show="section == 'service'" x-transition.duration.500ms>
                {{-- <div class="text-warning mt-5 fw-bold fs-5">Services</div> --}}
                <div class="h3 fw-bold mt-5">Top Service Providers</div>
                <span>Discover skilled experts and reliable services to make <br> your construction projects
                    hassle-free</span>
                <div class="row mt-5 text-md-start justify-content-center">
                    @foreach ($data as $item)
                        <div class="col-md-3 col-lg-2 col-3">
                            <img class="w-100 category-image"
                                src="{{ asset('assets/material/' . strtolower(str_replace(' ', '_', $item->title)) . '.png') }}">
                            <p>{{ $item->title }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Blogs --}}
            <div class="col-md-12 text-center justify-content-center">
                {{-- <div class="text-warning mt-5 fw-bold fs-5">Blogs</div> --}}
                <div class="h3 fw-bold mt-5">Ideas that shape the future</div>
                <div>Stay ahead with expert advice, innovative ideas, and <br> the latest updates from the world of
                    construction</div>
                <button class="btn btn-dark rounded-5 m-4">Read more</button>
                <div class="row mt-5 text-md-start justify-content-center">
                    <div class="col-md-3 col-lg-2">
                        <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                        <p>Cement & steel</p>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                        <p>Bricks</p>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                        <p>Tiles & Granites</p>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                        <p>Electrical Materials</p>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                        <p>Plumbing Materials</p>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                        <p>Ply & Laminates</p>
                    </div>
                </div>
            </div>

            {{-- Blogs --}}
            <div class="col-md-12 text-center justify-content-center">
                {{-- <div class="text-warning mt-5 fw-bold fs-5">Brands</div> --}}
                <div class="h3 fw-bold mt-5">Trusted by professionals</div>


            </div>
            <div wire:ignore>
                <div class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class=" splide__slide p-2">
                                <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                            </li>
                            <li class=" splide__slide p-2">
                                <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                            </li>
                            <li class=" splide__slide p-2">
                                <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                            </li>
                            <li class=" splide__slide p-2">
                                <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                            </li>
                            <li class=" splide__slide p-2">
                                <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                            </li>
                            <li class=" splide__slide p-2">
                                <img class="w-100" src="{{ asset('assets/material/cement.png') }}">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('style')
    <style>
        .form-control:focus {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            border-color: rgb(134, 182.5, 254);
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgb(255, 255, 255);
        }

        .category-image {
            aspect-ratio: 1/1;
            object-fit: cover;
            border-radius: 5px
        }

        @media (min-width: 768px) {
            .category-image {
                aspect-ratio: 16/9;
                object-fit: cover;
                border-radius: 5px
            }
        }

        @media (min-width: 1024px) {
            .category-image {
                aspect-ratio: 16/9;
                object-fit: cover;
                border-radius: 10px
            }
        }
    </style>
@endpush

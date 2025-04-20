<div>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 text-center rounded-4"
                style="background-image: url({{ asset('assets/bg/grey_bar.png') }});background-repeat: no-repeat; background-size: cover">
                <div class="pt-3">
                    I am looking for
                </div>
                <div class="d-flex justify-content-center mb-4">
                    <div class="d-flex justify-content-between bg-white rounded-5 p-2 border" style="width:fit-content">
                        <button type="button"
                            class="btn rounded-5 @if ($section == 'product') btn-dark @endif email-toggle-btn ps-4 pe-4 pt-2 pb-2"
                            data-item="email" wire:click="setSection('product')">Material</button>
                        <button type="button"
                            class="btn rounded-5 @if ($section == 'service') btn-dark @endif  email-toggle-btn pt-2 pb-2 ps-4 pe-4"
                            data-item="phone" wire:click="setSection('service')">Services</button>
                    </div>
                </div>
                <div class="d-md-flex position-relative justify-content-center mb-4">
                    <div class="bg-white rounded-5 p-2 border me-2" x-data="{ focused: false }"
                        :class="{ 'border-2 border-dark': focused }">
                        <input class="form-control rounded-5 mt-1 border border-0 bg-white" name="city"
                            placeholder="City" @focus="focused = true" @blur="focused = false" wire:click="toggle"
                            wire:model="selectedCity" readonly />
                    </div>
                    @if ($isOpen)
                        <div class="position-absolute mt-2 w-sp shadow bg-white border rounded-4 p-3"
                            style="z-index: 1050; max-height: 300px; overflow-y: auto;top:65px">
                            <input type="text" class="form-control mb-3" placeholder="Search"
                                wire:model.live="search">

                            @if (count($cities) > 0)
                                <div class="row row-cols-2 row-cols-md-4 g-2">
                                    @foreach ($cities as $city)
                                        <div>
                                            <button type="button" class="btn btn-light w-100 text-start"
                                                wire:click="selectCity('{{ $city }}')">
                                                {{ $city }}
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center text-muted">No results found</div>
                            @endif
                        </div>
                    @endif
                    <div class="d-flex align-items-center justify-content-between bg-white rounded-5 p-2 border mt-2 mt-md-0"
                        x-data="{ focused: false }" :class="{ 'border-2 border-dark': focused }">
                        <svg class="mx-2" width="40" height="40" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.39687 14.7937C5.32954 14.7937 3.5799 14.0778 2.14794 12.6458C0.715979 11.2138 0 9.4642 0 7.39687C0 5.32954 0.715979 3.5799 2.14794 2.14794C3.5799 0.715979 5.32954 0 7.39687 0C9.4642 0 11.2138 0.715979 12.6458 2.14794C14.0778 3.5799 14.7937 5.32954 14.7937 7.39687C14.7937 8.23139 14.661 9.01849 14.3954 9.75818C14.1299 10.4979 13.7696 11.1522 13.3144 11.7212L19.6871 18.0939C19.8957 18.3025 20 18.568 20 18.8905C20 19.2129 19.8957 19.4784 19.6871 19.6871C19.4784 19.8957 19.2129 20 18.8905 20C18.568 20 18.3025 19.8957 18.0939 19.6871L11.7212 13.3144C11.1522 13.7696 10.4979 14.1299 9.75818 14.3954C9.01849 14.661 8.23139 14.7937 7.39687 14.7937ZM7.39687 12.5178C8.81935 12.5178 10.0284 12.0199 11.0242 11.0242C12.0199 10.0284 12.5178 8.81935 12.5178 7.39687C12.5178 5.9744 12.0199 4.76529 11.0242 3.76956C10.0284 2.77383 8.81935 2.27596 7.39687 2.27596C5.9744 2.27596 4.76529 2.77383 3.76956 3.76956C2.77383 4.76529 2.27596 5.9744 2.27596 7.39687C2.27596 8.81935 2.77383 10.0284 3.76956 11.0242C4.76529 12.0199 5.9744 12.5178 7.39687 12.5178Z"
                                fill="#CCCCCC" />
                        </svg>
                        <input wire:model="productName" class="form-control border border-0 rounded-5 me-2 bg-white"
                            type="text" placeholder="Search" @focus='focused = true' @blur="focused = false">
                        @if ($searchStarted)
                            <button type="button" class="btn btn-dark rounded-5 email-toggle-btn pt-2 pb-2 ps-4 pe-4"
                                wire:click="clearSearch()">Clear</button>
                        @else
                            <button type="button" class="btn rounded-5 email-toggle-btn pt-2 pb-2 ps-4 pe-4"
                                :class="{ 'btn-dark': focused, 'btn-secondary': !focused }"
                                wire:click="searchProduct()">Search</button>
                        @endif
                    </div>
                </div>
            </div>

            @if (empty($sellers))
                {{-- Top Material Categories --}}
                <div class="col-md-12 text-center" wire:show="section == 'product'" x-transition.duration.500ms>
                    {{-- <div class="text-warning mt-5 fw-bold fs-5">Material</div> --}}
                    <div class="h3 fw-bold mt-5">Top Material Categories</div>
                    <span>Your one-stop destination for premium building materials <br> from trusted sellers in your
                        area.</span>
                    <div class="row mt-5 text-md-start justify-content-center">
                        @foreach ($data as $item)
                            <div class="col-md-3 col-lg-2 col-3 text-break">
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
                            <div class="col-md-3 col-lg-2 col-3 text-break">
                                <img class="w-100 category-image"
                                    src="{{ asset('assets/material/' . strtolower(str_replace(' ', '_', $item->title)) . '.png') }}">
                                <p>{{ $item->title }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (count($sellers) > 0)
                <div class="container py-4">
                    <h5 class="mb-4">
                        Top Sellers for <strong>{{ $productName }}</strong>
                    </h5>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        @foreach ($sellers as $seller)
                            <div class="col">
                                <div class="card h-100 shadow-sm">
                                    <div class="ratio ratio-21x9">
                                        @if ($seller->profile_image)
                                            <img src="{{ $seller->profile_image }}" class="card-img-top"
                                                alt="{{ $seller['name'] }}">
                                        @else
                                            <img class="card-img-top" src="{{ asset('assets/bg/bg_profile.png') }}">
                                        @endif
                                    </div>
                                    <div style="margin-top:-50px;z-index:5">
                                        <img src="{{ asset('assets/image/profile.png') }}" alt="{{ $seller['name'] }}"
                                            class="mx-auto d-block rounded"
                                            style="height: 100px; width: 100px; object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h5 class="card-title fw-bolder">{{ $seller->name }}</h5>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge bg-success me-2"><i class="bi bi-star-fill"></i>
                                                {{ $seller['rating'] }}</span>
                                            <span class="me-2"><i class="bi bi-people-fill"></i>
                                                {{ $seller['visitors'] }}</span>
                                            <span><i class="bi bi-clock-fill"></i> {{ $seller['timing'] }}</span>
                                        </div>

                                        <p class="mb-1 small text-muted border-bottom">GST Number:
                                            {{ $seller->gst ?? '-' }}</p>

                                        <p class="mb-1 small border-bottom pb-1">
                                            <strong>Categories:</strong>
                                            @foreach ($seller->categories as $category)
                                                {{ $category->title }} |
                                            @endforeach
                                        </p>

                                        <p class="mb-0 small">
                                            <i class="bi bi-geo-alt-fill me-1"></i>
                                            {{ $seller->address->full_address }}
                                        </p>
                                    </div>

                                    <div class="p-2 d-flex justify-content-between">
                                        <a class="btn btn-outline-dark w-100 me-1" href="{{ route('view-shop', $seller->uuid)}}">
                                            <i class="bi bi-shop me-1"></i> View Shop
                                        </a>
                                        <div class="d-flex">
                                            <button class="btn btn-dark me-1">
                                                <i class="bi bi-telephone-fill"></i>
                                            </button>
                                            <button class="btn btn-dark">
                                                <i class="bi bi-chat-dots-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                @if ($searchStarted)
                    <div class="container py-4 text-center">
                        <h4 class="mb-4">
                            No Results Found
                        </h4>
                    </div>
                @endif
            @endif

            @if(count($ads) > 0)
            {{-- Ads --}}
            <div class="col-md-12 text-center justify-content-center">
                {{-- <div class="text-warning mt-5 fw-bold fs-5">Brands</div> --}}
                <div class="h3 fw-bold mt-5">Trusted by professionals</div>
            </div>
            <div wire:ignore>
                <div class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($ads as $ad)
                            <li class=" splide__slide p-2">
                                <img class="w-100" src="{{ asset('storage/'.$ad->image) }}">
                            </li>
                            @endforeach
                            {{-- <li class=" splide__slide p-2">
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
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            @if (empty($sellers) && count($blogs) > 0)
                {{-- Blogs --}}
                <div class="col-md-12 text-center justify-content-center">
                    {{-- <div class="text-warning mt-5 fw-bold fs-5">Blogs</div> --}}
                    <div class="h3 fw-bold mt-5">Ideas that shape the future</div>
                    <div>Stay ahead with expert advice, innovative ideas, and <br> the latest updates from the world of
                        construction</div>
                    <a href="{{ route('blogs') }}" class="btn btn-dark rounded-5 m-4">Read more</a>
                    <div class="row mt-5 text-start justify-content-center">
                        @foreach($blogs as $data)
                        <div class="col-md-3 col-lg-2 col-6" wire:click="viewBlog('{{$data->slug}}')">
                            <div class="border rounded position-relative rounded-3">
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('storage/' . $data->blog_image) }}" class="d-block w-100 rounded-3" alt="Product Image">
                                </div>
                                <div style="height: 140px">
                                    <div class="p-1 fw-bold text-title"> {{ $data->title }}</div>
                                    <div class="p-1 text-secondary text-description"> {!! $data->description !!}
                                    </div>
                                    <small class="p-1 text-secondary position-absolute bottom-0">{{ $data->created_at->format('F j, Y') }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@push('style')
    <style>
        .form-control:focus {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            border-color: rgb(0, 0, 0);
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

        @media (min-width: 1024px) {
            .w-sp {
                width: 50%;
            }
        }

        @media (max-width: 768px) {
            .w-sp {
                width: 100%;
            }
        }
        .ratio-21x9 {
            --bs-aspect-ratio: 28.857143%;
        }

        .text-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Number of lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .text-title{
            display: -webkit-box;
            -webkit-line-clamp: 1;
            /* Number of lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush

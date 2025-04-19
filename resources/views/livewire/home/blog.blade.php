<div>
    <div class="container">
        @if ($fullBlog)
            <div>
                <!-- Blog Header -->
                <div class="bg-secondary-subtle text-secondary py-4 mb-4 rounded-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('blogs') }}" class="btn btn-defualt">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="40" height="40" rx="20"
                                            transform="matrix(-1 0 0 1 40 0)" fill="white" fill-opacity="0.8" />
                                        <path
                                            d="M16.7345 19.9974L23.472 13.2599C23.7012 13.0307 23.812 12.7595 23.8043 12.4464C23.7967 12.1332 23.6783 11.862 23.4491 11.6328C23.2199 11.4036 22.9488 11.2891 22.6356 11.2891C22.3224 11.2891 22.0512 11.4036 21.822 11.6328L14.7866 18.6911C14.6033 18.8745 14.4658 19.0807 14.3741 19.3099C14.2824 19.5391 14.2366 19.7682 14.2366 19.9974C14.2366 20.2266 14.2824 20.4557 14.3741 20.6849C14.4658 20.9141 14.6033 21.1203 14.7866 21.3036L21.8449 28.362C22.0741 28.5911 22.3415 28.7019 22.647 28.6943C22.9526 28.6866 23.2199 28.5682 23.4491 28.3391C23.6783 28.1099 23.7929 27.8387 23.7929 27.5255C23.7929 27.2123 23.6783 26.9411 23.4491 26.712L16.7345 19.9974Z"
                                            fill="black" />
                                    </svg>
                                </a>
                            </div>
                            <div class="col-12 text-center pb-4">
                                <h1>{{ $post->title }}</h1>
                                <p class=" mb-0 text-secondary ">{{ $post->created_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blog Content -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">
                            @if ($post->blog_image)
                                <div class="ratio ratio-21x9 my-3">
                                    <img src="{{ asset('storage/' . $post->blog_image) }}" alt="Featured Image"
                                        class="img-fluid rounded mb-4 object-fit-cover">
                                </div>
                            @endif

                            <div class="mb-5">
                                {!! nl2br(e($post->description)) !!}
                            </div>
                        </div>
                    </div>
                    @if (count($trendingBlogs) > 0)
                        <div class="col-md-12 text-center justify-content-center">
                            <div class="text-warning fw-bold fs-5">Blogs</div>
                            <div class="h3 fw-bold">Trending blog post ideas</div>
                            <div class="row mt-5 text-start justify-content-center">
                                @foreach ($trendingBlogs as $data)
                                    <div class="col-md-3 col-lg-2 col-6" wire:click="viewBlog('{{ $data->slug }}')">
                                        <div class="border rounded position-relative rounded-3">
                                            <div class="ratio ratio-16x9">
                                                <img src="{{ asset('storage/' . $data->blog_image) }}"
                                                    class="d-block w-100 rounded-3" alt="Product Image">
                                            </div>
                                            <div style="height: 140px">
                                                <div class="p-1 fw-bold text-title"> {{ $data->title }}</div>
                                                <div class="p-1 text-secondary text-description">
                                                    {!! $data->description !!}
                                                </div>
                                                <small
                                                    class="p-1 text-secondary position-absolute bottom-0">{{ $data->created_at->format('F j, Y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="row">
                <div class="bg-secondary-subtle text-secondary py-4 mb-4 rounded-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('home') }}" class="btn btn-defualt">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="40" height="40" rx="20"
                                            transform="matrix(-1 0 0 1 40 0)" fill="white" fill-opacity="0.8" />
                                        <path
                                            d="M16.7345 19.9974L23.472 13.2599C23.7012 13.0307 23.812 12.7595 23.8043 12.4464C23.7967 12.1332 23.6783 11.862 23.4491 11.6328C23.2199 11.4036 22.9488 11.2891 22.6356 11.2891C22.3224 11.2891 22.0512 11.4036 21.822 11.6328L14.7866 18.6911C14.6033 18.8745 14.4658 19.0807 14.3741 19.3099C14.2824 19.5391 14.2366 19.7682 14.2366 19.9974C14.2366 20.2266 14.2824 20.4557 14.3741 20.6849C14.4658 20.9141 14.6033 21.1203 14.7866 21.3036L21.8449 28.362C22.0741 28.5911 22.3415 28.7019 22.647 28.6943C22.9526 28.6866 23.2199 28.5682 23.4491 28.3391C23.6783 28.1099 23.7929 27.8387 23.7929 27.5255C23.7929 27.2123 23.6783 26.9411 23.4491 26.712L16.7345 19.9974Z"
                                            fill="black" />
                                    </svg>
                                </a>
                            </div>
                            <div class="col-12 text-center pb-5">
                                <h1>Blogs</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center justify-content-center">

                    <div class="h3 fw-bold mt-5">Ideas that shape the future</div>
                    <div>Stay ahead with expert advice, innovative ideas, and <br> the latest updates from the world of
                        construction</div>
                    <div class="row mt-5 text-start justify-content-center">
                        @foreach ($blogs as $data)
                            <div class="col-md-3 col-lg-2 col-6" wire:click="viewBlog('{{ $data->slug }}')">
                                <div class="border rounded position-relative rounded-3">
                                    <div class="ratio ratio-16x9">
                                        <img src="{{ asset('storage/' . $data->blog_image) }}"
                                            class="d-block w-100 rounded-3" alt="Product Image">
                                    </div>
                                    <div style="height: 140px">
                                        <div class="p-1 fw-bold text-title"> {{ $data->title }}</div>
                                        <div class="p-1 text-secondary text-description"> {!! $data->description !!}
                                        </div>
                                        <small
                                            class="p-1 text-secondary position-absolute bottom-0">{{ $data->created_at->format('F j, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
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

        .text-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Number of lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush

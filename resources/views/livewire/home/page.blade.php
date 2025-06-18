<div>
    <div class="container">
        <div class="row">
            @if ($post)
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
                            <div class="col-12 text-center pb-4">
                                <h1>{{ $post->page == 'tc' ? 'Terms and Conditions' : ($post->page == 'rp' ? 'Refund Policy' :'Privacy Policy') }}</h1>
                                <p class=" mb-0 text-secondary ">Updated on : {{ $post->created_at->format('F d, Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Blog Content -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-12">
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
                </div>
            @else
                <div class="col-12 text-center">
                    <p>No page found</p>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="slider-form {{$sliderStatus}}">
    <div class="slider-content">
        <div class="row">
            <div class="col-md-8">
                <p class="fw-bold fs-3">Add New Blog</p>
            </div>
            <div class="col-md-4 text-md-end mb-2">
                <a class="btn btn-default rounded-5 bg-custom-secondary" role="button" wire:click="closeSlider">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 my-3">
                <div class="form-floating mb-2 mt-2">
                    <input type="text" wire:model="title" class="form-control" id="title" placeholder="Product Name">
                    <label for="name">Blog Title</label>
                </div>
                @error('title')
                {{$message}}
                @enderror
            </div>
            <div class="col-12 my-3">
                <div class="dashed-border w-100 text-center position-relative" style="height: 25vh">
                    @if (gettype($blog_image) == 'string')
                        <img for="blogImage" src="{{ asset('storage/' . $blog_image) }}" class="img-fluid" style="width: 100%;height: 100%;object-fit: cover;">
                        <a class="position-absolute top-0 end-0 p-2" style="z-index: 1" wire:click="deleteImage()">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="30" height="30" rx="15" transform="matrix(-1 0 0 1 30 0)"
                                    fill="white" fill-opacity="0.6" />
                                <path
                                    d="M20.4948 13.1016C20.4948 13.1016 20.0876 18.1528 19.8513 20.2806C19.7388 21.2968 19.1111 21.8923 18.0828 21.9111C16.1261 21.9463 14.1671 21.9486 12.2111 21.9073C11.2218 21.8871 10.6046 21.2841 10.4943 20.2858C10.2566 18.1393 9.85156 13.1016 9.85156 13.1016"
                                    stroke="#EC1D25" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M21.531 10.6797H8.8125" stroke="#EC1D25" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M19.0829 10.6793C18.4941 10.6793 17.9871 10.263 17.8716 9.68625L17.6894 8.77425C17.5769 8.3535 17.1959 8.0625 16.7616 8.0625H13.5869C13.1526 8.0625 12.7716 8.3535 12.6591 8.77425L12.4769 9.68625C12.3614 10.263 11.8544 10.6793 11.2656 10.6793"
                                    stroke="#EC1D25" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    @elseif($blog_image)
                        <img src="{{$blog_image->temporaryUrl()}}" class="img-fluid" style="width: 100%;height: 100%;object-fit: cover;">
                        <a class="position-absolute top-0 end-0 p-2" style="z-index: 1" wire:click="deleteImage()">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="30" height="30" rx="15" transform="matrix(-1 0 0 1 30 0)"
                                    fill="white" fill-opacity="0.6" />
                                <path
                                    d="M20.4948 13.1016C20.4948 13.1016 20.0876 18.1528 19.8513 20.2806C19.7388 21.2968 19.1111 21.8923 18.0828 21.9111C16.1261 21.9463 14.1671 21.9486 12.2111 21.9073C11.2218 21.8871 10.6046 21.2841 10.4943 20.2858C10.2566 18.1393 9.85156 13.1016 9.85156 13.1016"
                                    stroke="#EC1D25" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M21.531 10.6797H8.8125" stroke="#EC1D25" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M19.0829 10.6793C18.4941 10.6793 17.9871 10.263 17.8716 9.68625L17.6894 8.77425C17.5769 8.3535 17.1959 8.0625 16.7616 8.0625H13.5869C13.1526 8.0625 12.7716 8.3535 12.6591 8.77425L12.4769 9.68625C12.3614 10.263 11.8544 10.6793 11.2656 10.6793"
                                    stroke="#EC1D25" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                        @error('blog_image')
                        {{$message}}
                        @enderror
                    @else
                        <span class="d-flex flex-column align-items-center justify-content-center text-center" style="height: 100%;">
                            <input type="file" wire:model.live="blog_image" id="blogImage" hidden="" accept="image/*">
                            <label for="blogImage" class="d-flex flex-column align-items-center justify-content-center" style="cursor: pointer; height: 100%;">
                                <i class="fa-regular fa-square-plus fs-1 text-secondary"></i>
                                <p class="mb-0">Add Blog Image</p>
                            </label>
                        </span>
                        @error('blog_image')
                        {{$message}}
                        @enderror
                    @endif
                </div>
            </div>
            <div class="col-12">
                <textarea class="form-control mt-3 mb-3" placeholder="Blog Description" rows="10" wire:model="description"></textarea>
                @error('description')
                {{$message}}
                @enderror
                <p class="italic text-secondary">*Blogs are publicly visible once published.</p>
            </div>
            <div class="col-md-12 mt-4">
                @if($isEdit)
                    <button class="btn btn-dark" wire:click="updateBlog({{$editBlogData->id}})">Update Blogs</button>
                @else
                    <button class="btn btn-dark" wire:click="publishBlog">Publish Blogs</button>
                @endif
                @if($isEdit)
                <button class="btn btn-default" wire:click="deleteProductSeller('{{$editBlogData->id}}')"
                    wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE">Delete</button>
                @endif
            </div>
        </div>
    </div>
</div>

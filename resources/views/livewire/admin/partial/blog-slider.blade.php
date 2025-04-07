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
                <div class="dashed-border w-100 text-center " style="height: 25vh">
                    @if (gettype($blog_image) == 'string')
                        <input type="file" wire:model="blog_image" id="blogImage" hidden accept="image/*">
                        <img for="blogImage" src="{{ asset('storage/' . $blog_image) }}" class="img-fluid" style="width: 100%;height: 100%;object-fit: cover;">
                    @elseif($blog_image)
                        <img src="{{$blog_image->temporaryUrl()}}" class="img-fluid" style="width: 100%;height: 100%;object-fit: cover;">
                        @error('blog_image')
                        {{$message}}
                        @enderror
                    @else
                        {{-- <span class="text-center my-auto">
                            <input type="file" wire:model="blog_image" id="blogImage" hidden accept="image/*">
                            <label for="blogImage">
                                <i class="fa-regular fa-square-plus fs-1 text-secondary"></i>
                                <p>Add Blog Image</p>
                            </label>
                        </span> --}}
                        <span class="d-flex flex-column align-items-center justify-content-center text-center" style="height: 100%;">
                            <input type="file" wire:model="blog_image" id="blogImage" hidden="" accept="image/*">
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
                <textarea class="form-control mt-3 mb-3" placeholder="Blog Description" line="10" wire:model="description"></textarea>
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

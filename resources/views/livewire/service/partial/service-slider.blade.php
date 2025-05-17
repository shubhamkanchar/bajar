<div class="slider-form" wire:ignore.self>
    <div class="slider-content">
        <div class="row">
            <div class="col-md-8">
                <p class="fw-bold fs-3">Add work portfolio</p>
            </div>
            <div class="col-md-4 text-md-end mb-2">
                <span class="badge rounded-pill text-bg-light p-3 me-3">
                    <svg class="me-2" width="12" height="13" viewBox="0 0 12 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.76677 12.8203C1.33814 12.8203 0.179688 11.662 0.179688 10.2338L0.179688 7.39006C0.179688 5.96135 1.33806 4.80298 2.76677 4.80298H3.31102C3.55265 4.80298 3.74852 4.99885 3.74852 5.24048C3.74852 5.4821 3.55265 5.67798 3.31102 5.67798H2.76677C1.82131 5.67798 1.05469 6.4446 1.05469 7.39006L1.05469 10.2338C1.05469 11.1786 1.82123 11.9453 2.76677 11.9453H9.25927C10.2048 11.9453 10.9714 11.1786 10.9714 10.2338V7.38423C10.9714 6.44211 10.2075 5.67798 9.26569 5.67798H8.7156C8.47398 5.67798 8.2781 5.4821 8.2781 5.24048C8.2781 4.99885 8.47398 4.80298 8.7156 4.80298H9.26569C10.6911 4.80298 11.8464 5.95917 11.8464 7.38423V10.2338C11.8464 11.662 10.6879 12.8203 9.25927 12.8203H2.76677Z"
                            fill="black" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.01562 8.74219C5.774 8.74219 5.57812 8.54631 5.57812 8.30469L5.57813 1.28077C5.57813 1.03914 5.774 0.843269 6.01563 0.843269C6.25725 0.843269 6.45312 1.03914 6.45312 1.28077V8.30469C6.45312 8.54631 6.25725 8.74219 6.01562 8.74219Z"
                            fill="black" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4.00383 3.29442C3.8326 3.12395 3.83198 2.84694 4.00245 2.6757L5.70287 0.967705C5.78496 0.885246 5.89652 0.838885 6.01288 0.838875C6.12924 0.838865 6.2408 0.885206 6.32291 0.967652L8.02391 2.67565C8.19441 2.84686 8.19385 3.12387 8.02264 3.29437C7.85144 3.46487 7.57443 3.4643 7.40392 3.2931L6.01297 1.89642L4.62255 3.29305C4.45207 3.46428 4.17506 3.4649 4.00383 3.29442Z"
                            fill="black" />
                    </svg>
                    Bulk Upload
                </span>
                <a class="btn btn-default rounded-5 bg-custom-secondary" role="button" id="closeSliderBtn">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
        </div>

        <form>
            <div class="row">
                <div class="col-md-5 mb-3 position-relative">
                    @if ($service_images['service_image1'])
                        {{-- <button type="button" style="z-index: 1" class="btn btn-danger position-absolute top-0 end-1 m-1" wire:click="removeImage('service_image1')" wire:key="remove-button-1">
                            <i class="fa fa-times"></i>
                        </button> --}}
                        <label role="button" style="z-index: 1" class="position-absolute top-0 end-0 pe-3 pt-1"
                            wire:click="removeImage('service_image1')" wire:key="remove-button-1">

                            <svg width="40" height="40" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="30" height="30" rx="15" transform="matrix(-1 0 0 1 30 0)"
                                    fill="#EDEDED" />
                                <path
                                    d="M19.6513 13.3766C19.9197 13.3982 20.1199 13.6338 20.0982 13.9022V13.9054C20.098 13.9075 20.0973 13.9108 20.097 13.9149C20.0963 13.9233 20.0957 13.9356 20.0944 13.9518C20.0918 13.9843 20.088 14.0324 20.083 14.094C20.0729 14.2174 20.058 14.396 20.0398 14.6158C20.0035 15.0554 19.9527 15.661 19.8957 16.3241C19.8104 17.3173 19.7103 18.4439 19.6221 19.3371L19.5389 20.1389C19.4803 20.6677 19.2812 21.1353 18.9173 21.4733C18.598 21.7699 18.1889 21.9329 17.7301 21.9755L17.5301 21.9863C15.8285 22.0169 14.1238 22.019 12.4212 21.9831V21.9825C11.8928 21.9715 11.4212 21.8025 11.0657 21.4638C10.7564 21.1691 10.5674 20.7776 10.4867 20.3357L10.4587 20.1433C10.3549 19.2061 10.2154 17.6436 10.1019 16.3203C10.0451 15.6577 9.9946 15.0533 9.95844 14.6145C9.94036 14.3951 9.92592 14.2165 9.9159 14.0933C9.91091 14.032 9.9071 13.9842 9.90447 13.9518C9.90318 13.9357 9.90197 13.9233 9.9013 13.9149C9.90098 13.9109 9.90083 13.9075 9.90066 13.9054C9.90058 13.9044 9.90071 13.9034 9.90066 13.9029L9.90003 13.9022C9.87846 13.6339 10.0787 13.3983 10.347 13.3766C10.6153 13.355 10.851 13.5552 10.8727 13.8235L10.3864 13.8629L10.8727 13.8242V13.8267C10.8728 13.8288 10.873 13.8321 10.8733 13.8362C10.874 13.8445 10.8752 13.8569 10.8765 13.873C10.8791 13.9054 10.8829 13.9532 10.8879 14.0146C10.8979 14.1374 10.9124 14.315 10.9305 14.5339C10.9666 14.972 11.0166 15.5757 11.0733 16.2372C11.1869 17.562 11.3259 19.1127 11.4282 20.036V20.0367L11.446 20.1605C11.4965 20.4377 11.6047 20.6308 11.738 20.7579C11.8881 20.9009 12.1128 21.0012 12.4415 21.008H12.4421L13.7087 21.0277C14.9759 21.0407 16.2444 21.034 17.5123 21.0112L17.6393 21.0042C17.9219 20.9783 18.1189 20.8845 18.2539 20.7591C18.4093 20.6148 18.5311 20.3837 18.57 20.0316L18.6519 19.24C18.7392 18.3559 18.8389 17.2355 18.9243 16.241C18.9812 15.5792 19.0315 14.9747 19.0678 14.5358C19.0859 14.3165 19.1009 14.1384 19.111 14.0152C19.116 13.9537 19.1198 13.9055 19.1224 13.873C19.1237 13.8569 19.1243 13.8445 19.1249 13.8362C19.1253 13.8321 19.126 13.8288 19.1262 13.8267V13.8235L19.1326 13.774C19.1773 13.5311 19.3998 13.3564 19.6513 13.3766Z"
                                    fill="#EC1D25" />
                                <path
                                    d="M20.5124 11.2734L20.5626 11.276C20.8083 11.3011 21 11.5087 21 11.761C21 12.0133 20.8083 12.2209 20.5626 12.246L20.5124 12.2485H9.48759C9.2183 12.2485 9 12.0303 9 11.761C9 11.4917 9.2183 11.2734 9.48759 11.2734H20.5124Z"
                                    fill="#EC1D25" />
                                <path
                                    d="M16.3768 9C16.9359 9.00003 17.4314 9.35146 17.6186 9.87227L17.6516 9.97829L17.6593 10.0088L17.8173 10.7991H17.8167C17.8644 11.0374 18.054 11.218 18.2865 11.2594L18.3887 11.2683L18.4389 11.2708C18.6847 11.2959 18.8763 11.5035 18.8763 11.7558C18.8763 12.0081 18.6846 12.2158 18.4389 12.2408L18.3887 12.2434L18.251 12.237C17.568 12.1767 16.9972 11.6728 16.8606 10.9909V10.9902L16.7063 10.2208C16.6628 10.0755 16.5298 9.97515 16.3768 9.97511H13.6246C13.4705 9.97519 13.3362 10.0769 13.2938 10.224L13.1408 10.9902V10.9909C12.995 11.7183 12.3556 12.2434 11.6126 12.2434C11.3434 12.2434 11.1251 12.025 11.125 11.7558C11.125 11.4866 11.3433 11.2683 11.6126 11.2683C11.8903 11.2683 12.1301 11.0715 12.1846 10.7991L12.3421 10.0088L12.3497 9.97829L12.3827 9.87227C12.5699 9.35148 13.0655 9.00007 13.6246 9H16.3768Z"
                                    fill="#EC1D25" />
                            </svg>

                        </label>
                    @endif
                    <label class="dashed-border d-flex flex-column justify-content-center align-items-center text-center" style="height: 100%;width: 100%;aspect-ratio: 1 / 1" for="serviceImage1">
                        @if ($isEdit && gettype($service_images['service_image1']) == 'string')
                            <img src="{{ asset('storage/' . $service_images['service_image1']) }}" class="img-fluid">
                        @elseif ($service_images['service_image1'])
                            <img src="{{$service_images['service_image1']->temporaryUrl()}}" class="img-fluid">
                        @else
                            <span class="text-center" style="top: 35%;" wire:loading.remove wire:target="service_images.service_image1">
                                <input type="file" wire:model.blur="service_images.service_image1" id="serviceImage1" hidden accept="image/*">
                                <label >
                                    <i class="fa-regular fa-square-plus fs-1 text-secondary"></i>
                                </label>
                            </span>
                        @endif
                
                        <!-- Show loader during image upload -->
                        <div wire:loading wire:target="service_images.service_image1" style="top: 35%;">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </label>
                    @error('service_images.service_image1') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-7">
                    <div class="row" style="height: 100%;">
                        @foreach([2, 3, 4, 5, 6] as $index)
                            <div class="col-md-4 mb-3 col-6 position-relative">
                                @if ($service_images['service_image' . $index])
                                    {{-- <button type="button" style="z-index: 1" class="btn btn-danger position-absolute top-0 end-1 m-1" wire:click="removeImage('service_image{{ $index }}')" wire:key="remove-button-{{ $index }}" accept="image/*">
                                        <i class="fa fa-times"></i>
                                    </button> --}}
                                    <label role="button" style="z-index: 1"
                                        class="position-absolute top-0 end-0 pe-3 pt-1"
                                        wire:click="removeImage('service_image{{ $index }}')"
                                        wire:key="remove-button-{{ $index }}" accept="image/*">

                                        <svg width="40" height="40" viewBox="0 0 30 30" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="30" height="30" rx="15"
                                                transform="matrix(-1 0 0 1 30 0)" fill="#EDEDED" />
                                            <path
                                                d="M19.6513 13.3766C19.9197 13.3982 20.1199 13.6338 20.0982 13.9022V13.9054C20.098 13.9075 20.0973 13.9108 20.097 13.9149C20.0963 13.9233 20.0957 13.9356 20.0944 13.9518C20.0918 13.9843 20.088 14.0324 20.083 14.094C20.0729 14.2174 20.058 14.396 20.0398 14.6158C20.0035 15.0554 19.9527 15.661 19.8957 16.3241C19.8104 17.3173 19.7103 18.4439 19.6221 19.3371L19.5389 20.1389C19.4803 20.6677 19.2812 21.1353 18.9173 21.4733C18.598 21.7699 18.1889 21.9329 17.7301 21.9755L17.5301 21.9863C15.8285 22.0169 14.1238 22.019 12.4212 21.9831V21.9825C11.8928 21.9715 11.4212 21.8025 11.0657 21.4638C10.7564 21.1691 10.5674 20.7776 10.4867 20.3357L10.4587 20.1433C10.3549 19.2061 10.2154 17.6436 10.1019 16.3203C10.0451 15.6577 9.9946 15.0533 9.95844 14.6145C9.94036 14.3951 9.92592 14.2165 9.9159 14.0933C9.91091 14.032 9.9071 13.9842 9.90447 13.9518C9.90318 13.9357 9.90197 13.9233 9.9013 13.9149C9.90098 13.9109 9.90083 13.9075 9.90066 13.9054C9.90058 13.9044 9.90071 13.9034 9.90066 13.9029L9.90003 13.9022C9.87846 13.6339 10.0787 13.3983 10.347 13.3766C10.6153 13.355 10.851 13.5552 10.8727 13.8235L10.3864 13.8629L10.8727 13.8242V13.8267C10.8728 13.8288 10.873 13.8321 10.8733 13.8362C10.874 13.8445 10.8752 13.8569 10.8765 13.873C10.8791 13.9054 10.8829 13.9532 10.8879 14.0146C10.8979 14.1374 10.9124 14.315 10.9305 14.5339C10.9666 14.972 11.0166 15.5757 11.0733 16.2372C11.1869 17.562 11.3259 19.1127 11.4282 20.036V20.0367L11.446 20.1605C11.4965 20.4377 11.6047 20.6308 11.738 20.7579C11.8881 20.9009 12.1128 21.0012 12.4415 21.008H12.4421L13.7087 21.0277C14.9759 21.0407 16.2444 21.034 17.5123 21.0112L17.6393 21.0042C17.9219 20.9783 18.1189 20.8845 18.2539 20.7591C18.4093 20.6148 18.5311 20.3837 18.57 20.0316L18.6519 19.24C18.7392 18.3559 18.8389 17.2355 18.9243 16.241C18.9812 15.5792 19.0315 14.9747 19.0678 14.5358C19.0859 14.3165 19.1009 14.1384 19.111 14.0152C19.116 13.9537 19.1198 13.9055 19.1224 13.873C19.1237 13.8569 19.1243 13.8445 19.1249 13.8362C19.1253 13.8321 19.126 13.8288 19.1262 13.8267V13.8235L19.1326 13.774C19.1773 13.5311 19.3998 13.3564 19.6513 13.3766Z"
                                                fill="#EC1D25" />
                                            <path
                                                d="M20.5124 11.2734L20.5626 11.276C20.8083 11.3011 21 11.5087 21 11.761C21 12.0133 20.8083 12.2209 20.5626 12.246L20.5124 12.2485H9.48759C9.2183 12.2485 9 12.0303 9 11.761C9 11.4917 9.2183 11.2734 9.48759 11.2734H20.5124Z"
                                                fill="#EC1D25" />
                                            <path
                                                d="M16.3768 9C16.9359 9.00003 17.4314 9.35146 17.6186 9.87227L17.6516 9.97829L17.6593 10.0088L17.8173 10.7991H17.8167C17.8644 11.0374 18.054 11.218 18.2865 11.2594L18.3887 11.2683L18.4389 11.2708C18.6847 11.2959 18.8763 11.5035 18.8763 11.7558C18.8763 12.0081 18.6846 12.2158 18.4389 12.2408L18.3887 12.2434L18.251 12.237C17.568 12.1767 16.9972 11.6728 16.8606 10.9909V10.9902L16.7063 10.2208C16.6628 10.0755 16.5298 9.97515 16.3768 9.97511H13.6246C13.4705 9.97519 13.3362 10.0769 13.2938 10.224L13.1408 10.9902V10.9909C12.995 11.7183 12.3556 12.2434 11.6126 12.2434C11.3434 12.2434 11.1251 12.025 11.125 11.7558C11.125 11.4866 11.3433 11.2683 11.6126 11.2683C11.8903 11.2683 12.1301 11.0715 12.1846 10.7991L12.3421 10.0088L12.3497 9.97829L12.3827 9.87227C12.5699 9.35148 13.0655 9.00007 13.6246 9H16.3768Z"
                                                fill="#EC1D25" />
                                        </svg>

                                    </label>
                                @endif
                                <label class="dashed-border d-flex flex-column justify-content-center align-items-center text-center" style="height: 100%;width: 100%;aspect-ratio: 1 / 1" for="serviceImage{{$index}}">
                                    @if ($isEdit && gettype($service_images['service_image'. $index]) == 'string')
                                        <img src="{{ asset('storage/' . $service_images['service_image'. $index]) }}" class="img-fluid">
                                    @elseif($service_images['service_image' . $index])
                                        <img src="{{$service_images['service_image' . $index]->temporaryUrl()}}" class="img-fluid">
                                    @else
                                        <span class="text-center" style="top: 35%;" wire:loading.remove wire:target="service_images.service_image{{$index}}">
                                            <input type="file" wire:model.blur="service_images.service_image{{$index}}" id="serviceImage{{$index}}" hidden>
                                            <label >
                                                <i class="fa-regular d-flex fa-square-plus fs-1 text-secondary justify-content-center align-items-center"></i>
                                            </label>
                                        </span>
                                    @endif
                
                                    <!-- Show loader during image upload -->
                                    <div wire:loading wire:target="service_images.service_image{{$index}}" style="top: 35%">
                                        <div class="d-flex justify-content-center">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                @error('service_images.service_image' . $index) <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-floating mb-2 mt-2">
                        <input type="text" name="work_brief" class="form-control" id="workBrief"
                            placeholder="Work Brief" wire:model="work_brief">
                        <label for="name">Work Brief</label>
                        @error('work_brief') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-2 mt-2">
                        <select class="form-select" id="serviceCategory"
                            aria-label="Floating label select example" wire:model="category">
                            <option selected>Service Category</option>
                            @foreach ($this->categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                        <label for="serviceCategory">Service Category</label>
                        @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="col-md-6" wire:ignore>
                    <div class="form-floating my-2">
                        <select class="form-control" id="tagInput" wire:model="product_tag">
                            <option value="">Service Tag/Service Group</option>
                            @foreach($allTags as $tag)
                                <option {{ $tag == $product_tag ? 'selected' : '' }} value="{{ $tag }}">{{ $tag }}</option>
                            @endforeach
                        </select>
                        <label for="tagInput">Service Tag/Service Group</label>
                    </div>
                </div>
                <div class="col-12">
                    <textarea class="form-control mt-3 mb-3" placeholder="Work Description" line="5" wire:model="description"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-12 mt-4">
                    <p>*Your work will be under review for the initial 24 hours before it’s live</p>
                    <div class="row">
                        <div class="col-md-5 mt-2 mb-2">
                            <button wire:click.prevent="saveService" class="btn btn-dark w-100">{{ $isEdit ? 'Edit work' : 'Add Work'}}</button>
                        </div>
                        <div class="col-md-5 mt-2 mb-2">

                            @if ($isEdit)    
                                <button wire:click.prevent="deleteService" wire:loading.attr="disabled"  wire:confirm="Are you sure want to delete this service" class="btn btn-default bg-custom-secondary">
                                    <svg class="me-2" width="19" height="20" viewBox="0 0 19 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.3238 7.46875C16.3238 7.46875 15.7808 14.2037 15.4658 17.0407C15.3158 18.3957 14.4788 19.1898 13.1078 19.2148C10.4988 19.2618 7.88681 19.2648 5.27881 19.2098C3.95981 19.1828 3.13681 18.3788 2.98981 17.0478C2.67281 14.1858 2.13281 7.46875 2.13281 7.46875"
                                            stroke="black" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M17.708 4.24219H0.75" stroke="black" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M14.4386 4.239C13.6536 4.239 12.9776 3.684 12.8236 2.915L12.5806 1.699C12.4306 1.138 11.9226 0.75 11.3436 0.75H7.11063C6.53163 0.75 6.02363 1.138 5.87363 1.699L5.63063 2.915C5.47663 3.684 4.80063 4.239 4.01562 4.239"
                                            stroke="black" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Delete
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
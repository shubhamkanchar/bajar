<div class="container">
    <div class="row">
         @if(!$user->activeSubscription)
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                <div>
                    <strong>Attention!</strong> Your account is inactive. Please subscribe to activate account.
                </div>
                <a href="{{ route('business.edit', ['uuid' => $user->uuid]) }}#subcriptionSection" class="btn btn-dark">Subscribe</a>
            </div>
            </div>
        @endif
        
        <!-- Banner -->
        <div class="col-12 mt-4 position-relative">
            @if ($user->bg_image)
                <img class="w-100 h-250 object-fit-cover rounded-4" src="{{ asset('storage/' . $user->bg_image) }}">
            @else
                <picture>
                    <source media="(max-width: 767px)" srcset="{{ asset('assets/image/mobile/banner_01.png') }}">
                    <img class="w-100 h-250 object-fit-cover rounded-4" src="{{ asset('assets/image/desktop/banner_01.png') }}">
                </picture>
            @endif
             <a role="button" class="position-absolute top-0 end-0 p-2 pe-4" style="z-index: 1" href="https://wa.me/?text={{ urlencode(route('view-shop', ['uuid' => $user->uuid])) }}" target="_blank">
                <i class="fa fa-share-alt fa-2x text-white bg-dark rounded-circle p-2 bg-opacity-50"></i>
            </a>
        </div>
        
        <!-- Profile Info -->
        <div class="col-12 mb-3 mt-2">
            <div class="row">
                 <div class="col-md-4 col-lg-3 col-xl-2 col-6 offset-3 offset-sm-0 position-relative" style="margin-top:-70px">
                    @if ($user->profile_image)
                        <img class="ms-md-4 p-2 p-sm-0 square-img-profile" src="{{ asset('storage/' . $user->profile_image) }}">
                    @else
                        <img class="ms-md-4 p-2 p-sm-0 square-img-profile" src="{{ asset('assets/image/business_profile.png') }}">
                    @endif
                </div>
                <div class="col-md-4 col-lg-5 col-xl-5 col-12">
                     <div class="d-xl-flex align-items-center ms-xl-2 text-md-start text-center p-md-2">
                        <span class="fw-bold fs-4">{{ $user->name }}</span>
                         @if ($user->gst)
                            <span class="badge text-bg-light fs-6 ms-xl-2"><span class="fw-light">GST : </span> {{ $user->gst }}</span>
                        @endif
                     </div>
                      <div class="ms-xl-2 mt-2 d-flex p-md-2">
                         <span class="me-2"><i class="fa fa-map-marker text-muted"></i></span>
                         <span>{{ $user->address->address }}, {{ $user->address->city }}, {{ $user->address->state }}</span>
                     </div>
                </div>
                
                 <div class="col-md-4 col-lg-4 col-xl-5 col-12 text-md-end">
                     <div class="d-lg-flex float-md-end text-md-end">
                          <span class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-2 me-2">
                              {{ $user->activeSubscription ? $user->activeSubscription->plan_name : 'Free' }}
                          </span>
                           @if ($user->ratings?->total_score)
                                <span class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">
                                     <i class="fas fa-star text-success me-1"></i> {{ $user->ratings->total_score }}
                                </span>
                           @endif
                           @if ($businessRatingsCount)
                                <span class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">
                                     <i class="fas fa-certificate text-primary me-1"></i> {{ $businessRatingsCount }}
                                </span>
                            @endif
                            <span class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">
                                <i class="far fa-clock text-muted me-1"></i> {{ $businessTime }}
                             </span>
                     </div>
                      <div class="d-lg-flex justify-content-end align-items-end float-md-end w-100  pb-2" style="height:60%">
                            <a href="{{ route('business.edit', ['uuid' => $user->uuid]) }}" class="btn btn-dark">
                                <i class="fa fa-edit me-1"></i> Edit Profile
                            </a>
                        </div>
                 </div>
            </div>
        </div>
        
        <hr>
        
        <!-- Filters & Stats -->
        <div class="col-md-9">
             <span class="badge rounded-pill text-bg-dark fs-6 p-3 m-1 cat-filter" data-id="all" role="button">All</span>
            @foreach ($myCategories as $cat)
                <span class="badge rounded-pill text-bg-light fs-6 p-3 m-1 cat-filter" data-id="{{ $cat->id }}" role="button">{{ $cat->title }}</span>
            @endforeach
        </div>
         <div class="col-md-3">
             <div class="d-flex float-md-end mt-3">
                 <span class="text-end me-2">
                    <span class="d-block">Total work Added</span>
                    <span class="d-block fw-bold">{{ $products->count() }}</span>
                </span>
                <button class="btn btn-default rounded-5 bg-custom-secondary"><i class="fa fa-chart-bar"></i></button>
             </div>
         </div>
         
         <!-- Products List -->
         <div class="col-12 mt-3 mb-5 product-list row">
             <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-6 mb-3">
                 <a role="button" onclick="openSlider()">
                    <div class="dashed-border d-flex flex-column justify-content-center align-items-center text-center h-100" style="min-height:250px">
                        <i class="fa-regular fa-square-plus fs-1 text-secondary "></i>
                        <div class="fs-4 fw-bold">Add Product</div>
                        <small>Adding more products improve your search rankings</small>
                    </div>
                </a>
             </div>
             
             @foreach ($products as $product)
                <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-6 mb-3 product-item" data-cat-id="{{ $product->category_id }}">
                     <div class="position-relative my-2 border rounded">
                         <div id="pCarousel{{$product->id}}" class="carousel slide" data-bs-ride="carousel">
                             <div class="carousel-inner ratio ratio-1x1">
                                 @foreach($product->images as $k=>$img)
                                    <div class="carousel-item {{$k==0?'active':''}}">
                                        <img src="{{ asset('storage/'.$img->path) }}" class="d-block w-100 object-fit-cover rounded-top">
                                    </div>
                                 @endforeach
                             </div>
                             @if(count($product->images) > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#pCarousel{{$product->id}}" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                                <button class="carousel-control-next" type="button" data-bs-target="#pCarousel{{$product->id}}" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                             @endif
                         </div>
                         <div class="p-2" role="button" onclick="editProduct({{ $product->id }})">
                             <p class="mb-1 text-truncate fw-bold">{{ $product->name }}</p>
                             <small class="text-muted d-block text-truncate">{{ $product->brand_name }}</small>
                             @if($product->show_price)
                                <span class="fw-bold">Rs. {{ $product->price }}</span> <small>/ {{ $product->quantity }}</small>
                             @else
                                <small class="text-muted">Contact for price</small>
                             @endif
                         </div>
                          @if(!$product->is_approved)
                            <div class="position-absolute top-0 end-0 bg-warning p-1 rounded-bl text-white" style="font-size:0.7rem">Pending</div>
                          @endif
                     </div>
                </div>
             @endforeach
         </div>
    </div>
</div>

<!-- Add/Edit Slider -->
<div class="slider-overlay" id="slider-overlay" onclick="closeSlider()"></div>
<div class="slider-form" id="product-slider">
    <div class="slider-content">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="fw-bold" id="slider-title">Add Product</h3>
            <button class="btn btn-default rounded-5 bg-custom-secondary" onclick="closeSlider()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        
        <form id="product-form">
            @csrf
            <input type="hidden" name="id" id="product-id">
            
            <!-- Images -->
            <div class="row mb-3">
                <div class="col-5">
                    <label class="dashed-border d-flex align-items-center justify-content-center ratio ratio-1x1" for="img1" style="cursor:pointer">
                        <img id="preview1" class="w-100 h-100 object-fit-cover d-none">
                        <span id="ph1"><i class="fa fa-plus fs-1 text-secondary"></i></span>
                    </label>
                    <input type="file" name="product_image1" id="img1" hidden accept="image/*" onchange="preview(this, 1)">
                </div>
                <div class="col-7">
                    <div class="row g-2">
                        @for($i=2; $i<=6; $i++)
                            <div class="col-4">
                                <label class="dashed-border d-flex align-items-center justify-content-center ratio ratio-1x1" for="img{{$i}}" style="cursor:pointer">
                                    <img id="preview{{$i}}" class="w-100 h-100 object-fit-cover d-none">
                                    <span id="ph{{$i}}"><i class="fa fa-plus text-secondary"></i></span>
                                </label>
                                <input type="file" name="product_image{{$i}}" id="img{{$i}}" hidden accept="image/*" onchange="preview(this, {{$i}})">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="product_name" id="product_name" required>
                <label>Product Name</label>
            </div>
             <div class="form-floating mb-3">
                <input type="text" class="form-control" name="brand_name" id="brand_name" required>
                <label>Brand Name</label>
            </div>
            
             <div class="row mb-3">
                 <div class="col-6">
                      <div class="form-floating">
                        <select class="form-select" name="category" id="category" required>
                            <option value="">Category</option>
                            @foreach($allCategories as $c)
                                <option value="{{$c->id}}">{{$c->title}}</option>
                            @endforeach
                        </select>
                        <label>Category</label>
                    </div>
                 </div>
                 <div class="col-6">
                      <div class="form-floating">
                        <input type="text" class="form-control" name="product_tag" id="product_tag" required placeholder="Tag">
                        <label>Tag/Group</label>
                    </div>
                 </div>
             </div>
             
             <div class="row mb-3 align-items-center">
                 <div class="col-6">
                     <div class="input-group">
                         <span class="input-group-text">Rs.</span>
                         <input type="number" class="form-control" name="price" id="price" required>
                     </div>
                 </div>
                 <div class="col-1 text-center">/</div>
                 <div class="col-5">
                      <select class="form-select" name="quantity" id="quantity" required>
                          @foreach(['Kg','Liter','Unit','Piece'] as $q) <option value="{{$q}}">{{$q}}</option> @endforeach
                      </select>
                 </div>
             </div>
             
             <div class="mb-3">
                 <input type="radio" name="showPrice" value="1" id="sp1" checked> <label for="sp1" class="me-3">Show Price</label>
                 <input type="radio" name="showPrice" value="0" id="sp0"> <label for="sp0">Hide Price</label>
             </div>
             
             <div class="form-floating mb-3">
                <textarea class="form-control" name="description" id="description" style="height:100px" required></textarea>
                <label>Description</label>
            </div>
            
            <button type="submit" class="btn btn-dark w-100 mb-2" id="btn-save">Save Product</button>
            <button type="button" class="btn btn-danger w-100 d-none" id="btn-delete" onclick="deleteProduct()">Delete Product</button>
        </form>
    </div>
</div>

@push('style')
<style>
    .slider-form { position: fixed; top: 0; right: -100%; width: 100%; height: 100%; background: #fff; z-index: 1060; transition: right 0.3s; overflow-y: auto; box-shadow: -5px 0 15px rgba(0,0,0,0.1); }
    .slider-form.open { right: 0; }
    .slider-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1059; display: none; }
    .dashed-border { border: 2px dashed #ccc; border-radius: 8px; }
    @media(min-width: 768px) { .slider-form { width: 450px; } }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        $('.cat-filter').click(function(){
             $('.cat-filter').removeClass('text-bg-dark').addClass('text-bg-light');
             $(this).removeClass('text-bg-light').addClass('text-bg-dark');
             let id = $(this).data('id');
             if(id=='all') $('.product-item').show();
             else {
                 $('.product-item').hide();
                 $('.product-item[data-cat-id="'+id+'"]').show();
             }
        });
        
        $('#product-form').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $('#btn-save').prop('disabled', true);
            
            $.ajax({
                url: "{{ route('business.product.save') }}",
                method: 'POST',
                data: formData,
                processData: false, contentType: false,
                success: function(resp){
                    if(resp.success) {
                        alert('Saved successfully');
                        location.reload();
                    } else alert('Error saving');
                },
                error: function(xhr){
                    alert('Error: ' + (xhr.responseJSON?.message || 'Error'));
                },
                complete: function() { $('#btn-save').prop('disabled', false); }
            });
        });
    });

    function openSlider() {
        // Reset form
        $('#product-form')[0].reset();
        $('#product-id').val('');
        $('#slider-title').text('Add Product');
        $('#btn-delete').addClass('d-none');
        // Reset images
        for(let i=1;i<=6;i++) {
            $('#preview'+i).addClass('d-none').attr('src', '');
            $('#ph'+i).removeClass('d-none');
        }
        
        $('#product-slider').addClass('open');
        $('#slider-overlay').show();
    }
    
    function closeSlider() {
        $('#product-slider').removeClass('open');
        $('#slider-overlay').hide();
    }
    
    function editProduct(id) {
        $.get("/business/product/"+id, function(resp){
            if(resp.success) {
                let p = resp.product;
                $('#product-id').val(p.id);
                $('#product_name').val(p.name);
                $('#brand_name').val(p.brand_name);
                $('#category').val(p.category_id);
                $('#product_tag').val(p.product_tag);
                $('#price').val(p.price);
                $('#quantity').val(p.quantity);
                $('#description').val(p.description);
                $('input[name="showPrice"][value="'+(p.show_price?1:0)+'"]').prop('checked', true);
                
                $('#slider-title').text('Edit Product');
                $('#btn-delete').removeClass('d-none');
                
                // Reset images first
                for(let i=1;i<=6;i++) {
                    $('#preview'+i).addClass('d-none').attr('src', '');
                    $('#ph'+i).removeClass('d-none');
                }
                
                if(p.images) {
                    p.images.forEach(img => {
                       let order = img.order || 1; 
                       // Logic relies on strict 1-6 ordering. If order missing, might need mapping.
                       // DB has 'order' column.
                       if(order >=1 && order <=6) {
                           $('#preview'+order).removeClass('d-none').attr('src', '/storage/'+img.path);
                           $('#ph'+order).addClass('d-none');
                       }
                    });
                }
                
                $('#product-slider').addClass('open');
                $('#slider-overlay').show();
            }
        });
    }
    
    function deleteProduct() {
        let id = $('#product-id').val();
        if(!id || !confirm('Are you sure?')) return;
        
        $.post("/business/product/delete/"+id, {_token: "{{ csrf_token() }}"}, function(resp){
            if(resp.success) {
                alert('Deleted');
                location.reload();
            } else alert('Error');
        });
    }
    
    function preview(input, i) {
        if(input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#preview'+i).attr('src', e.target.result).removeClass('d-none');
                $('#ph'+i).addClass('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

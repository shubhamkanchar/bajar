<div class="slider-form">
    <div class="slider-content">
        <div class="row">
            <div class="col-md-8">
                <p class="fw-bold fs-3">Add Product</p>
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
                <div class="col-md-5 mb-3">
                    <div class="dashed-border ratio ratio-1x1">
                        <span class="text-center" style="top: 35%">
                            <i class="fa-regular fa-square-plus fs-1 text-secondary"></i>
                            <div>Add Product</div>
                        </span>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="dashed-border ratio ratio-1x1">
                                <i
                                    class="fa-regular d-flex fa-square-plus fs-1 text-secondary justify-content-center align-items-center"></i>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="dashed-border ratio ratio-1x1">
                                <i
                                    class="fa-regular d-flex fa-square-plus fs-1 text-secondary justify-content-center align-items-center"></i>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="dashed-border ratio ratio-1x1">
                                <i
                                    class="fa-regular d-flex fa-square-plus fs-1 text-secondary justify-content-center align-items-center"></i>
                            </div>
                        </div>
                        {{-- </div>
                    <div class="row mt-4"> --}}
                        <div class="col-md-4 mb-3">
                            <div class="dashed-border ratio ratio-1x1">
                                <i
                                    class="fa-regular d-flex fa-square-plus fs-1 text-secondary justify-content-center align-items-center"></i>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="dashed-border ratio ratio-1x1">
                                <i
                                    class="fa-regular d-flex fa-square-plus fs-1 text-secondary justify-content-center align-items-center"></i>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="dashed-border ratio ratio-1x1">
                                <i class="fa-regular d-flex fa-square-plus fs-1 text-secondary justify-content-center align-items-center"></i>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-2 mt-2">
                        <input type="text" name="work_brief" class="form-control" id="workBrief"
                            placeholder="Work Brief">
                        <label for="name">Work Brief</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-2 mt-2">
                        <select class="form-select" id="serviceCategory"
                            aria-label="Floating label select example">
                            <option selected>Service Category</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="serviceCategory">Service Category</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-2 mt-2">
                        <select class="form-select" id="serviceTag" name="service_tag"
                            aria-label="Floating label select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="serviceTag">Service Tag</label>
                    </div>
                </div>
                <div class="col-12">
                    <textarea class="form-control mt-3 mb-3" placeholder="Product Description" line="5"></textarea>
                </div>
                <div class="col-md-12 mt-4">
                    <p>*Your work will be under review for the initial 24 hours before it’s live</p>
                    <div class="row">
                        <div class="col-md-5 mt-2 mb-2">
                            <button type="submit" class="btn btn-dark w-100">Add Work</button>
                        </div>
                        <div class="col-md-5 mt-2 mb-2">

                            <button type="submit" class="btn btn-default bg-custom-secondary">
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
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
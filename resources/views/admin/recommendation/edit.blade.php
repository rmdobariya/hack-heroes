@extends('admin.layouts2.simple.master')
@section('title')
    Edit Recommendation
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Edit Recommendation'])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-body pt-0">
                        <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="edit_value" value="{{$recommendation->id}}" name="edit_value">

                                <input type="hidden" id="form-method" value="add">

                                <div class="row">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="required fs-6 fw-bold mb-2" for="recommendation_type">
                                            Recommendation Type
                                        </label>
                                        <input type="text" class="form-control form-control-solid" required
                                               name="recommendation_type"
                                               id="recommendation_type"
                                               value="{{$recommendation->recommendation_type}}"
                                               placeholder="Recommendation Type"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="required fs-6 fw-bold mb-2" for="title_for_recommendation">
                                            Title for recommendation
                                        </label>
                                        <input type="text" class="form-control form-control-solid" required
                                               name="title_for_recommendation"
                                               id="title_for_recommendation"
                                               value="{{$recommendation->title_for_recommendation}}"
                                               placeholder="Title For Recommendation"/>
                                    </div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="form-label">Subtext for recommendation</label>
                                    <textarea class="form-control" name="sub_text_for_recommendation"
                                              id="sub_text_for_recommendation">{{$recommendation->sub_text_for_recommendation}}</textarea>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="form-label">Recommendation</label>
                                    <textarea class="form-control" name="recommendation"
                                              id="recommendation">{{$recommendation->recommendation}}</textarea>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="form-label">Tags for associated risk
                                        (separated by semi-colons)</label>
                                    <textarea class="form-control" name="tags_for_associated_risk"
                                              id="tags_for_associated_risk">{{$recommendation->tags_for_associated_risk}}</textarea>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="form-label">Reasoning
                                        (separated by semi-colons)</label>
                                    <textarea class="form-control" name="reasoning"
                                              id="reasoning">{{$recommendation->reasoning}}</textarea>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="form-label">Tags for age appropriateness
                                        (separated by semi-colons)</label>
                                    <textarea class="form-control" name="tags_for_age_appropriateness"
                                              id="tags_for_age_appropriateness" readonly>{{$recommendation->tags_for_age_appropriateness}}</textarea>
                                </div>

                                <div class="row">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold mb-2" for="tag_for_frequency">
                                            Tag for frequency
                                        </label>
                                        <input type="text" class="form-control form-control-solid"
                                               name="tag_for_frequency"
                                               id="tag_for_frequency"
                                               value="{{$recommendation->tag_for_frequency}}"
                                               placeholder="Tag for frequency" readonly/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold mb-2" for="tag_if_affiliate">
                                            Tag if affiliate
                                        </label>
                                        <input type="text" class="form-control form-control-solid"
                                               name="tag_if_affiliate"
                                               id="tag_if_affiliate"
                                               value="{{$recommendation->tag_if_affiliate}}"
                                               placeholder="Tag for frequency" readonly/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="fs-6 fw-bold mb-2" for="tag_if_resource">
                                            Tag if resource
                                        </label>
                                        <input type="text" class="form-control form-control-solid"
                                               name="tag_if_resource"
                                               id="tag_if_resource"
                                               value="{{$recommendation->tag_if_resource}}"
                                               placeholder="Tag if resource" readonly/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="required fs-6 fw-bold mb-2" for="tags_for_visual_grouping">
                                            Tags for visual grouping
                                            (separated by semi-colons)
                                        </label>
                                        <input type="text" class="form-control form-control-solid" required
                                               name="tags_for_visual_grouping"
                                               id="tags_for_visual_grouping"
                                               value="{{$recommendation->tags_for_visual_grouping}}"
                                               placeholder="Tags for visual grouping
                                               (separated by semi-colons)" readonly/>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="fs-6 fw-bold mb-2" for="image">
                                        Image
                                    </label>
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        @include('admin.layouts2.components.image-selection',
                               [
                               'id'=>'image',
                               'description_string'=>'Image Thumbnail Description',
                               'image'=>asset($recommendation->image)
                               ])
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label class="fs-6 fw-bold mb-2" for="pdf">
                                            Attach PDF
                                        </label>
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <input type="file" name="pdf" id="pdf">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div>
                                            @if($recommendation->pdf)
                                                <a href="{{asset($recommendation->pdf)}}">Link Uploaded</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                                <a href="{{ route('admin.recommendation.index') }}">
                                    <button class="btn btn-secondary" type="button">
                                        Cancel
                                    </button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var form_url = '/recommendation'
        var redirect_url = '/recommendation'
    </script>
    <script src="{{URL::asset('assets/admin/custom/recommendation/recommendation.js')}}?v={{ time() }}"></script>
@endsection

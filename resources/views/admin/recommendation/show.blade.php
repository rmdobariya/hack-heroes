@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Recommendation Detail'])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Details</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="fw-semibold">
                                <tr>
                                    <th class="fw-bold" scope="row">Recommendation Type</th>
                                    <td>{{ $recommendation->recommendation_type }}</td>
                                </tr>

                                <tr>
                                    <th class="fw-bold" scope="row">Title For Recommendation</th>
                                    <td>{{ $recommendation->title_for_recommendation }}</td>
                                </tr>

                                <tr>
                                    <th class="fw-bold" scope="row">Subtext for recommendation</th>
                                    <td>{{ $recommendation->sub_text_for_recommendation }}</td>
                                </tr>

                                <tr>
                                    <th class="fw-bold" scope="row">Recommendation</th>
                                    <td>{{ $recommendation->recommendation }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">"Tags for associated risk
                                        (separated by semi-colons)"
                                    </th>
                                    <td>{{ $recommendation->tags_for_associated_risk }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">"Reasoning
                                        (separated by semi-colons)"
                                    </th>
                                    <td>{{ $recommendation->reasoning }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">"Tags for age appropriateness
                                        (separated by semi-colons)"
                                    </th>
                                    <td>{{ $recommendation->tags_for_age_appropriateness }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Tag for frequency</th>
                                    <td>{{ $recommendation->tag_for_frequency }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Tag if affiliate</th>
                                    <td>{{ $recommendation->tag_if_affiliate }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Tag if resource</th>
                                    <td>{{ $recommendation->tag_if_resource }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">"Tags for visual grouping
                                        (separated by semi-colons)"
                                    </th>
                                    <td>{{ $recommendation->tags_for_visual_grouping }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')

@endsection

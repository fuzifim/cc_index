@extends('inc.master')
@section('seo')
<?php 
	$data_seo = array(
		'title' => 'Cài đặt hình ảnh kênh',
		'keywords' => config('app.keywords_default'),
		'description' => config('app.description_default'),
		'og_title' => 'Cài đặt hình ảnh kênh',
		'og_description' => config('app.description_default'),
		'og_url' => Request::url(),
		'og_sitename' => config('app.appname'),
		'og_img' => '',
		'current_url' => Request::url()
	);
	$seo = WebService::getSEO($data_seo); 
?>
@include('partials.seo')
@endsection
@section('content')
    <div id="page-content-wrapper" class="page_content_primary clear ">
        <div class="container-fluid entry_container xyz">
            <div class="row no-gutter mrb-5 country_option">
                <div class="col-lg-12">
                    <div class="breadcrumbs_inc clear">
						<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                            <li class="dropdown hidden-xs" itemprop="itemListElement">
                                 <a href="{{route('home')}}" itemprop="item"><span itemprop="name"><i class="glyphicon glyphicon-home"></i> <span class="hidden-xs">Trang chủ</span></span></a>
                            </li>
							<li class="dropdown active" itemprop="itemListElement"><a data-toggle="dropdown" itemprop="item" href=""><span class="glyphicon glyphicon-cog"></span> Bảng điều khiển</a> <span class="caret"></span>
								@include('partials.menu_dropdown_dashboard')
							</li>
                            <li class="dropdown" itemprop="itemListElement">
								<a data-toggle="dropdown" href="{{route('user.templateType.setting',array($temp_set->id,'image'))}}" itemprop="item"><span itemprop="name"><i class="glyphicon glyphicon-picture"></i> Cài đặt hình ảnh</span></a>
								<span class="caret"></span>
								@include('partials.menu_dropdown_setting_channel')
                            </li>
						</ol>
                    </div>
                </div>
            </div>
            <div class="theme_setting_user clear" >
                <div class="row no-gutter">
                    <div id="post-fanpage" class="col-lg-12 col-md-12 col-xs-12">
                        <div class="panel">
                            <div class="panel-body">
                                @include('partials.message')
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Thông báo!</strong> Có lỗi xảy ra.<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                            <div id="post-form-container" class="col-sm-12 col-md-12 col-lg-12 template_setting_website">
                              <form id="post-about-form" action="{{ route('user.templateType.setting',array($temp_set->id,'general'))}}" method="post" accept-charset="utf-8" role="form" class="form-horizontal theme_setting_form" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                    <input type="hidden" name="id_template" value="{{$id_template}}" >
                                    <div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<div id="crop-logo-web">
													<label class="control-label" for="item-title">Ảnh đại diện: </label>
													<div class="avatar-view-image" id="user-logo" data-original-title="" title="">
														@if($temp_set->logo !='')
															<img id="user-logo-image" class="avanta_defaul img-responsive img-thumbnail" src="{{ asset($temp_set->logo) }}" alt="logo-website" />
														@else
															<img alt="logo-website" id="user-logo-image" class="avanta_defaul img-responsive img-thumbnail" src="http://placehold.it/300x300&amp;text=LOGO-WEBSITE">
														@endif
														<span class="avatar-change"><i class="fa fa-image"></i> Chọn ảnh</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-9">
											<div class="form-group">
													<label class="control-label" for="">Ảnh bìa <span class="text-danger">(*)</span></label>
													@include('include.upload-template-setting')
											</div>
										</div>
									</div>
                              </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/bootstrap-formhelpers.js') }}"></script>
<link type="text/css" href="{{asset('css/bootstrap-formhelpers.min.css')}}" rel="stylesheet"/>
@endsection
<?
	$channel['theme']->setTitle('Thông tin kênh');
	$channel['theme']->setKeywords('Thông tin kênh');
	$channel['theme']->setDescription('Cài đặt thông tin cho kênh Cung Cấp của bạn. '); 
	if(!empty($channel['info']->channelAttributeBanner[0]->media->media_name)){$channel['theme']->setImage(config('app.link_media').$channel['info']->channelAttributeBanner[0]->media->media_path.'thumb/'.$channel['info']->channelAttributeBanner[0]->media->media_name);} 
?>
{!!Theme::asset()->container('footer')->usePath()->add('jquery', 'js/jquery-1.11.1.min.js', array('core-script'))!!}
{!!Theme::asset()->container('footer')->usePath()->add('jquery-migrate', 'js/jquery-migrate-1.2.1.min.js', array('core-script'))!!}
{!!Theme::asset()->container('footer')->usePath()->add('bootstrap', 'js/bootstrap.min.js', array('core-script'))!!}
{!!Theme::asset()->container('footer')->usePath()->add('modernizr', 'js/modernizr.min.js', array('core-script'))!!}
{!!Theme::asset()->container('footer')->usePath()->add('toggles', 'js/toggles.min.js', array('core-script'))!!}
{!!Theme::asset()->container('footer')->usePath()->add('jquery.cookies', 'js/jquery.cookies.js', array('core-script'))!!}

<section>
{!!Theme::partial('leftpanel', array('title' => 'Header'))!!}
<div class="mainpanel">
{!!Theme::partial('headerbar', array('title' => 'Header'))!!}
	<div class="pageheader">
		<h1>{!! Theme::get('title') !!}</h1>
		<span><small>{!! Theme::get('description') !!}</small></span>
	</div>
	<div class="contentpanel">
		@if($channel['info']->channel_parent_id==0)
			@if(Auth::user()->user_status=='active')
				{!!Theme::asset()->container('footer')->usePath()->add('bootstrap-wizard', 'js/bootstrap-wizard.min.js', array('core-script'))!!}
				{!!Theme::asset()->container('footer')->usePath()->add('select2.min', 'js/select2.min.js', array('core-script'))!!}
				{!!Theme::asset()->container('footer')->usePath()->add('jquery.validate.min', 'js/jquery.validate.min.js', array('core-script'))!!}
				<div class="row-pad-5">
					<div class="panel panel-default formRegisterChannel">
						<div class="panel-body">
							<form class="form" id="form1" method="post" action="{{route('channel.create.request',$channel['domain']->domain)}}">
								<?
									if(Session::has('channelAdd')){
										$sessionChannel=Session::get('channelAdd'); 
									}
								?>
								<div class="form-group">
									<div class="col-sm-12">
									  <input type="text" id="channelName" name="channelName" value="@if(!empty($sessionChannel['channelName'])){!!$sessionChannel['channelName']!!}@endif" class="form-control" placeholder="Tên website Vd: Cung cấp đậu phộng" required />
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
									  <input type="text" name="channelDescription" value="@if(!empty($sessionChannel['channelDescription'])){!!$sessionChannel['channelDescription']!!}@endif" class="form-control" placeholder="Mô tả website, cửa hàng..." required />
									</div>
								</div>
								<div class="form-group">
								  <div class="col-sm-12">
									<div class="addFields"></div>
								  </div>
								</div>
								<div class="form-group">
									<div class="col-sm-6">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
											<input type="email" class="form-control" name="channelEmail" value="@if(!empty($sessionChannel['channelEmail'])){!!$sessionChannel['channelEmail']!!}@else{{Auth::user()->email}}@endif" placeholder="Địa chỉ email..." required>
										</div>
										<label class="error" for="channelEmail"></label>
										<div class="mb10"></div>
									</div>
									<div class="col-sm-6">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-phone"></i></span>
											<input type="phone" class="form-control" name="channelPhone" value="@if(!empty($sessionChannel['channelPhone'])){!!$sessionChannel['channelPhone']!!}@else{{Auth::user()->phone}}@endif" placeholder="Số điện thoại..." required>
										</div>
										<label class="error" for="channelPhone"></label>
										<div class="mb10"></div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											<input type="text" name="channelAddress" value="@if(!empty($sessionChannel['channelAddress'])){!!$sessionChannel['channelAddress']!!}@endif" class="form-control" placeholder="Địa chỉ đường, số nhà công ty, cửa hàng..." required />
										</div>
										<label class="error" for="channelAddress"></label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-6">
										<input type="hidden" name="idRegion" value="@if(!empty($sessionChannel['channelRegion'])){!!$sessionChannel['channelRegion']!!}@else{{$channel['info']->channelJoinRegion->region->id}}@endif">
										<input type="hidden" name="regionIso" value="{{mb_strtolower($channel['info']->channelJoinRegion->region->iso)}}">
										<div class="addSelectRegion"></div>
										<div class="mb10"></div>
									</div>
									<div class="col-sm-6">
										<input type="hidden" name="idSubRegion" value="@if(!empty($sessionChannel['channelSubRegion'])){!!$sessionChannel['channelSubRegion']!!}@else{{$channel['info']->channelJoinSubRegion->subregion->id}}@endif">
										<div class="addSelectSubRegion"></div>
										<div class="mb10"></div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-6">
										<input type="hidden" name="idDistrict" value="">
										<div class="addSelectDistrict"></div>
										<div class="mb10"></div>
									</div>
									<div class="col-sm-6">
										<input type="hidden" name="idWard" value="">
										<div class="addSelectWard"></div>
										<div class="mb10"></div>
									</div>
								</div>
							</form>
						</div><!-- panel-body -->
						<div class="panel-footer text-right">
							<a class="btn btn-default" href="{{route('channel.add',$channel['domainPrimary'])}}"><i class="fa fa-step-backward"></i> Quay lại</a> <button type="button" id="registerChannel" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Đăng ký</button>
						</div>
					</div><!-- panel -->
					<?
					$dependencies = array(); 
					$channel['theme']->asset()->writeScript('custom',' 
					function getPackge(){
						$.ajax({
							url: "'.route('channel.packge.json',$channel['domainPrimary']).'",
							type: "GET",
							dataType: "json",
							success: function (result) {
								$.each(JSON.parse(result.data), function(i, item) {
									if(item.id==26){
										$(".appendPackge").append("<div class=\"col-lg-4 col-md-4 col-sm-6 col-xs-12\">"
										+"<div class=\"form-group\">"
											+"<div class=\"list-group-item text-center active btn packgeCheck\">"
												+"<h4 class=\"list-group-item-heading\">"+item.name+"</h4>"
												+"<div class=\"list-group-item-text\">"
													+"<p>Phí Đăng ký: <strong>"+(parseInt(item.price_re_order)+parseInt(item.price_order)).toLocaleString()+"<sup>đ</sup></strong>/ năm</p>"
													+"<p>Phí Duy trì: <strong>"+parseInt(item.price_re_order).toLocaleString()+"<sup>đ</sup></strong>/ năm</p>"
													+"<p><i class=\"glyphicon glyphicon-cloud\"></i> "+parseInt($.parseJSON(item.attribute_value).limit_cloud).toLocaleString()+" MB</p>"
													+"<p><i class=\"glyphicon glyphicon-check\"></i> "+parseInt($.parseJSON(item.attribute_value).limit_post).toLocaleString()+" Bài viết</p>"
												+"</div>"
												+"<input type=\"radio\" class=\"hidden\" value=\""+item.id+"\" name=\"channelPackge\" checked>"
											+"</div>"
										+"</div>"
									+"</div>"); 
									}else{
										$(".appendPackge").append("<div class=\"col-lg-4 col-md-4 col-sm-6 col-xs-12\">"
										+"<div class=\"form-group\">"
											+"<div class=\"list-group-item text-center btn packgeCheck\">"
												+"<h4 class=\"list-group-item-heading\">"+item.name+"</h4>"
												+"<div class=\"list-group-item-text\">"
													+"<p>Phí Đăng ký: <strong>"+(parseInt(item.price_re_order)+parseInt(item.price_order)).toLocaleString()+"<sup>đ</sup></strong>/ năm</p>"
													+"<p>Phí Duy trì: <strong>"+parseInt(item.price_re_order).toLocaleString()+"<sup>đ</sup></strong>/ năm</p>"
													+"<p><i class=\"glyphicon glyphicon-cloud\"></i> "+parseInt($.parseJSON(item.attribute_value).limit_cloud).toLocaleString()+" MB</p>"
													+"<p><i class=\"glyphicon glyphicon-check\"></i> "+parseInt($.parseJSON(item.attribute_value).limit_post).toLocaleString()+" Bài viết</p>"
												+"</div>"
												+"<input type=\"radio\" class=\"hidden\" value=\""+item.id+"\" name=\"channelPackge\">"
											+"</div>"
										+"</div>"
									+"</div>"); 
									}
								}); 
							}
						});
					}
					getPackge(); 
					$(".appendPackge").on("click",".packgeCheck",function() {
						$(".appendPackge .packgeCheck").not(this).removeClass("active"); 
						$(".appendPackge .packgeCheck").not(this).find("input").prop("checked",false);
						$(this).addClass("active");
						$(this).find("input").prop("checked",true);
					}); 
					getFields(); 
					getRegions(); 
					$(".addSelectRegion").on("change",".selectRegion",function() {
						getSubregion($(this).val()); 
						getDistrict(0); 
						getWard(0); 
						$("input[name=regionIso]").val($(this).find("option:selected").attr("data-iso")); 
						$("input[name=idRegion]").val($(this).val()); 
						$("input[name=idSubRegion]").val(0); 
						$("input[name=idDistrict]").val(0); 
					});
					$(".addSelectSubRegion").on("change",".selectSubRegion",function() {
						getDistrict($(this).val()); 
						getWard(0);
						$("input[name=idSubRegion]").val($(this).val()); 
						$("input[name=idDistrict]").val(0); 
					});
					$(".addSelectDistrict").on("change",".selectDistrict",function() {
						getWard($(this).val()); 
						$("input[name=idDistrict]").val($(this).val()); 
						$("input[name=idWard]").val(0); 
					});
					$(".addSelectWard").on("change",".selectWard",function() {
						$("input[name=idWard]").val($(this).val()); 
					});
					function getFields(){
						$(".addFields").append("<div class=\"loading\"><small><i class=\"fa fa-spinner fa-spin\"></i> đang tải lĩnh vực, vui lòng chờ...</small></div>"); 
						$.ajax({
							url: "'.route('channel.json.fields',$channel['domainPrimary']).'",
							type: "GET",
							dataType: "json",
							success: function (result) {
								$(".addFields .loading").empty(); 
								$(".addFields").append("<select class=\"selectField\" data-placeholder=\"Chọn lĩnh vực hoạt động...\" name=\"channelFields\" multiple required>"
									+"<option value=\"\"></option></select><label class=\"error\" for=\"channelFields\"></label>"); 
								$.each(result.fields, function(i, item) {
									$(".addFields .selectField").append("<option value="+item.id+">"+item.name+"</option>");
								}); 
								jQuery(".addFields .selectField").select2({
									width: "100%"
								});
							}
						});
					}
					function getRegions(){
						$(".addSelectRegion").append("<div class=\"loading\"><small><i class=\"fa fa-spinner fa-spin\"></i> đang tải quốc gia, vui lòng chờ...</small></div>"); 
						$.ajax({
							url: "'.route("regions.json.list",$channel["domainPrimary"]).'",
							type: "GET",
							dataType: "json",
							success: function (result) {
								$(".addSelectRegion .loading").empty(); 
								if(result.success==true){
									getSubregion($("input[name=idRegion]").val()); 
									$(".addSelectRegion").append("<div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"flag flag-"+$("input[name=regionIso]").val()+"\"></i></span><select class=\"selectRegion\" data-placeholder=\"Chọn quốc gia...\" name=\"channelRegion\" required>"
									+"<option value=\"\"></option></select></div><label class=\"error\" for=\"channelRegion\"></label>"); 
									$.each(result.region, function(i, item) {
										if(item.id==$("input[name=idRegion]").val()){
											$(".addSelectRegion .selectRegion").append("<option value="+item.id+" data-icon=\"flag-"+item.iso.toLowerCase()+"\"  data-iso="+item.iso.toLowerCase()+" selected>"+item.country+"</option>");
										}else{
											$(".addSelectRegion .selectRegion").append("<option value="+item.id+"  data-icon=\"flag-"+item.iso.toLowerCase()+"\"  data-iso="+item.iso.toLowerCase()+" >"+item.country+"</option>");
										}
									}); 
									function format(icon) {
										var originalOption = icon.element;
										return "<i class=\"flag " + $(originalOption).data("icon") + "\"></i> " + icon.text;
									}
									jQuery(".addSelectRegion .selectRegion").select2({
										width: "100%",
										formatResult: format
									});
								}else{
									
								}
							}
						});
					} 
					function getSubregion(idRegion){
						$(".addSelectSubRegion").empty(); 
						$(".addSelectSubRegion").append("<div class=\"loading\"><small><i class=\"fa fa-spinner fa-spin\"></i> đang tải thành phố, vui lòng chờ...</small></div>"); 
						var formData = new FormData();
						formData.append("idRegion", idRegion); 
						$.ajax({
							url: "'.route("subregion.json.list.post",$channel["domainPrimary"]).'",
							type: "POST",
							cache: false,
							contentType: false,
							processData: false,
							dataType:"json",
							data:formData,
							headers: {"X-CSRF-TOKEN": $("meta[name=_token]").attr("content")},
							success: function (result) {
								$(".addSelectSubRegion .loading").empty(); 
								$(".addSelectRegion .input-group-addon").html("<i class=\"flag flag-"+$("input[name=regionIso]").val()+"\"></i>"); 
								if(result.success==true){
									getDistrict($("input[name=idSubRegion]").val()); 
									$(".addSelectSubRegion").append("<select class=\"selectSubRegion\" data-placeholder=\"Chọn thành phố...\" name=\"channelSubRegion\">"
									+"<option value=\"\"></option></select><label class=\"error\" for=\"channelSubRegion\"></label>"); 
									$.each(result.subregion, function(i, item) {
										if(item.id==$("input[name=idSubRegion]").val()){
											$(".addSelectSubRegion .selectSubRegion").append("<option value="+item.id+" selected>"+item.subregions_name+"</option>");
										}else{
											$(".addSelectSubRegion .selectSubRegion").append("<option value="+item.id+">"+item.subregions_name+"</option>");
										}
									}); 
									function format(icon) {
										var originalOption = icon.element;
										return "<i class=\"fa fa-map-marker\"></i> " + icon.text;
									}
									jQuery(".addSelectSubRegion .selectSubRegion").select2({
										width: "100%",
										formatResult: format
									});
								}else{
									$(".addSelectSubRegion").empty(); 
								}
							}
						});
					}
					function getDistrict(idSubRegion){
						$(".addSelectDistrict").empty(); 
						$(".addSelectDistrict").append("<div class=\"loading\"><small><i class=\"fa fa-spinner fa-spin\"></i> đang tải quận huyện, vui lòng chờ...</small></div>"); 
						var formData = new FormData();
						formData.append("idSubRegion", idSubRegion); 
						$.ajax({
							url: "'.route("district.json.list.post",$channel["domainPrimary"]).'",
							type: "POST",
							cache: false,
							contentType: false,
							processData: false,
							dataType:"json",
							data:formData,
							headers: {"X-CSRF-TOKEN": $("meta[name=_token]").attr("content")},
							success: function (result) {
								$(".addSelectDistrict .loading").empty(); 
								if(result.success==true){
									getWard($("input[name=idDistrict]").val()); 
									$(".addSelectDistrict").append("<select class=\"selectDistrict\" data-placeholder=\"Chọn quận huyện...\" name=\"channelDistrict\">"
										+"<option value=\"\"></option></select><label class=\"error\" for=\"channelDistrict\"></label>"); 
									$.each(result.district, function(i, item) {
										if(item.id=='.$channel['info']->channelJoinSubRegion->subregion->id.'){
											$(".addSelectDistrict .selectDistrict").append("<option value="+item.id+" selected>"+item.district_name+"</option>");
										}else{
											$(".addSelectDistrict .selectDistrict").append("<option value="+item.id+">"+item.district_name+"</option>");
										}
									}); 
									function format(icon) {
										var originalOption = icon.element;
										return "<i class=\"fa fa-map-marker\"></i> " + icon.text;
									}
									jQuery(".addSelectDistrict .selectDistrict").select2({
										width: "100%",
										formatResult: format
									});
								}else{
									$(".addSelectDistrict").empty(); 
								}
							}
						});
					}
					function getWard(idDistrict){
						$(".addSelectWard").empty(); 
						$(".addSelectWard").append("<div class=\"loading\"><small><i class=\"fa fa-spinner fa-spin\"></i> đang tải phường xã, vui lòng chờ...</small></div>"); 
						var formData = new FormData();
						formData.append("idDistrict", idDistrict); 
						$.ajax({
							url: "'.route("ward.json.list.post",$channel["domainPrimary"]).'",
							type: "POST",
							cache: false,
							contentType: false,
							processData: false,
							dataType:"json",
							data:formData,
							headers: {"X-CSRF-TOKEN": $("meta[name=_token]").attr("content")},
							success: function (result) {
								//console.log(result); 
								$(".addSelectWard .loading").empty(); 
								if(result.success==true){
									$(".addSelectWard").append("<select class=\"selectWard\" data-placeholder=\"Chọn phường xã...\" name=\"channelWard\">"
										+"<option value=\"\"></option></select><label class=\"error\" for=\"channelWard\"></label>"); 
									$.each(result.ward, function(i, item) {
										if(item.id=='.$channel['info']->channelJoinSubRegion->subregion->id.'){
											$(".addSelectWard .selectWard").append("<option value="+item.id+" selected>"+item.ward_name+"</option>");
										}else{
											$(".addSelectWard .selectWard").append("<option value="+item.id+">"+item.ward_name+"</option>");
										}
									}); 
									function format(icon) {
										var originalOption = icon.element;
										return "<i class=\"fa fa-map-marker\"></i> " + icon.text;
									}
									jQuery(".addSelectWard .selectWard").select2({
										width: "100%",
										formatResult: format
									});
								}else{
									$(".addSelectWard").empty(); 
								}
							}
						});
					}
					jQuery(document).ready(function(){
						"use strict";
						// With Form Validation Wizard
						var $validator = jQuery("#form1").validate({
							highlight: function(element) {
							  jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
							},
							success: function(element) {
							  jQuery(element).closest(".form-group").removeClass("has-error");
							}
						});
						$("#registerChannel").on("click", function () {
							var $valid = jQuery("#form1").valid();
							if(!$valid) {
								$validator.focusInvalid();
								return false;
							}else{
								var channelName=$("input[name=channelName]").val(); 
								var channelDescription=$("input[name=channelDescription]").val(); 
								var channelEmail=$("input[name=channelEmail]").val(); 
								var channelPhone=$("input[name=channelPhone]").val(); 
								var channelAddress=$("input[name=channelAddress]").val(); 
								var channelFields=$("select[name=channelFields]").select2("val"); 
								var channelRegion=$("select[name=channelRegion]").select2("val");
								var channelSubRegion=$("select[name=channelSubRegion]").select2("val"); 
								var channelDistrict=$("select[name=channelDistrict]").select2("val");
								var channelWard=$("select[name=channelWard]").select2("val");
								var formData = new FormData();
								formData.append("channelName", channelName); 
								formData.append("channelDescription", channelDescription); 
								formData.append("channelEmail", channelEmail); 
								formData.append("channelPhone", channelPhone); 
								formData.append("channelAddress", channelAddress); 
								formData.append("channelFields", channelFields); 
								formData.append("channelRegion", channelRegion); 
								formData.append("channelSubRegion", channelSubRegion); 
								formData.append("channelDistrict", channelDistrict); 
								formData.append("channelWard", channelWard); 
								$(".formRegisterChannel").append("<div id=\"preloaderInBox\"><div id=\"status\"><i class=\"fa fa-spinner fa-spin\"></i></div></div>"); 
								$.ajax({
									url: "'.route("channel.create.request",$channel["domainPrimary"]).'",
									type: "POST",
									cache: false,
									contentType: false,
									processData: false,
									dataType:"json",
									data:formData,
									headers: {"X-CSRF-TOKEN": $("meta[name=_token]").attr("content")},
									success: function (result) {
										console.log(result); 
										if(result.success==true){
											var formData2 = new FormData();
											formData2.append("cartType", "channelAdd"); 
											$.ajax({
												url: "'.route("create.cart",$channel["domainPrimary"]).'",
												type: "POST",
												cache: false,
												contentType: false,
												processData: false,
												dataType:"json",
												data:formData2,
												headers: {"X-CSRF-TOKEN": $("meta[name=_token]").attr("content")},
												success: function (result) {
													//console.log(result); 
													window.location.href = "'.route("pay.cart",$channel["domainPrimary"]).'";
												}
											});
										}else{
											$(".formRegisterChannel #preloaderInBox").remove(); 
											jQuery.gritter.add({
												title: "Thông báo!",
												text: "Lỗi không thể tạo website, vui lòng thử lại! ", 
												class_name: "growl-danger",
												sticky: false,
												time: ""
											});
										}
									}
								});
							}
						}); 
						jQuery("#validationWizard").bootstrapWizard({
							withVisible:      false,
							tabClass:         "stepwizard",
							onNext: function(tab, navigation, index) {
								var $valid = jQuery("#form1").valid();
								if(!$valid) {
									$validator.focusInvalid();
									return false;
								}else{
									var move = false;
									if(index==1){
										var channelName=$("input[name=channelName]").val(); 
										var channelDescription=$("input[name=channelDescription]").val(); 
										var channelEmail=$("input[name=channelEmail]").val(); 
										var channelPhone=$("input[name=channelPhone]").val(); 
										var channelAddress=$("input[name=channelAddress]").val(); 
										var channelFields=$("select[name=channelFields]").select2("val"); 
										var channelRegion=$("select[name=channelRegion]").select2("val");
										var channelSubRegion=$("select[name=channelSubRegion]").select2("val"); 
										var channelDistrict=$("select[name=channelDistrict]").select2("val");
										var channelWard=$("select[name=channelWard]").select2("val");
										var formData = new FormData();
										formData.append("channelName", channelName); 
										formData.append("channelDescription", channelDescription); 
										formData.append("channelEmail", channelEmail); 
										formData.append("channelPhone", channelPhone); 
										formData.append("channelAddress", channelAddress); 
										formData.append("channelFields", channelFields); 
										formData.append("channelRegion", channelRegion); 
										formData.append("channelSubRegion", channelSubRegion); 
										formData.append("channelDistrict", channelDistrict); 
										formData.append("channelWard", channelWard); 
										$("#validationWizard #preloaderInBox").css("display", "block"); 
										$.ajax({
											url: "'.route("channel.create.request",$channel["domainPrimary"]).'",
											type: "POST",
											cache: false,
											contentType: false,
											processData: false,
											dataType:"json",
											data:formData,
											headers: {"X-CSRF-TOKEN": $("meta[name=_token]").attr("content")},
											success: function (result) {
												console.log(result); 
												if(result.success==true){
													move= true; 
													$("#validationWizard #preloaderInBox").css("display", "none"); 
													$("#validationWizard").bootstrapWizard("show",index); 
													$("html, body").animate({scrollTop: $("#validationWizard").offset().top}, "slow");
												}else{
													$("#validationWizard #preloaderInBox").css("display", "none");  
													move=false; 
												}
											}
										});
									}else if(index==2){
										var formData = new FormData();
										var packgeId=$(".appendPackge input[name=channelPackge]:checked").val(); 
										if(packgeId==1){
											formData.append("packgeSelected", packgeId); 
											$("#validationWizard #preloaderInBox").css("display", "block"); 
											$.ajax({
												url: "'.route("channel.select.packge.request",$channel["domainPrimary"]).'",
												type: "POST",
												cache: false,
												contentType: false,
												processData: false,
												dataType:"json",
												data:formData,
												headers: {"X-CSRF-TOKEN": $("meta[name=_token]").attr("content")},
												success: function (result) {
													//console.log(result); 
													if(result.success==true){
														move= true; 
														var formData2 = new FormData();
														formData2.append("cartType", "channelAdd"); 
														$.ajax({
															url: "'.route("create.cart",$channel["domainPrimary"]).'",
															type: "POST",
															cache: false,
															contentType: false,
															processData: false,
															dataType:"json",
															data:formData2,
															headers: {"X-CSRF-TOKEN": $("meta[name=_token]").attr("content")},
															success: function (result) {
																//console.log(result); 
																if(result.success==true){
																	var formData3 = new FormData();
																	formData3.append("cartId", result.cartId); 
																	$.ajax({
																		url: "'.route("channel.free",$channel["domainPrimary"]).'",
																		type: "POST",
																		cache: false,
																		contentType: false,
																		processData: false,
																		dataType:"json",
																		data:formData3,
																		headers: {"X-CSRF-TOKEN": $("meta[name=_token]").attr("content")},
																		success: function (result) {
																			console.log(result); 
																			if(result.success==true){
																				window.location.href = "'.route("pay.history",$channel["domainPrimary"]).'";
																			}else{
																				jQuery.gritter.add({
																					title: "Thông báo!",
																					text: result.message, 
																					class_name: "growl-danger",
																					sticky: false,
																					time: ""
																				}); 
																				$("#validationWizard #preloaderInBox").css("display", "none");  
																				window.location.href = "'.route("pay.history",$channel["domainPrimary"]).'";
																			}
																			
																		}
																	});
																}else{
																	move=false; 
																}
															}
														});
													}else{
														$("#validationWizard #preloaderInBox").css("display", "none");  
														move=false; 
													}
												}
											});
										}else{
											formData.append("packgeSelected", packgeId); 
											$("#validationWizard #preloaderInBox").css("display", "block"); 
											$.ajax({
												url: "'.route("channel.select.packge.request",$channel["domainPrimary"]).'",
												type: "POST",
												cache: false,
												contentType: false,
												processData: false,
												dataType:"json",
												data:formData,
												headers: {"X-CSRF-TOKEN": $("meta[name=_token]").attr("content")},
												success: function (result) {
													//console.log(result); 
													if(result.success==true){
														move= true; 
														var formData2 = new FormData();
														formData2.append("cartType", "channelAdd"); 
														$.ajax({
															url: "'.route("create.cart",$channel["domainPrimary"]).'",
															type: "POST",
															cache: false,
															contentType: false,
															processData: false,
															dataType:"json",
															data:formData2,
															headers: {"X-CSRF-TOKEN": $("meta[name=_token]").attr("content")},
															success: function (result) {
																//console.log(result); 
																if(result.success==true){
																	window.location.href = "'.route("pay.cart",$channel["domainPrimary"]).'";
																}else{
																	move=false; 
																}
															}
														});
													}else{
														$("#validationWizard #preloaderInBox").css("display", "none");  
														move=false; 
													}
												}
											});
										}
									}
									return move;
								}
							}
						});
					});
					', $dependencies);
				?>
				</div>
			@else
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="alert alert-info fade in nomargin">
							<p>Xin chào <strong>{{Auth::user()->name}}</strong>,</p> 
							<p>Tài khoản của bạn chưa được kích hoạt, vui lòng kích hoạt tài khoản để có thể đăng ký sử dụng website. </p> 
							@if(!empty(Auth::user()->email))
								<p> Truy cập vào địa chỉ Email <strong class="text-danger">{!!Auth::user()->email!!}</strong> để nhận mã kích hoạt. </p> 
							@else
								<p>Tài khoản của bạn chưa cập nhật địa chỉ Email, vui lòng truy cập vào hồ sơ bổ sung địa chỉ Email và gửi yêu cầu mã kích hoạt! </p>
							@endif
							<p>Nếu chưa nhận được thông tin kích hoạt tài khoản, bạn hãy truy cập vào hồ sơ để gửi và nhận mã kích hoạt bằng Email của bạn.</p>
							<p class="text-center"><a href="{{route('channel.profile.info',$channel['domainPrimary'])}}" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-hand-right"></i> vào hồ sơ</a></p>
						</div>
					</div>
				</div>
			@endif
			
		@else
		@endif
	</div>

</div><!-- mainpanel -->
</section>
<?
	$dependencies = array(); 
	$channel['theme']->asset()->writeScript('onload',' 
		var docHeight = jQuery(document).height();
		if(docHeight > jQuery(".mainpanel").height())
		jQuery(".mainpanel").height(docHeight);
	', $dependencies);
?>
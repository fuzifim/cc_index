
jQuery(window).load(function() {
   
   "use strict";
   
   // Page Preloader
   jQuery('#preloader').delay(350).fadeOut(function(){
      jQuery('body').delay(350).css({'overflow':'visible'});
   });
});

jQuery(document).ready(function() {
   
   "use strict"; 
   (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-6369288-1', 'auto');
	  ga('send', 'pageview');

   $(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() >= $('.section-content').height()) {
			var curentPage = parseInt($("#curentPage").val());
			var urlPage=$("#urlPage").val(); 
			var lastPage=parseInt($("#lastPage").val());
			var page_url_int=curentPage+1;
		   if(page_url_int<=lastPage){
				if(page_url_int==lastPage){
					$('#load_item_page').hide();
				}
				$(".curentPage").val(page_url_int);
				var page_url=urlPage+"?page="+page_url_int;
				load_more(page_url);
		   }
		}
	});
	function load_more(page_url,page_url_int){
		//$("#loading-page").hide();
		$.ajax({
			type: "GET",
			url: page_url,
			dataType: "html",
			contentType: "text/html",
			beforeSend: function() {
				$("#loading-page").fadeIn("slow");
			},
			success: function(data) {

				$(data).find(".listItem").ready(function() {
					var content_ajax = $(data).find(".listItem").html();
					$(".listItem").append(content_ajax);
					$("#loading-page").fadeOut("slow"); 
					$(".listItem .lazy").lazy(); 
				});
				//var docHeight = jQuery(document).height();
				//if(docHeight > jQuery('.mainpanel').height())
				//jQuery('.mainpanel').height(docHeight);
			}
		});
	} 
   $(".listItem img.lazy").each(function(){
		$(this).attr("data-src", $(this).attr("src"));
		$(this).attr("src", "http://cungcap.net/themes/control/assets/images/loaders/loader5.gif");
	});
   // Toggle Left Menu
   jQuery('.leftpanel .nav-parent > a').live('click', function() {
      
      var parent = jQuery(this).parent().closest(".nav-parent");
      var sub = parent.find('> ul');
      
      // Dropdown works only when leftpanel is not collapsed
      if(!jQuery('body').hasClass('leftpanel-collapsed')) {
         if(sub.is(':visible')) {
            sub.slideUp(200, function(){
               parent.removeClass('nav-active');
               jQuery('.mainpanel').css({height: ''});
               adjustmainpanelheight();
            });
         } else {
            closeVisibleSubMenu();
            parent.addClass('nav-active');
            sub.slideDown(200, function(){
               adjustmainpanelheight();
            });
         }
      }
      return false;
   });
   jQuery('.leftpanel .nav-parent .children .nav-parent-child > a').live('click', function() {
		var parent = jQuery(this).parent().closest(".nav-parent-child"); 
	    var sub = parent.find('> ul'); 
		// Dropdown works only when leftpanel is not collapsed
      if(!jQuery('body').hasClass('leftpanel-collapsed')) {
         if(sub.is(':visible')) {
            sub.slideUp(200, function(){
				parent.find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
				parent.removeClass('nav-active');
				jQuery('.mainpanel').css({height: ''});
				adjustmainpanelheight();
            });
         } else {
           // closeVisibleSubMenu();
			parent.find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
            parent.addClass('nav-active');
            sub.slideDown(200, function(){
               adjustmainpanelheight();
            });
         }
      }
      return false;
   }); 
   function closeVisibleSubMenu() {
      jQuery('.leftpanel .nav-parent').each(function() {
         var t = jQuery(this);
         if(t.hasClass('nav-active')) {
            t.find('> ul').slideUp(200, function(){
               t.removeClass('nav-active');
            });
         }
      });
   }
   
   function adjustmainpanelheight() {
      // Adjust mainpanel height
     // var docHeight = jQuery(document).height();
      //if(docHeight > jQuery('.mainpanel').height())
         //jQuery('.mainpanel').height(docHeight);
   }
   adjustmainpanelheight();
   
   
   // Tooltip
   jQuery('.tooltips').tooltip({ container: 'body'});
   
   // Popover
   jQuery('.popovers').popover();
   
   // Close Button in Panels
   jQuery('.panel .panel-close').click(function(){
      jQuery(this).closest('.panel').fadeOut(200);
      return false;
   });
   
   // Form Toggles
   jQuery('.toggle').toggles({on: true});
   
   jQuery('.toggle-chat1').toggles({on: false});
   
   var scColor1 = '#428BCA';
   if (jQuery.cookie('change-skin') && jQuery.cookie('change-skin') == 'bluenav') {
      scColor1 = '#fff';
   }
   
   
   // Minimize Button in Panels
   jQuery('.minimize').click(function(){
      var t = jQuery(this);
      var p = t.closest('.panel');
      if(!jQuery(this).hasClass('maximize')) {
         p.find('.panel-body, .panel-footer').slideUp(200);
         t.addClass('maximize');
         t.html('&plus;');
      } else {
         p.find('.panel-body, .panel-footer').slideDown(200);
         t.removeClass('maximize');
         t.html('&minus;');
      }
      return false;
   });
   
   
   // Add class everytime a mouse pointer hover over it
   jQuery('.nav-bracket > li').hover(function(){
      jQuery(this).addClass('nav-hover');
   }, function(){
      jQuery(this).removeClass('nav-hover');
   });
   
   
   // Menu Toggle
   jQuery('.menutoggle').click(function(){
      
      var body = jQuery('body');
      var bodypos = body.css('position');
      
      if(bodypos != 'relative') {
         
         if(!body.hasClass('leftpanel-collapsed')) {
            body.addClass('leftpanel-collapsed');
            jQuery('.nav-bracket ul').attr('style','');
            
            jQuery(this).addClass('menu-collapsed');
            
         } else {
            body.removeClass('leftpanel-collapsed chat-view');
            jQuery('.nav-bracket li.active ul').css({display: 'block'});
            
            jQuery(this).removeClass('menu-collapsed');
            
         }
      } else {
         
         if(body.hasClass('leftpanel-show'))
            body.removeClass('leftpanel-show');
         else
            body.addClass('leftpanel-show');
         
         adjustmainpanelheight();         
      }

   });
   
   // Chat View
   jQuery('#chatview').click(function(){
      
      var body = jQuery('body');
      var bodypos = body.css('position');
      
      if(bodypos != 'relative') {
         
         if(!body.hasClass('chat-view')) {
            body.addClass('leftpanel-collapsed chat-view');
            jQuery('.nav-bracket ul').attr('style','');
            
         } else {
            
            body.removeClass('chat-view');
            
            if(!jQuery('.menutoggle').hasClass('menu-collapsed')) {
               jQuery('body').removeClass('leftpanel-collapsed');
               jQuery('.nav-bracket li.active ul').css({display: 'block'});
            } else {
               
            }
         }
         
      } else {
         
         if(!body.hasClass('chat-relative-view')) {
            
            body.addClass('chat-relative-view');
            body.css({left: ''});
         
         } else {
            body.removeClass('chat-relative-view');   
         }
      }
      
   });
   
   reposition_topnav();
   reposition_searchform();
   
   jQuery(window).resize(function(){
      
      if(jQuery('body').css('position') == 'relative') {

         jQuery('body').removeClass('leftpanel-collapsed chat-view');
         
      } else {
         
         jQuery('body').removeClass('chat-relative-view');         
         jQuery('body').css({left: '', marginRight: ''});
      }
      
      
      reposition_searchform();
      reposition_topnav();
      
   });
   
   
   
   /* This function will reposition search form to the left panel when viewed
    * in screens smaller than 767px and will return to top when viewed higher
    * than 767px
    */ 
   function reposition_searchform() {
      if(jQuery('.searchform').css('position') == 'relative') {
         jQuery('.searchform').insertBefore('.leftpanelinner .formInsertMobile');
      } else {
         jQuery('.searchform').insertBefore('.header-right');
      }
   }
   
   

   /* This function allows top navigation menu to move to left navigation menu
    * when viewed in screens lower than 1024px and will move it back when viewed
    * higher than 1024px
    */
   function reposition_topnav() {
      if(jQuery('.nav-horizontal').length > 0) {
         
         // top navigation move to left nav
         // .nav-horizontal will set position to relative when viewed in screen below 1024
         if(jQuery('.nav-horizontal').css('position') == 'relative') {
                                  
            if(jQuery('.leftpanel .nav-bracket').length == 2) {
               jQuery('.nav-horizontal').insertAfter('.nav-bracket:eq(1)');
            } else {
               // only add to bottom if .nav-horizontal is not yet in the left panel
               if(jQuery('.leftpanel .nav-horizontal').length == 0)
                  jQuery('.nav-horizontal').appendTo('.leftpanelinner');
            }
            
            jQuery('.nav-horizontal').css({display: 'block'})
                                  .addClass('nav-pills nav-stacked nav-bracket');
            
            jQuery('.nav-horizontal .children').removeClass('dropdown-menu');
            jQuery('.nav-horizontal > li').each(function() { 
               
               jQuery(this).removeClass('open');
               jQuery(this).find('a').removeAttr('class');
               jQuery(this).find('a').removeAttr('data-toggle');
               
            });
            
            if(jQuery('.nav-horizontal li:last-child').has('form')) {
               jQuery('.nav-horizontal li:last-child form').addClass('searchform').appendTo('.topnav');
               jQuery('.nav-horizontal li:last-child').hide();
            }
         
         } else {
            // move nav only when .nav-horizontal is currently from leftpanel
            // that is viewed from screen size above 1024
            if(jQuery('.leftpanel .nav-horizontal').length > 0) {
               
               jQuery('.nav-horizontal').removeClass('nav-pills nav-stacked nav-bracket')
                                        .appendTo('.topnav');
               jQuery('.nav-horizontal .children').addClass('dropdown-menu').removeAttr('style');
               jQuery('.nav-horizontal li:last-child').show();
               jQuery('.searchform').removeClass('searchform').appendTo('.nav-horizontal li:last-child .dropdown-menu');
               jQuery('.nav-horizontal > li > a').each(function() {
                  
                  jQuery(this).parent().removeClass('nav-active');
                  
                  if(jQuery(this).parent().find('.dropdown-menu').length > 0) {
                     jQuery(this).attr('class','dropdown-toggle');
                     jQuery(this).attr('data-toggle','dropdown');  
                  }
                  
               });              
            }
            
         }
         
      }
   }
   
   
   // Sticky Header
   if(jQuery.cookie('sticky-header'))
      jQuery('body').addClass('stickyheader');
      
   // Sticky Left Panel
   if(jQuery.cookie('sticky-leftpanel')) {
      jQuery('body').addClass('stickyheader');
      jQuery('.leftpanel').addClass('sticky-leftpanel');
   }
   
   // Left Panel Collapsed
   if(jQuery.cookie('leftpanel-collapsed')) {
      jQuery('body').addClass('leftpanel-collapsed');
      jQuery('.menutoggle').addClass('menu-collapsed');
   }
   
   // Changing Skin
   var c = jQuery.cookie('change-skin');
   var cssSkin = 'css/style.'+c+'.css';
   if (jQuery('body').css('direction') == 'rtl') {
      cssSkin = '../css/style.'+c+'.css';
      jQuery('html').addClass('rtl');
   }
   if(c) {
      jQuery('head').append('<link id="skinswitch" rel="stylesheet" href="'+cssSkin+'" />');
   }
   
   // Changing Font
   var fnt = jQuery.cookie('change-font');
   if(fnt) {
      jQuery('head').append('<link id="fontswitch" rel="stylesheet" href="css/font.'+fnt+'.css" />');
   }
   
   // Check if leftpanel is collapsed
   if(jQuery('body').hasClass('leftpanel-collapsed'))
      jQuery('.nav-bracket .children').css({display: ''});
      
     
   // Handles form inside of dropdown 
   jQuery('.dropdown-menu').find('form').click(function (e) {
      e.stopPropagation();
   });
   
   
   // This is not actually changing color of btn-primary
   // This is like you are changing it to use btn-orange instead of btn-primary
   // This is for demo purposes only
   var c = jQuery.cookie('change-skin');
   if (c && c == 'greyjoy') {
      $('.btn-primary').removeClass('btn-primary').addClass('btn-orange');
      $('.rdio-primary').addClass('rdio-default').removeClass('rdio-primary');
      $('.text-primary').removeClass('text-primary').addClass('text-orange');
   }
    
	 
	$("#load_item_page").delegate(".click-more","click", function() {
		var curentPage = parseInt($("#curentPage").val());
		var urlPage=$("#urlPage").val(); 
		var lastPage=parseInt($("#lastPage").val());
		var page_url_int=curentPage+1;
		$("#loading-page").hide();
		if(page_url_int<=lastPage){
			if(page_url_int==lastPage){
				$('#load_item_page').hide();
			}
			$(".curentPage").val(page_url_int);
			var page_url=urlPage+"?page="+page_url_int;
			load_more(page_url,page_url_int); 
	   } 

	});
	var rootUrl=$('meta[name=root]').attr('content'); 
	getSelect(); 
	$('footer').on("click","#viewSelect",function() {
		showSelect(); 
	}); 
	function getSelect(){
		$('footer .showInfoSelect').empty(); 
		$.ajax({
			url: rootUrl+"/select/get",
			headers: {'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')},
			type: 'GET',
			cache: false,
			dataType:'json',
			success:function(resultGet){
				if(resultGet.success==true){
					if(Object.keys(resultGet.data).length>0){
						$('footer').append('<div class="showInfoSelect">'
							+'<div class="alert alert-success alert-dismissable">'
								+'<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'
								+'<div class="contentInfoSelect"></div>'
							+'</div>'
						+'</div>'); 
						$('footer .showInfoSelect .contentInfoSelect').append('<div class="container"><div class="row"><i class="glyphicon glyphicon-check"></i> Bạn có <strong>'+Object.keys(resultGet.data).length+'</strong> mục đã chọn. <button type="button" class="btn btn-xs btn-primary" id="viewSelect"><i class="glyphicon glyphicon-hand-right"></i> xem</button></div></div>'); 
						Object.keys(resultGet.data).forEach(function(key) {
							console.log(resultGet.data[key]); 
							//$('footer .showInfoSelect .contentInfoSelect').append('<li>'+resultGet.data[key].name+'</li>'); 

						});
					}
				}
			},
			error: function(resultGet) {
			}
		});
	}
	function showSelect(){
		//$('#myModal').modal('hide'); 
		$('#myModal .modal-title').empty(); 
		$('#myModal .modal-body').empty(); 
		$('#myModal .modal-footer').empty(); 
		$.ajax({
			url: rootUrl+"/select/get",
			headers: {'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')},
			type: 'GET',
			cache: false,
			dataType:'json',
			success:function(resultGet){
				if(resultGet.success==true){
					if(Object.keys(resultGet.data).length>0){
						$('#myModal .modal-title').html('<i class="glyphicon glyphicon-check"></i> Bạn có <strong>'+Object.keys(resultGet.data).length+'</strong> mục đã chọn.'); 
						$('#myModal .modal-body').append(''
							+'<div class="row">'
								+'<div class="col-lg-6 col-md-6 sol-sm-12 col-xs-12">'
									+'<div class="form-group listItem"></div>'
								+'</div>'
								+'<div class="col-lg-6 col-md-6 sol-sm-12 col-xs-12">'
									+'<div class="form-group">'
										+'<div class="priceSelect"></div>'
									+'</div>'
									+'<div class="form-group">'
										+'<div class="box-comment" contentEditable="true"  placeholder="Nội dung yêu cầu..."></div>'
									+'</div>'
									+'<small class="text-info"><i>Khi bạn gửi yêu cầu, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất với những mục bạn đã chọn. </i></small>'
								+'</div>'
							+'</div>'
						+''); 
						var i=0; 
						var priceSelect=0; 
						Object.keys(resultGet.data).forEach(function(key) {
							//console.log(resultGet.data[key]); 
							i++; 
							priceSelect+=parseInt(resultGet.data[key].price); 
							$('#myModal .modal-body .listItem').append('<li class="list-group-item"><a href="#" data-dismiss="alert" aria-label="close" class="close deleteSelect" data-id="'+resultGet.data[key].id+'">×</a><strong>'+i+'.</strong> <a href="'+resultGet.data[key].attributes.link+'"><img src="'+resultGet.data[key].attributes.image+'" style="height:20px;"> '+resultGet.data[key].name+'</a> <small><i>('+parseInt(resultGet.data[key].price).toLocaleString()+'<sup>'+resultGet.data[key].attributes.currency+'</sup>)</i></small></li>'); 
							$('#myModal .modal-body .priceSelect').html('<strong>Tổng số tiền: '+priceSelect.toLocaleString()+'<sup>'+resultGet.data[key].attributes.currency+'</sup></strong>'); 

						});
					} 
					$('#myModal .modal-footer').append('<div class="text-right"><button type="button" class="btn btn-success" id="sendSelect"><i class="glyphicon glyphicon-envelope"></i> Gửi yêu cầu</button></div>'); 
					$('#myModal').modal('show'); 
				}else{
					$('#myModal').modal('hide'); 
				}
			},
			error: function(resultGet) {
			}
		});
	}
	$('#myModal .modal-footer').on("click","#sendSelect",function() {
		$('#loading').css('visibility', 'visible'); 
		//$('#myModal').modal('hide'); 
		var cartMessage=$('#myModal .modal-body .box-comment').text(); 
		var formData = new FormData();
		formData.append("cartMessage", cartMessage); 
		$.ajax({
			url: rootUrl+"/select/send",
			headers: {'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')},
			type: 'post',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType:'json',
			success:function(result){
				$('#loading').css('visibility', 'hidden');
				$('#myModal .modal-title').empty(); 
				$('#myModal .modal-body').empty(); 
				$('#myModal .modal-footer').empty(); 
				$('#myModal .modal-body').append(''
					+'<div class="form-group">'
						+'<div class="text-center">Cảm ơn bạn đã gửi yêu cầu đến chúng tôi. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất. </div>'
					+'</div>'
				+''); 
				$('#myModal').delay(30000).fadeOut('slow');
				   setTimeout(function() {
						$("#myModal").modal('hide'); 
						showSelect(); 
						getSelect(); 
				}, 7000);
			},
			error: function(result) {
			}
		}); 
	});
	$('#myModal .modal-body').on("click",".deleteSelect",function() {
		$('#loading').css('visibility', 'visible'); 
		$('#myModal').modal('hide'); 
		var idSelect=$(this).attr('data-id'); 
		var formData = new FormData();
		formData.append("idSelect", idSelect); 
		$.ajax({
			url: rootUrl+"/select/delete",
			headers: {'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')},
			type: 'post',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType:'json',
			success:function(result){
				$('#loading').css('visibility', 'hidden');
				showSelect(); 
				getSelect(); 
			},
			error: function(result) {
			}
		}); 
	});
	$('.postGallery').on("click",".imageShow",function() {
		$('#myModal .modal-title').empty(); 
		$('#myModal .modal-body').empty(); 
		$('#myModal .modal-footer').empty(); 
		if($(this).attr('url-lg')){
			var urlImage=$(this).attr('url-lg'); 
		}else{
			var urlImage=$(this).attr('src'); 
		}
		$("#myModal .modal-body").addClass("nopadding"); 
		$('#myModal .modal-body').append('<div class="text-center"><img class="img-responsive" src="'+urlImage+'"></div>'); 
		$("#myModal .modal-footer").append("<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Đóng</button>"); 
		$('#myModal').modal('show');
	});
	$('.section-content').on("click",".itemSelect",function() {
		$('#myModal .modal-title').empty(); 
		$('#myModal .modal-body').empty(); 
		$('#myModal .modal-footer').empty(); 
		var rootUrl=$('meta[name=root]').attr('content'); 
		var itemId=$(this).attr('data-id'); 
		var formData = new FormData();
		formData.append("itemId", itemId); 
		$.ajax({
			url: rootUrl+"/select/add",
			headers: {'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')},
			type: 'post',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType:'json',
			success:function(result){
				console.log(result); 
				if(result.success==false){
					if(result.error=='login'){
						$('#myModal .modal-title').text('Đăng nhập'); 
						$('#myModal .modal-body').append('<div class="message"></div><div class="form-group"><div class="input-group">'
							+'<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>'
							+'<input placeholder="Email hoặc điện thoại" id="email" name="email" type="text" class="form-control valid" value="" aria-required="true" aria-invalid="false">'
							+'</div></div>'
							+'<div class="form-group">'
								+'<div class="input-group">'
									+'<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>'
									+'<input placeholder="Mật khẩu" id="password" type="password" name="password" class="form-control valid" aria-required="true" aria-invalid="false">'
								+'</div>'
							+'</div>'
							+'<div class="form-group">'
							+'<a href="'+$('meta[name=root]').attr('content')+'/forgotpassword"><i class="glyphicon glyphicon-lock"></i> Quên mật khẩu</a> | <a href="'+$('meta[name=root]').attr('content')+'/register"><i class="glyphicon glyphicon-ok-sign"></i> Đăng ký</a>'
							+'</div>'); 
						$('#myModal .modal-footer').append('<button type="button" id="btnLogin" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Đăng nhập</button>');
						$('#myModal').modal('show');
					}
					
				}else if(result.success==true){
					var rootUrl=$('meta[name=root]').attr('content'); 
					$('footer .showInfoSelect').empty(); 
					$.ajax({
						url: rootUrl+"/select/get",
						headers: {'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')},
						type: 'GET',
						cache: false,
						dataType:'json',
						success:function(resultGet){
							getSelect(); 
						},
						error: function(resultGet) {
						}
					});
				}
			},
			error: function(result) {
			}
		});
	}); 
	$('.section-content').on("click",".likeUp",function() {
		$('#myModal .modal-title').empty(); 
		$('#myModal .modal-body').empty(); 
		$('#myModal .modal-footer').empty(); 
		var rootUrl=$('meta[name=root]').attr('content'); 
		var postId=parseInt($(this).attr('data-id')); 
		var dataLike=parseInt($(this).find('.countLike_'+postId).text()); 
		var formData = new FormData();
		formData.append("postId", postId); 
		formData.append("likeType", 'like'); 
		formData.append("likeTable", 'posts'); 
		$.ajax({
			url: rootUrl+"/likes/add",
			headers: {'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')},
			type: 'post',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType:'json',
			success:function(result){
				console.log(result); 
				if(result.success==false){
					if(result.error=='login'){
						$('#myModal .modal-title').text('Đăng nhập'); 
						$('#myModal .modal-body').append('<div class="message"></div><div class="form-group"><div class="input-group">'
							+'<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>'
							+'<input placeholder="Email hoặc điện thoại" id="email" name="email" type="text" class="form-control valid" value="" aria-required="true" aria-invalid="false">'
							+'</div></div>'
							+'<div class="form-group">'
								+'<div class="input-group">'
									+'<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>'
									+'<input placeholder="Mật khẩu" id="password" type="password" name="password" class="form-control valid" aria-required="true" aria-invalid="false">'
								+'</div>'
							+'</div>'
							+'<div class="form-group">'
							+'<a href="'+rootUrl+'/forgotpassword"><i class="glyphicon glyphicon-lock"></i> Quên mật khẩu</a> | <a href="'+rootUrl+'/register"><i class="glyphicon glyphicon-ok-sign"></i> Đăng ký</a>'
							+'</div>'); 
						$('#myModal .modal-footer').append('<button type="button" id="btnLogin" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Đăng nhập</button>');
						$('#myModal').modal('show');
					}
					
				}else if(result.success==true){
					switch (result.action) {
						case "add":
							$(".countLike_"+postId).text(dataLike+1);
							$(".likeUp_"+postId).addClass('text-success');
							break;
						case "delete":
							 $(".countLike_"+postId).text(dataLike-1); 
							 $(".likeUp_"+postId).removeClass('text-success');
							break;
					}
				}
			},
			error: function(result) {
			}
		});
		return false; 
	});
	$('.section-content').on("click",".likeDown",function() {
		$('#myModal .modal-title').empty(); 
		$('#myModal .modal-body').empty(); 
		$('#myModal .modal-footer').empty(); 
		var rootUrl=$('meta[name=root]').attr('content'); 
		var postId=parseInt($(this).attr('data-id')); 
		var dataLike=parseInt($(this).find('.countLikeDown_'+postId).text()); 
		var formData = new FormData();
		formData.append("postId", postId); 
		formData.append("likeType", 'unlike'); 
		formData.append("likeTable", 'posts'); 
		$.ajax({
			url: rootUrl+"/likes/add",
			headers: {'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')},
			type: 'post',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType:'json',
			success:function(result){
				console.log(result); 
				if(result.success==false){
					if(result.error=='login'){
						$('#myModal .modal-title').text('Đăng nhập'); 
						$('#myModal .modal-body').append('<div class="message"></div><div class="form-group"><div class="input-group">'
							+'<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>'
							+'<input placeholder="Email hoặc điện thoại" id="email" name="email" type="text" class="form-control valid" value="" aria-required="true" aria-invalid="false">'
							+'</div></div>'
							+'<div class="form-group">'
								+'<div class="input-group">'
									+'<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>'
									+'<input placeholder="Mật khẩu" id="password" type="password" name="password" class="form-control valid" aria-required="true" aria-invalid="false">'
								+'</div>'
							+'</div>'
							+'<div class="form-group">'
							+'<a href="'+rootUrl+'/forgotpassword"><i class="glyphicon glyphicon-lock"></i> Quên mật khẩu</a> | <a href="'+rootUrl+'/register"><i class="glyphicon glyphicon-ok-sign"></i> Đăng ký</a>'
							+'</div>'); 
						$('#myModal .modal-footer').append('<button type="button" id="btnLogin" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Đăng nhập</button>');
						$('#myModal').modal('show');
					}
					
				}else if(result.success==true){
					switch (result.action) {
                    case "add":
                        $(".countLikeDown_"+postId).text(dataLike+1);
						$(".likeDown_"+postId).addClass('text-danger');
                        break;
                    case "delete":
                         $(".countLikeDown_"+postId).text(dataLike-1); 
						 $(".likeDown_"+postId).removeClass('text-danger');
                        break;
                }
				}
			},
			error: function(result) {
			}
		});
	});
	$('.section-content').on("click",".itemBuyNow",function() {
		var rootUrl=$('meta[name=root]').attr('content'); 
		var formData = new FormData();
		formData.append("itemId", $(this).attr("data-id")); 
		$.ajax({
			url: rootUrl+"/cart/buy",
			headers: {'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')},
			type: 'post',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType:'json',
			success:function(result){
				//console.log(result); 
				if(result.success==true){
					$('#myModal .modal-title').empty(); 
					$('#myModal .modal-body').empty(); 
					$('#myModal .modal-footer').empty(); 
					$('#myModal .modal-title').text(result.dataBuyNow.itemName); 
					$('#myModal .modal-body').append('<form id="formBuyNow">'
						+'<div class="form-group">'
							+'<div class="input-group">'
								+'<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> '
								+'<input type="text" class="form-control" id="name" name="name" placeholder="Họ tên" value="'+result.dataBuyNow.userName+'" required="">'
							+'</div>'
							+'<label class="error" for="name"></label>'
						+'</div>'
						+'<div class="form-group">'
							+'<div class="input-group">'
								+'<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span> '
								+'<input type="email" class="form-control" id="email" name="email" placeholder="Địa chỉ email" value="'+result.dataBuyNow.userEmail+'" required="">'
							+'</div>'
							+'<label class="error" for="email"></label>'
						+'</div>'
						+'<div class="form-group">'
							+'<div class="input-group">'
								+'<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span> '
								+'<input type="phone" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="'+result.dataBuyNow.userPhone+'" required="">'
							+'</div>'
							+'<label class="error" for="phone"></label>'
						+'</div>'
						+'<div class="form-group">'
							+'<div class="input-group">'
								+'<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span> '
								+'<input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ nhận hàng" value="'+result.dataBuyNow.userAddress+'" required="">'
							+'</div>'
							+'<label class="error" for="address"></label>'
						+'</div>'
						+'<div class="form-group">'
							+'<div class="input-group">'
								+'<span class="input-group-addon"><i class="glyphicon glyphicon-shopping-cart"></i></span> '
								+'<input type="number" class="form-control" id="quanlity" name="quanlity" placeholder="Số lượng mua" value="1" required="">'
							+'</div>'
							+'<label class="error" for="quanlity"></label>'
						+'</div>'
						+'<div class="form-group">'
							+'<textarea class="form-control" type="textarea" id="content" name="content" placeholder="Ghi chú..." maxlength="140" rows="2"></textarea>'
							+'<label class="error" for="content"></label>'
						+'</div>'
						+'');	
					$('#myModal .modal-footer').append('<div class="text-right"><button type="submit" class="btn btn-success" id="sendBuyNow"><i class="glyphicon glyphicon-ok"></i> Đặt mua</button></div></form>'); 
					$('#myModal').modal('show'); 
					var $validator = jQuery("#myModal #formBuyNow").validate({
						highlight: function(element) {
						  jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
						},
						success: function(element) {
						  jQuery(element).closest(".form-group").removeClass("has-error");
						}
					});
					$('#myModal').on("click","#sendBuyNow",function() {
						var $valid = jQuery("#myModal #formBuyNow").valid();
						if(!$valid) {
							$validator.focusInvalid();
							return false;
						}else{
							var formData = new FormData(); 
							formData.append("userName", $("#myModal input[name=name]").val()); 
							formData.append("userEmail", $("#myModal input[name=email]").val()); 
							formData.append("userPhone", $("#myModal input[name=phone]").val()); 
							formData.append("userAddress", $("#myModal input[name=address]").val()); 
							formData.append("buyQuanlity", $("#myModal input[name=quanlity]").val()); 
							formData.append("content", $("#myModal textarea[name=content]").val()); 
							$.ajax({
								url: rootUrl+"/cart/buy/send",
								headers: {'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')},
								type: 'post',
								cache: false,
								contentType: false,
								processData: false,
								data: formData,
								dataType:'json',
								success:function(resultSend){
									//console.log(resultSend); 
									if(resultSend.success==true){
										$('#myModal').modal('hide'); 
										jQuery.gritter.add({
											title: "Thông báo!",
											text: resultSend.message, 
											class_name: "growl-success",
											sticky: false,
											time: ""
										});
									}else{
										jQuery.gritter.add({
											title: "Thông báo!",
											text: resultSend.message, 
											class_name: "growl-danger",
											sticky: false,
											time: ""
										});

									}
									
								},
								error: function(resultSend) {
								}
							});
						}
					});
				}else if(result.success==false){
				}
			},
			error: function(result) {
			}
		});
		return false; 
	});
	$('.section-content').on("click",".btnShare",function() {
		var title=$(this).attr('data-title'); 
		var image=$(this).attr('data-image'); 
		var url=$(this).attr('data-url'); 
		$('#myModal .modal-title').empty(); 
		$('#myModal .modal-body').empty(); 
		$('#myModal .modal-footer').empty(); 
		$('#myModal .modal-title').text('Chia sẻ'); 
		$('#myModal .modal-body').append('<div class="form-group">'+title+'</div>'
			+'<div class="row">'
				+'<div class="col-xs-6 col-sm-4 col-lg-3 text-center"><div class="form-group"><a class="btn btn-primary btn-block customer share" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u='+url+'&amp;t='+title+'" id="fb-share" target="_blank"><i class="fa fa-facebook"></i> Facebook</a></div></div>'
				+'<div class="col-xs-6 col-sm-4 col-lg-3 text-center"><div class="form-group"><a class="btn btn-primary btn-block customer share" rel="nofollow" href="https://twitter.com/share?url='+url+'&amp;text='+title+'&amp;via=[via]&amp;hashtags=[hashtags]" target="_blank"><i class="fa fa-twitter"></i> Twitter</a></div></div>'
				+'<div class="col-xs-6 col-sm-4 col-lg-3 text-center"><div class="form-group"><a class="btn btn-primary btn-block customer share" rel="nofollow" href="https://plus.google.com/share?url='+url+'" target="_blank"><i class="fa fa-google-plus"></i> Google+</a></div></div>'
				+'<div class="col-xs-6 col-sm-4 col-lg-3 text-center"><div class="form-group"><a class="btn btn-primary btn-block customer share" rel="nofollow" href="https://pinterest.com/pin/create/bookmarklet/?media='+image+'&amp;url='+url+'&amp;is_video=[is_video]&amp;description='+title+'" target="_blank"><i class="fa fa-pinterest"></i> Pinterest</a></div></div>'
			+'</div>');	
		$('#myModal').modal('show'); 
		return false; 
	});
	$('#myModal').on("click","#btnLogin",function() {
		$('#myModal .message').empty(); 
		var Email=$('#myModal input[name=email]').val(); 
		var Password=$('#myModal input[name=password]').val();  
		var rootUrl=$('meta[name=root]').attr('content'); 
		var formData = new FormData();
		formData.append("email", Email); 
		formData.append("password", Password); 
		$.ajax({
			url: rootUrl+"/login",
			headers: {'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')},
			type: 'post',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType:'json',
			success:function(result){
				console.log(result); 
				if(result.success==false){
					$('#myModal .message').append('<div class="alert alert-danger alert-dismissable" id="alertError"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+result.message+'</div>'); 
				}else if(result.success==true){
					$('#myModal .message').append('<div class="alert alert-success alert-dismissable" id="alertError"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+result.message+'</div>'); 
					$('#myModal').delay(1000).fadeOut('slow');
					   setTimeout(function() {
						   $("#myModal").modal('hide');
					}, 1500);
					location.reload(); 
				}
			},
			error: function(result) {
			}
		});
	});
	$('#myModal').on("click",".customer.share",function(e) {
		$(this).customerPopup(e);
	});
	$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
		event.preventDefault(); 
		event.stopPropagation(); 
		$(this).parent().siblings().removeClass('open');
		$(this).parent().toggleClass('open');
	});
});
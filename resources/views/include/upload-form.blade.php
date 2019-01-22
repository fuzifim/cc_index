<span class="btn btn-success fileinput-button">
    <i class="glyphicon glyphicon-camera"></i>
    <span>Chọn ảnh/ video</span>
    <!-- The file input field used as target for the file upload widget -->
    <input id="fileupload" type="file" name="file[]" multiple>
</span>
	<div id="dropbox" class="upload_image_post clear">
	@if(isset($adsimages) && count($adsimages) > 0 )
		@foreach ($adsimages as $img)
		   <div class="col-md-3 preview">
				<img class="img-responsive img-thumbnail" src="{{ $img->file_url }}" />
				<div class="item-action">
					<input id="thumb_{{$img->id}}" type="radio" @if($img->file_path.$img->file_name == $ads->ads_thumbnail) checked @endif onchange="set_thumbnail(this)" data-file_id="{{ $img->id }}" name="ads_thumbnail[]"/>
					<label for="thumb_{{$img->id}}">Ảnh đại diện</label>
					<a href="javascript:void(0)" onclick="removeFile(this)" data-file_id = "{{ $img->id }}" class="pull-right">
					<i class="fa fa-trash-o"></i></a>
				</div>
		   </div>
		@endforeach
	@else
         <span class="message">Kéo file để upload.</span>
    @endif
	   
	</div>
	<div id="progress" class="progress">
		<div class="progress-bar progress-bar-success"></div>
	</div>
<label for="" class="text-danger" id="upload-msg"></label>
<link rel="stylesheet" href="{{ url('lib/jQuery-File-Upload/styles.css') }}">
<script src="{{ url('lib/jQuery-File-Upload/js/vendor/jquery.ui.widget.js') }}"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{ url('lib/jQuery-File-Upload/js/jquery.iframe-transport.js') }} "></script>
<!-- The basic File Upload plugin -->
<script src="{{ url('lib/jQuery-File-Upload/js/jquery.fileupload.js') }}"></script>
<script type="text/javascript">

function removeFile(file){
    var file_id = $(file).data('file_id');
    var that = $(file);
    $.ajax({
        url: '/file/removefile',
        type: 'post',
        dataType: 'json',
        data: {
            file_id : file_id,
            ads_id : $('input[name="ads_id"]').val(),
            '_token': $('input[name=_token]').val()
        },
        success:function(data){
            console.log(data);
            if(data.success){
                that.parent().parent().remove();
            }
        }
    });
}

function set_thumbnail(file){
	//console.log('OK'+file+$(file).data('file_id'));
    if($(file).is(':checked')){
        var file_id = $(file).data('file_id');
        $.ajax({
            url: '/file/set_thumbnail',
            type: 'post',
            dataType: 'json',
            data: {
                file_id : file_id,
                ads_id : $('input[name="ads_id"]').val(),
                '_token': $('input[name=_token]').val()
            },
            success:function(data){
                if(data.success == true){
                    $('label#upload-msg').text(data.msg).fadeIn(500);
                    return;
                }
            }
        });
    }
   

}

$(function () {


    'use strict';


    // Change this to the location of your server-side upload handler:
    $('#fileupload').fileupload({
        url: '{{ route("file.upload") }}',
        dataType: 'json',
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 100000,
        singleFileUploads: false,
        //limitMultiFileUploads: 5,
        dropZone: '#dropbox',
        formData: { 
            '_token': $('meta[name=_token]').attr('content'),
            'ads_id' : $('input[name="ads_id"]').val()
        },
        add: function(e, data){
            $('.message','#dropbox').remove();
            data.submit();
        },

        done: function (e, data) {
            console.log(data);
            
            if(!data.result.success){
                $('label#upload-msg').text(data.result.msg.alert);
                return;
            }else{
                $('label#upload-msg').text('');
				//console.log(data.result.msg.alert);
                $.each(data.result.msg.alert, function (key, data) {
                    $('label#upload-msg').text($('label#upload-msg').text()+key+':'+data+'\r\n');
                });
				$.each(data.result.file,function(index,item){
                    var preview = $(template);
                    $('img', preview)
                        .attr('src',item.file_url)
                        .addClass('img-responsive img-thumbnail');
                    $('a', preview).attr('data-file_id',item.file_id);
                    $('input[name="ads_thumbnail[]"]', preview)
                        .attr('data-file_id',item.file_id)
                        .attr('onchange','set_thumbnail(this)');
                    $(preview).appendTo('#dropbox');
                });
				
				//$('.upload_image_post .preview input[type="radio"]').each(function(){
				//});
			}
			
			if ($('.upload_image_post input[type="radio"]').prop('checked')==false) {
				var file_id = $('.upload_image_post input[type="radio"]').eq(0).attr("data-file_id");
				
				$.ajax({
					url: '/file/set_thumbnail',
					type: 'post',
					dataType: 'json',
					data: {
						file_id : file_id,
						ads_id : $('input[name="ads_id"]').val(),
						'_token': $('input[name=_token]').val()
					},
					success:function(data){
						if(data.success == true){
							$('.upload_image_post input[type="radio"]').eq(0).prop('checked', true);
							$('label#upload-msg').text(data.msg).fadeIn(500);
							return;
						}
					}
				});
			}
				
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
var template = '<div class="col-md-3 preview">'+
                    '<img />'+
                    '<div class="item-action">'+
                        '<input type="radio" name="ads_thumbnail[]"/>'+
                        '<label for="">Ảnh đại diện</label>'+
                        '<a href="javascript:void(0)" onclick="removeFile(this)" class="pull-right"><i class="fa fa-trash-o"></a>'+
                    '</div>'+
                '</div>';
</script>
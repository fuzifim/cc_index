<div class="panel panel-primary">
	<div class="panel-heading"><h3 class="panel-title">Cung Cấp {!!$field->name!!}</h3></div>
	<div class="row row-pad-5">
		<div class="col-md-7">
			<? 
				$i=0; 
				$firstNews=WebService::filter_by_value($getNews, 'image',!null); 
			?>
			<div class="form-group padding5">
				<div class="form-group">
					<a class="image" href="https://news-{{$firstNews[0]['id']}}.{{config('app.url')}}">
						<img src="{{$firstNews[0]['image']}}" class="img-responsive lazy" alt="{!!$firstNews[0]['title']!!}" title="" >
					</a>
				</div>
				<h3 class="blog-title nomargin"><a class="" href="https://news-{{$firstNews[0]['id']}}.{{config('app.url')}}">{!!$firstNews[0]['title']!!}</a></h3>
				<small><span><i class="glyphicon glyphicon-time"></i> {!!WebService::time_request($firstNews[0]['updated_at'])!!}</span></small> 
				<p>{!!WebService::limit_string(strip_tags(html_entity_decode($firstNews[0]['description']),""), $limit = 200)!!}</p>
			</div>
			@foreach($getNews as $postRelate)
				<? $i++; ?>
				@if($postRelate['id']!=$firstNews[0]['id'])
					@if(!empty($postRelate['image']))
						<div class="list-group-item form-group padding5">
							<div class="col-lg-5 col-md-5 col-sm-3 col-xs-3">
								<a class="image" href="https://news-{{$postRelate['id']}}.{{config('app.url')}}">
									<img src="{{$postRelate['image']}}" class="img-responsive img-thumbnail lazy" alt="{!!$postRelate['title']!!}" title="" >
								</a>
							</div>
							<div class="col-lg-7 col-md-7 col-sm-9 col-xs-9">
								<h5 class="postTitle nomargin"><a class="title" href="https://news-{{$postRelate['id']}}.{{config('app.url')}}">{!!$postRelate['title']!!}</a></h5>
								<small><span><i class="glyphicon glyphicon-time"></i> {!!WebService::time_request($postRelate['updated_at'])!!}</span></small> 
								<p class="hidden-xs">{!!WebService::limit_string(strip_tags(html_entity_decode($postRelate['description']),""), $limit = 100)!!}</p>
							</div>
						</div>
					@else 
						<div class="list-group-item form-group padding5">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<h5 class="postTitle"><a class="title" href="https://news-{{$postRelate['id']}}.{{config('app.url')}}">{!!$postRelate['title']!!}</a></h5>
								<small><span><i class="glyphicon glyphicon-time"></i> {!!WebService::time_request($postRelate['updated_at'])!!}</span></small>
								<p class="hidden-xs">{!!WebService::limit_string(strip_tags(html_entity_decode($postRelate['description']),""), $limit = 100)!!}</p>
							</div>
						</div>
					@endif
				@endif
			@endforeach
			
		</div>
		<div class="col-md-5">
			<? 
				$postArray=array(); 
				$arrayResult=array(); 
				foreach($getPost as $post){
					$arrayResult['id']=$post->id; 
					$arrayResult['title']=$post->posts_title; 
					if(!empty($post->gallery[0]->media->media_url)){
						$arrayResult['image']=config('app.link_media').$post->gallery[0]->media->media_path.'small/'.$post->gallery[0]->media->media_name; 
					}else{
						$arrayResult['image']=''; 
					}
					$arrayResult['updated_at']=$post->posts_updated_at; 
					array_push($postArray,$arrayResult);
				}
				$firstPost=WebService::filter_by_value($postArray, 'image',!null); 
			?>
			<div class="panel-primary">
				<h5 class="subtitle mb5 mt5">Tin liên quan</h5>
				<div class="list-group-item padding5">
					<div class="form-group">
						<a class="image" href="https://post-{{$firstPost[0]['id']}}.{{config('app.url')}}">
							<img src="{{$firstPost[0]['image']}}" class="img-responsive lazy" alt="{!!$firstPost[0]['title']!!}" title="" >
						</a>
					</div>
					<h3 class="postTitle nomargin blog-title"><a class="" href="https://post-{{$firstPost[0]['id']}}.{{config('app.url')}}"><span class="">{!!$firstPost[0]['title']!!}</span></a></h3>
					<small><span><i class="glyphicon glyphicon-time"></i> {!!WebService::time_request($firstPost[0]['updated_at'])!!}</span></small>
				</div>
				@foreach($getPost as $post)
					@if($post->id != $firstPost[0]['id'])
						{!!Theme::partial('onePost', array('post' => $post))!!}
					@endif
				@endforeach
			</div>
		</div>
	</div>
</div>
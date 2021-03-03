@extends('layout')

@section('main')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="breadcrumbs wow fadeInLeft" style="visibility: visible;">
				<ul>
					<li><a href="/">@lang('list.Главная')</a></li>
					<li>/</li>
					<li>{{$category->name}}</li>
				</ul>
			</div>
			<div class="main-title">
				<h4>{{$category->name}}</h4>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="main-white-section wow fadeIn" style="visibility: visible;">
				<div class="row">
					<div class="col-sm-3">
						<div class="news-lent-title">
							<h6>@lang('list.Популярное в рубрике')</h6>
						</div>
						<div class="side-bar-scroll">
						@foreach($categoryTopNews as $news)
							<div class="news-lent-item">
								<div class="date">
									<p>{{$news->date_st}}<span><img src="images/view-icon.png" alt="">{{$news->seen}}</span>
									</p>
								</div>
								<a href="{{"/$locale/$news->categorySlug/$news->slug"}}">{{$news->title}}</a>
							</div>
					    @endforeach
						</div>

					</div>
					<div class="col-sm-9">
						<div class="row">
						    @foreach($categoryNews as $i=>$news)
						        @php
						            if($i>5){
						                break;
						            }
						        @endphp
                                    <div class="col-sm-4">
                                        <div class="inner-lang-news">
                                            <a href='{{"/$locale/$news->categorySlug/$news->slug"}}'>
                                                <div class="category-img">
                                                    <img src='{{asset("storage/$news->cover")}}' class="img-fluid" alt="">
                                                </div>
                                                <div class="date">
                                                    <p>{{$news->date_st}}<span><img src="images/view-icon.png" alt="">{{$news->seen}}</span>
                                                    </p>
                                                </div>
                                                <h6>{{$news->title}}</h6>
                                            </a>
                                        </div>
                                    </div>
							@endforeach
						</div>
					</div>
					@if($categoryNews->total()>6)
					@for($i=6;$i<$categoryNews->total();$i++)
					<div class="col-sm-3" style="margin-top: 20px;">
						<div class="inner-lang-news">
							<a href="{{"/$locale/$category->slug/".$categoryNews[$i]->slug}}">
								<div class="category-img">
									<img src='{{asset("storage/".$categoryNews[$i]->cover)}}' class="img-fluid" alt="">
								</div>
								<div class="date">
									<p>{{$categoryNews[$i]->date_st}}<span><img src="images/view-icon.png" alt="">{{$categoryNews[$i]->seen}}</span></p>
								</div>
								<h6>{{$categoryNews[$i]->title}}</h6>
							</a>
						</div>
					</div>
					@endfor
					@endif
					<div id="inner_news" class="row">

					</div>
					<div class="col-sm-12" onclick="show_more('WHERE category_id=15',window.serial_number)"
					     id="show_more_button">
						<div class="show-more" data-toggle="collapse" data-target="#demo45">
							<p id="sh_hi">@lang('list.Показать ещё')</p>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="main-title wow fadeInUp" style="visibility: visible;">
				<h4>ВЫБОР ЧИТАТЕЛЕЙ</h4>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="main-white-section wow fadeIn" style="visibility: visible;">
				<div class="row">
					<div class="col-sm-6">

						<div class="inner-category-item">
							<div class="title-block" style="width:fit-content">
								<p><a style="color: white" href="topics.php?id_cat=24">中文文章</a></p>
							</div>
							<div class="inner-category">
								<a href="inner-news.php?id_cat=24&amp;&amp;id=163765">
									<div class="inner-cat-img">
										<img src="admin/img/602221067dc2b.jpg" alt=""
										     style="width: 170px;height: 114px;">
									</div>
									<div class="inner-category-text">
										<div class="date">
											<p>9 февраля 2021, 11:43<span><img src="images/view-icon.png"
											                                   alt="">3230</span></p>
										</div>
										<p>拉·阿里莫夫：上海合作组织将迎来20周年华诞</p>
									</div>
								</a>
							</div>
						</div>


						<div class="inner-category-item">
							<div class="title-block" style="width:fit-content">
								<p><a style="color: white" href="topics.php?id_cat=23">Қазақ тіліндегі мақалалар</a></p>
							</div>
							<div class="inner-category">
								<a href="inner-news.php?id_cat=23&amp;&amp;id=163494">
									<div class="inner-cat-img">
										<img src="admin/img/6020ce4d7a1d4.jpg" alt=""
										     style="width: 170px;height: 114px;">
									</div>
									<div class="inner-category-text">
										<div class="date">
											<p>8 февраля 2021, 11:36<span><img src="images/view-icon.png"
											                                   alt="">5358</span></p>
										</div>
										<p>Балалар мен жасөспірімдерге арналған 2021 жылдың 10 үздік кітабы</p>
									</div>
								</a>
							</div>
						</div>

					</div>
					<div class="col-sm-12" onclick="show_hide('sh_hi2')">
						<div class="show-more" data-toggle="collapse" data-target="#demo2">
							<p id="sh_hi2">Показать еще</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="top-btn" style="display: none;">
				<a onclick="topFunction()"><img src="images/scroll-top.png" alt=""></a>
			</div>
		</div>
	</div>
</div>
@endsection
@extends('layout')

@section('main')
<div class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="breadcrumbs wow fadeInLeft" style="visibility: visible;">
					<ul>
						<li><a href="/">@lang('list.Главная')</a></li>
						<li>/</li>
						<li>@lang('list.Архив газеты')</li>
					</ul>
				</div>
				<div class="main-title">
					<h4>@lang('list.Архив газеты')</h4>
				</div>
			</div>
			<div class="col-sm-12 wow fadeIn" style="visibility: visible;">
				<div class="main-white-section">
					<div class="row">
						@foreach($newspapers as $newspaper)
						<div class="col-sm-2">
							<div class="archive-item">
								<a href="" onclick="window.open('/storage/{{$newspaper->newspaper}}','ddd');">
									<img src="/storage/{{$newspaper->cover}}" class="img-fluid" alt="">
									<p>
										<span style="font-weight: bold;">{{$newspaper->name}}</span>
										<br>
										{{$newspaper->release_date}}</p>
								</a>
							</div>
						</div>
						@endforeach
					</div>
					<div class="col-sm-12">
						<div class="pagination">
								{{ $newspapers->links() }}
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
</div>
@endsection
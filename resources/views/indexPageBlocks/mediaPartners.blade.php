<div class="col-sm-12">
	<div class="main-title wow slideInUp" style="visibility: visible;">
		<h4>Media partners</h4>
	</div>
</div>

<div class="col-sm-12">
	<div class="main-white-section wow fadeIn" style="visibility: visible;">
		<div class="owl-carousel owl-slider-one owl-loaded">
			<div class="owl-stage-outer">
				<div class="item">
					<div class="row">
						<div class="col-sm-5">
							<div class="size-img-1">
								@foreach($mediaPartners[1] as $media)
								<a href="{{$media->link1}}" target="_blank">
									<img
											src="/storage/{{$media->cover}}"
											class="img-fluid" alt=""
									>
								</a>
								@endforeach
							</div>
						</div>

						<div class="col-sm-7">
							<div class="row">
								@foreach($mediaPartners[2] as $media)
								<div class="col-sm-6">
									<div class="size-img-2">
										<a href="{{$media->link1}}" target="_blank">
											<img
													src="/storage/{{$media->cover}}"
													class="img-fluid"
													alt=""
											>
										</a>
									</div>
								</div>
								@endforeach
							</div>
						</div>

						@foreach($mediaPartners[3] as $media)
						<div class="col-sm-5">
							<div class="size-img-3">
								<a href="{{$media->link1}}" target="_blank">
									<div class="icon vh570 third-block">
										<img src="/storage/{{$media->cover}}" class="img-fluid" alt="">
									</div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
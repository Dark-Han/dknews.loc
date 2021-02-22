                            <div class="col-xl-8 col-sm-12 main-banner-img">
                                <div class="big-img-news">
                                    <a href="inner-news.php?id_cat=12 &amp;&amp; id=166301">
                                        <img src="{{asset('storage/'.$topNews[0]->cover)}}" alt="" class="img-top-news" style="width: 100% !important;height:100%">
                                        <div class="big-news-caption">
                                            <p>Финансы <span><img src="images/view-icon-white.png" alt="">{{$topNews[0]->seen}}</span></p>
                                            <h5>{{$topNews[0]->title}}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-12 top-img">
                            @for($i=1;$i<3;$i++)
                                    <div class="small-img-news">
                                        <a href="inner-news.php?id_cat=15 &amp;&amp; id=166297">
                                            <img src="{{asset('storage/'.$topNews[$i]->cover)}}" alt="" class="img-top-news" style="width: 100% !important;height:100%">
                                            <div class="big-news-caption">
                                                <p>Общество <span><img src="images/view-icon-white.png" alt="">{{$topNews[$i]->seen}}</span></p>
                                                <h5>{{$topNews[$i]->title}}</h5>
                                            </div>
                                        </a>
                                    </div>
                            @endfor
                            </div>

                            @for($i=3;$i<=5;$i++)
                            <div class="col-xl-4 col-md-6">
                                <div class="small-img-news">
                                    <a href="inner-news.php?id_cat=73 &amp;&amp; id=166284">
                                          <img src="{{asset('storage/'.$topNews[$i]->cover)}}" alt="" class="img-top-news" style="width: 100% !important;height:100%">
                                          <div class="big-news-caption">
                                          <p>Есть мнение! <span><img src="images/view-icon-white.png" alt="">{{$topNews[$i]->seen}}</span></p>
                                          <h5>{{$topNews[$i]->title}}</h5>
                                          </div>
                                    </a>
                                </div>
                            </div>
                            @endfor
@extends('layout')

@section('main')
<div class="main">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-title wow slideInUp">
                    <h4>Главные новости сегодня</h4>
                </div>
                <div class="main-white-section wow fadeIn">
                    <div class="row">
                        <div class="col-xl-9 col-md-9 col-sm-9">
                            @include('indexMainNews',$indexMainNews)
                        </div>
                        <div class="col-sm-3">
                            <div class="news-lent-title">
                                <h6>
                                    <a href="https://dknews.kz/topics.php?id_cat=all" style="color:#172f47" target="_blank">Лента новостей</a>
                                </h6>
                            </div>
                            <div class="side-bar-scroll">
                                <?php foreach ($res_m as $key => $value) : ?>
                                    <div class="news-lent-item">
                                        <div class="date">
                                            <p><?= rus_date($value["date_st"]); ?><span><img src="images/view-icon.png" alt=""><?= $value["seen"] ?></span></p>
                                        </div>
                                        <?php if ($value["id_cat"] == 64) : ?>
                                            <a href="inner-infog.php?id_cat=<?= $value['id_cat']; ?> && id=<?= $value["id"]; ?>"><?= $value["title"]; ?></a>
                                        <?php else : ?>
                                            <a href="inner-news.php?id_cat=<?= $value['id_cat']; ?> && id=<?= $value["id"]; ?>"><?= $value["title"]; ?></a>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="all-lent">
                                <a href="topics.php?id_cat=all">Все последние новости</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $ban_arr = get_ban(2); ?>
            <?php if (!empty($ban_arr)) : ?>
                <div class="col-sm-12">
                    <div class="banner-img wow slideInUp" id="<?= "ban-".$ban_arr['id'];?>" onclick="get_ban(this.id)">
                        <a href="<?= $ban_arr["link"]; ?>" target='_blank'><img src="admin/img/<?= $ban_arr['img']; ?>" style="height: 90px;" class="img-fluid" alt=""></a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-sm-12">
                <div class="main-white-section wow fadeIn popular_sections">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <?php $cat_arr = all_cat();
                                $i = 0;
                                $ban = 3; ?>
                                <?php foreach ($cat_arr as $key => $value) : ?>
                                    <?php if (!empty(ind_news(6, $value["name"]))) : ?>
                                        <?php
                                        //Отображаем первые 4 категории
                                        ++$i;
                                        if ($ban != false and !empty(get_ban($ban))) {
                                            $count = false;
                                        } else {
                                            $count = true;
                                        }
                                        if ($i > 4) {
                                            break;
                                        }
                                        if ($ban > 5) {
                                            $ban = false;
                                            $count = true;
                                        }
                                        unset($cat_arr[$key]);
                                        ?>

                                        <div class="col-sm-12">
                                            <div class="link-title">
                                                <span>&#9632;</span><a href="topics.php?id_cat=<?= $value["id"]; ?>"><?= $value["name"] ?></a>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php foreach (ind_news(6, $value["name"], $count) as $key2 => $value) : ?>

                                        <?php if ($key == 3 and !empty(get_ban(5)) and $key2 == 3) : ?>
                                        <?php else : ?>
                                            <div class="col-xl-3 col-md-4 col-sm-6">
                                                <div class="category-news">
                                                    <a href="inner-news.php?id_cat=<?= $value["id_cat"] ?> && id=<?= $value["id"]; ?>">
                                                        <div class="category-img">
                                                            <img src="admin/img/<?= $value["img"]; ?>" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="date">
                                                            <p><?= rus_date($value["date_st"]); ?><span><img src="images/view-icon.png" alt=""><?= $value["seen"]; ?></span></p>
                                                        </div>
                                                        <p><?= $value["title"]; ?></p>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>


                                    <?php endforeach; ?>
                                    <!-- отображаем баннер если он есть в этом месте -->
                                    <?php if ($ban) : ?>
                                        <?php $ban_arr = get_ban($ban);
                                        ++$ban; ?>
                                        <?php if (!empty($ban_arr)) : ?>
                                            <?php if($ban_arr['id']==14):?>
                                            <div class="col-xl-3 col-md-4 col-sm-6">
                                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                        <ol class="carousel-indicators">
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                                        </ol>
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">
                                                            <a target="_blank"
                                                            href="https://www.chevron.com/worldwide/kazakhstan?utm_source=Dknews&utm_medium=desktop&utm_campaign=Chevron_KZ_2020&utm_term=RU">
                                                            <img class="d-block w-100"
                                                                src="/images/chevron-rus.jpg"
                                                                alt="First slide"
                                                            >
                                                            </a>
                                                            </div>
                                                            <div class="carousel-item">
                                                            <a target="_blank"
                                                            href="https://www.chevron.com/worldwide/kazakhstan?utm_source=Dknews&utm_medium=desktop&utm_campaign=Chevron_KZ_2020&utm_term=KZ">
                                                            <img class="d-block w-100"
                                                                src="/images/chevron-kaz.jpg"
                                                                alt="Second slide"
                                                            >
                                                            </a>
                                                            </div>
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                            </div>
                                            <?php else:?>
                                            <div class="col-xl-3 col-md-4 col-sm-6">
                                                <div class="banner-m" id="<?= "ban-".$ban_arr['id']; ?>" onclick="get_ban(this.id);">
                                                    <a href="<?= $ban_arr['link']; ?>" target='_blank'><img src="admin/img/<?= $ban_arr['img']; ?>" class="img-fluid" alt=""></a>
                                                </div>
                                            </div>
                                            <?php endif;?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div id="demo" class="collapse">
                                <div class="row">
                                    <?php $i = 0;
                                    $ban = 6; ?>
                                    <?php foreach ($cat_arr as $key => $value) : ?>
                                        <?php if (!empty(ind_news(6, $value["name"]))) : ?>
                                            <?php
                                            //Отображаем первые 4 категории
                                            ++$i;
                                            if ($ban != false and !empty(get_ban($ban))) {
                                                $count = false;
                                            } else {
                                                $count = true;
                                            }
                                            // if ($i>4) {
                                            //     break;
                                            // }
                                            if ($ban > 9) {
                                                $ban = false;
                                            }
                                            unset($cat_arr[$key]);
                                            ?>

                                            <div class="col-sm-12">
                                                <div class="link-title">
                                                    <span>&#9632;</span><a href="topics.php?id_cat=<?= $value["id"]; ?>"><?= $value["name"] ?></a>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php foreach (ind_news(6, $value["name"], true) as $key => $value) : ?>


                                            <div class="col-sm-3">
                                                <div class="category-news">
                                                    <a href="inner-news.php?id_cat=<?= $value["id_cat"] ?> && id=<?= $value["id"]; ?>">
                                                        <div class="category-img">
                                                            <img src="admin/img/<?= $value["img"]; ?>" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="date">
                                                            <p><?= rus_date($value["date_st"]); ?><span><img src="images/view-icon.png" alt=""><?= $value["seen"]; ?></span></p>
                                                        </div>
                                                        <p><?= $value["title"]; ?></p>
                                                    </a>
                                                </div>
                                            </div>


                                        <?php endforeach; ?>
                                        <!-- отображаем баннер если он есть в этом месте -->


                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" onclick="show_hide('sh_hi')">
                            <div class="show-more" data-toggle="collapse" data-target="#demo">
                                <p id="sh_hi">Показать еще</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
<?php
$chunkedData = array_chunk($data, 4); ?>


<div class="carousel slide" data-bs-ride="carousel" data-bs-pause="false" data-bs-interval="4000" id="carousel-top-margin">
    <div class="carousel-inner">
        <?php
        $outerIndex = 1;
        foreach ($chunkedData as $carouselRow) {
            $extraClass = $outerIndex == 1 ? 'active' : ''; ?>
            <div class="carousel-item <?= $extraClass ?>">
                <div class="row g-0 slider-row">
                    <?php foreach ($carouselRow as $k => $post) { ?>
                        <div class="col-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 offset-sm-0">
                        <a class="" href="<?= $post['link'] ?>">
                            <div class="card d-flex">

                                <div class="card-body text-center">
                                    <div>
                                            <img src="<?= $post['image'] ?>">
                                            <h4 class="card-title price-head"><?= $post[
                                                'title'
                                            ] ?></h4>
                                            <p class="text-muted card-subtitle mb-2"><?= $post[
                                                'prezzo'
                                            ] ?></p>
                                    </div>
                                </div>

                            </div>
                            </a>
                        </div>
                        <?php } ?>
                </div>
            </div>
            <?php $outerIndex++;
        }
        ?>
    </div>
    <?php $count = count($data); ?>
    <?php if($count > 4) { ?>
        <?php $pages = floor($count/4); ?>
        <div>
            <a class="carousel-control-prev" href="#carousel-top-margin" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden"></span>
            </a>
            <a class="carousel-control-next" href="#carousel-top-margin" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden"></span>
            </a>
        </div>
        <ol class="carousel-indicators">
            <?php for($i = 0; $i <= $pages; $i++) { ?>
            <li data-bs-target="#carousel-top-margin" data-bs-slide-to="<?php echo $i; ?>" <?php if($i == 0) { ?> class="active"<?php } ?>></li>
            <?php } ?>
        </ol>
    <?php } ?>
</div>

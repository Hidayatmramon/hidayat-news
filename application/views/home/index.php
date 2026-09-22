<?php
$meta  = $meta  ?? ['description' => 'Update berita terbaru dari Hidayatnews.'];
$title = $title ?? 'Berita Terbaru';

$this->load->view('_partials/public_header', compact('title','meta'));

$asset         = base_url('public/front/');
$posts         = $posts ?? [];
$hero          = $posts[0] ?? null;
$rest          = array_slice($posts, 1);
$trending      = array_slice($posts, 0, 6);
$popular_left  = array_slice($posts, 0, 2);
$popular_right = array_slice($posts, 2, 2);

function img_post($p, $ratio = '16x9', $full = false) {
  $ph = $ratio === '21x9' ? 'images/placeholder-21x9.jpg' : 'images/placeholder-16x9.jpg';
  if (!empty($p->cover_image)) {
    $path = $full ? $p->cover_image : (function_exists('thumb_path') ? thumb_path($p->cover_image) : $p->cover_image);
    return base_url($path);
  }
  return base_url('public/front/'.$ph);
}
?>

<section class="bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="wrapp__list__article-responsive wrapp__list__article-responsive-carousel">
          <?php if (!empty($trending)): foreach ($trending as $p): ?>
            <div class="item">
              <div class="card__post card__post-list">
                <div class="image-sm">
                  <a href="<?= site_url('news/'.$p->slug) ?>">
                    <img src="<?= img_post($p, '16x9') ?>" class="img-fluid" alt="<?= htmlspecialchars($p->title) ?>">
                  </a>
                </div>
                <div class="card__post__body">
                  <div class="card__post__content">
                    <div class="card__post__author-info mb-2">
                      <ul class="list-inline">
                        <li class="list-inline-item"><span class="text-primary">by <?= htmlspecialchars($p->author_name ?? 'Redaksi') ?></span></li>
                        <li class="list-inline-item"><span class="text-dark text-capitalize"><?= date('F d, Y', strtotime($p->published_at)) ?></span></li>
                      </ul>
                    </div>
                    <div class="card__post__title">
                      <h6><a href="<?= site_url('news/'.$p->slug) ?>"><?= htmlspecialchars($p->title) ?></a></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; else: ?>
            <p class="p-3">Belum ada berita.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="popular__news-header">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-8">
          <div class="card__post-carousel">
            <?php if (!empty($popular_left)): foreach ($popular_left as $p): ?>
              <div class="item">
                <div class="card__post">
                  <div class="card__post__body">
                    <a href="<?= site_url('news/'.$p->slug) ?>">
                      <img src="<?= img_post($p, '21x9', true) ?>" class="img-fluid" alt="<?= htmlspecialchars($p->title) ?>">
                    </a>
                    <div class="card__post__content bg__post-cover">
                      <div class="card__post__category">headline</div>
                      <div class="card__post__title">
                        <h2><a href="<?= site_url('news/'.$p->slug) ?>"><?= htmlspecialchars($p->title) ?></a></h2>
                      </div>
                      <div class="card__post__author-info">
                        <ul class="list-inline">
                          <li class="list-inline-item"><a href="#"><?= htmlspecialchars($p->author_name ?? 'Redaksi') ?></a></li>
                          <li class="list-inline-item"><span><?= date('F d, Y', strtotime($p->published_at)) ?></span></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; endif; ?>
          </div>
        </div>

        <div class="col-md-4">
          <div class="popular__news-right">
            <?php if (!empty($popular_right)): foreach ($popular_right as $p): ?>
              <div class="card__post">
                <div class="card__post__body card__post__transition">
                  <a href="<?= site_url('news/'.$p->slug) ?>">
                    <img src="<?= img_post($p, '16x9', true) ?>" class="img-fluid" alt="<?= htmlspecialchars($p->title) ?>">
                  </a>
                  <div class="card__post__content bg__post-cover">
                    <div class="card__post__category">popular</div>
                    <div class="card__post__title">
                      <h5><a href="<?= site_url('news/'.$p->slug) ?>"><?= htmlspecialchars($p->title) ?></a></h5>
                    </div>
                    <div class="card__post__author-info">
                      <ul class="list-inline">
                        <li class="list-inline-item"><a href="#"><?= htmlspecialchars($p->author_name ?? 'Redaksi') ?></a></li>
                        <li class="list-inline-item"><span><?= date('F d, Y', strtotime($p->published_at)) ?></span></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="popular__news-header-carousel">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="top__news__slider">
            <?php if (!empty($rest)): foreach (array_slice($rest, 0, 6) as $p): ?>
              <div class="item">
                <div class="article__entry">
                  <div class="article__image">
                    <a href="<?= site_url('news/'.$p->slug) ?>">
                      <img src="<?= img_post($p, '16x9') ?>" alt="<?= htmlspecialchars($p->title) ?>" class="img-fluid">
                    </a>
                  </div>
                  <div class="article__content">
                    <ul class="list-inline">
                      <li class="list-inline-item"><span class="text-primary">by <?= htmlspecialchars($p->author_name ?? 'Redaksi') ?></span>,</li>
                      <li class="list-inline-item"><span><?= date('F d, Y', strtotime($p->published_at)) ?></span></li>
                    </ul>
                    <h5><a href="<?= site_url('news/'.$p->slug) ?>"><?= htmlspecialchars($p->title) ?></a></h5>
                  </div>
                </div>
              </div>
            <?php endforeach; else: ?>
              <div class="item"><div class="p-3">Belum ada berita lain.</div></div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <?php if (!empty($pagination)): ?>
        <div class="row mt-4">
          <div class="col-12 d-flex justify-content-center">
            <?= $pagination ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php
$this->load->view('_partials/public_footer');

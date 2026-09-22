<?php
$this->load->view('_partials/public_header', compact('title','meta'));
$asset = base_url('public/front/');
$img = function_exists('avatar_url')
  ? avatar_url($post->author_avatar ?? null)
  : base_url('public/backend/images/profile-default.png');

$ld = [
  "@context"=>"https://schema.org",
  "@type"=>"NewsArticle",
  "headline"=>$post->title,
  "datePublished"=>date('c', strtotime($post->published_at)),
  "dateModified"=>date('c', strtotime($post->updated_at ?? $post->published_at)),
  "author"=>["@type"=>"Person","name"=>$post->author_name ?: "Redaksi"],
  "image"=>$post->cover_image ? base_url($post->cover_image) : base_url('public/front/images/og-default.jpg'),
  "mainEntityOfPage"=>current_url(),
];
?>
<script type="application/ld+json"><?= json_encode($ld, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>

<?php
function img_post_full($p) {
  if (!empty($p->cover_image)) return base_url($p->cover_image);
  return base_url('public/front/images/article-slide.jpg');
}
function img_post_thumb($p) {
  if (!empty($p->cover_image)) return base_url(thumb_path($p->cover_image));
  return base_url('public/front/images/placeholder-16x9.jpg');
}
$ENC_URL   = urlencode(current_url());
$ENC_TITLE = urlencode($post->title);
$share = [
  'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$ENC_URL}",
  'twitter'  => "https://twitter.com/intent/tweet?url={$ENC_URL}&text={$ENC_TITLE}",
  'wa'       => "https://wa.me/?text={$ENC_TITLE}%20{$ENC_URL}",
  'telegram' => "https://t.me/share/url?url={$ENC_URL}&text={$ENC_TITLE}",
  'linkedin' => "https://www.linkedin.com/sharing/share-offsite/?url={$ENC_URL}",
];
$read_text = reading_time($post->body); 
?>

<section class="pb-80">
  <div class="container">
    <div class="row">
      <div class="col-md-8">

        <div class="wrap__article-detail">
          <div class="wrap__article-detail-title">
            <h1><?= htmlspecialchars($post->title) ?></h1>
          </div>

          <hr>

          <div class="wrap__article-detail-info">
            <ul class="list-inline">
              <li class="list-inline-item">
						<figure class="image-profile">
							  <img src="<?= $img ?>" alt="profile">
						</figure>             
					 </li>
              <li class="list-inline-item">
                <span>by</span>
                <a href="https://www.hidayatmramon.com"><?= htmlspecialchars($post->author_name ?: 'Redaksi') ?>,</a>
              </li>
              <li class="list-inline-item">
                <span class="text-dark text-capitalize ml-1">
                  <?= date('F d, Y', strtotime($post->published_at)) ?>
                </span>
              </li>
            </ul>
          </div>

          <div class="wrap__article-detail-image mt-4">
            <figure>
              <img src="<?= img_post_full($post) ?>" alt="<?= htmlspecialchars($post->title) ?>" class="img-fluid">
              <?php if (!empty($post->image_caption)): ?>
                <figcaption class="small text-muted mt-2"><?= htmlspecialchars($post->image_caption) ?></figcaption>
              <?php endif; ?>
            </figure>
          </div>

          <div class="wrap__article-detail-content">
            <div class="total-views">
              <div class="total-views-read">
                <?= preg_replace('/\D/','',$read_text) ?: '1' ?> 
                <span><?= htmlspecialchars($read_text) ?></span>
              </div>

              <ul class="list-inline">
                <span class="share">share on:</span>
                <li class="list-inline-item">
                  <a class="btn btn-social-o facebook" target="_blank" rel="noopener" href="<?= $share['facebook'] ?>">
                    <i class="fa fa-facebook-f"></i><span> facebook</span>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="btn btn-social-o twitter" target="_blank" rel="noopener" href="<?= $share['twitter'] ?>">
                    <i class="fa fa-twitter"></i><span> twitter</span>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="btn btn-social-o whatsapp" target="_blank" rel="noopener" href="<?= $share['wa'] ?>">
                    <i class="fa fa-whatsapp"></i><span> whatsapp</span>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="btn btn-social-o telegram" target="_blank" rel="noopener" href="<?= $share['telegram'] ?>">
                    <i class="fa fa-telegram"></i><span> telegram</span>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="btn btn-linkedin-o linkedin" target="_blank" rel="noopener" href="<?= $share['linkedin'] ?>">
                    <i class="fa fa-linkedin"></i><span> linkedin</span>
                  </a>
                </li>
              </ul>
            </div>

            <div class="mt-3">
              <?= $post->body ?>
            </div>
          </div>
        </div>


        <?php if (!empty($related)): ?>
        <div class="related-article mt-5">
          <h4>you may also like</h4>
          <div class="article__entry-carousel-three">
            <?php foreach ($related as $r): if ($r->id == $post->id) continue; ?>
            <div class="item">
              <div class="article__entry">
                <div class="article__image">
                  <a href="<?= site_url('news/'.$r->slug) ?>">
                    <img src="<?= img_post_thumb($r) ?>" alt="<?= htmlspecialchars($r->title) ?>" class="img-fluid">
                  </a>
                </div>
                <div class="article__content">
                  <ul class="list-inline">
                    <li class="list-inline-item"><span class="text-primary">by <?= htmlspecialchars($r->author_name ?? 'Redaksi') ?></span></li>
                    <li class="list-inline-item"><span><?= date('F d, Y', strtotime($r->published_at)) ?></span></li>
                  </ul>
                  <h5><a href="<?= site_url('news/'.$r->slug) ?>"><?= htmlspecialchars($r->title) ?></a></h5>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php $this->load->view('_partials/public_footer'); ?>

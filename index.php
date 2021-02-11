<?php
  $url = "jsondata.json";
  $json = file_get_contents($url);
  $json = mb_convert_encoding($json,'UTF8','ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $arr = json_decode($json,true);
  if ($arr === NULL) {
    return;
  }else{
    $category_count = count($arr["res"]["videoContentsData"]);
    $bc_id　= array();
    $bc_category = array();
    $bc_video_id = array();
    $bc_video_title = array();
    $bc_video_url = array();

    for($i = 0; $i <= $category_count-1; $i++){
        $bc_id[] = $arr["res"]["videoContentsData"][$i]["id"];
        $bc_category[] = $arr["res"]["videoContentsData"][$i]["category"];
        $video_count = count($arr["res"]["videoContentsData"][$i]["videos"]);
        for($j = 0; $j <= $video_count-1; $j++){
          $bc_video_id[$i][] = $arr["res"]["videoContentsData"][$i]["videos"][$j]["id"];
          $bc_video_title[$i][] = $arr["res"]["videoContentsData"][$i]["videos"][$j]["title"];
          $bc_video_url[$i][] = $arr["res"]["videoContentsData"][$i]["videos"][$j]["url"];
        }
    }

  }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>勉強法動画サイト</title>

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">

    <!-- style.css -->
    <link rel ="stylesheet" href="styles/style.css"></link>

    <!-- modernizr -->
    <script src="vendors/modernizr-custom.js"></script>
  </head>
  <body>
    <div class="container">
      <!-- トップビュー -->
      <div class="jumbotron mt-3 text-center">
        <h1 id="Heading" class="h4 font-weight-bold">勉強法改善ジム</h1>
        <p class="m-0">あなたの学習効率を上げる為の、<br>科学的に正しい勉強法を解説する動画です.</p>
      </div>

      <!-- サービスロゴ -->
      <div class="service-logo text-center">
        <div class="service-logo__content d-flex flex-row justify-content-center align-items-center">
          <p class="d-inline-flex lead serviceLogoText m-0">となりにコーチ</p>
          <p class="serviceLogo d-inline-flex m-0"><img alt="となりにコーチのサービスロゴ" src="images/serviceLogo.png" class="col img-fluid rounded-0"></p>
        </div>
        <p>1人ひとりに最適な勉強法を提案します.</p>
      </div>

      <!-- コンテンツ -->
      <!-- カテゴリ一覧 -->
      <h2 class="h4">カテゴリ一覧</h2>
      <p class="text-muted">興味のあるカテゴリをタップすると動画の一覧が展開します.</p>
      <div class="container accordion" id="collapse-accordion">
        <?php for($i = 0; $i <= $category_count-1; $i++) : ?>
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">
              <button
                class="btn btn-link btn-block text-left text-truncate"
                type="button"
                data-toggle="collapse"
                data-target="#collapse-accordion-<?php echo $i ?>"
              >
                <?php echo $bc_category[$i] ?>
                <span class="badge badge-secondary badge-pill">Tap</span>
              </button>
            </h5>
          </div>
          <div
            id="collapse-accordion-<?php echo $i ?>"
            class="collapse"
            data-parent="#collapse-accordion"
          >
            <!-- 動画一覧 -->
            <div class="card-body">
              <?php $count = count($arr["res"]["videoContentsData"][$i]["videos"]) ?>
              <?php for($j = 0; $j <= $count-1; $j++) : ?>
                <a
                  class="btn btn-primary btn-block shadow text-truncate"
                  href="<?php echo $bc_video_url[$i]{$j} ?>"
                  role="button"
                >
                  <?php echo $bc_video_title[$i][$j] ?> <span class="badge badge-light badge-pill"><em class="far fa-hand-pointer"></em></span>
                </a>
              <? endfor; ?>
            </div>
          </div>
        </div>
        <?php endfor; ?>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

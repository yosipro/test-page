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
        for($j = $video_count-1; $j >= 0; $j--){
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
  </head>
  <body>
    <div class="container">
      <h1>勉強法動画サイト</h1>
      <p>あなたの勉強に役立つ動画がきっとあります。</p>
    </div>
    <div class="container accordion" id="collapse-accordion">
      <?php for($i = 0; $i <= $category_count-1; $i++) : ?>
      <div class="card mb-2">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button
              class="btn btn-light btn-block text-left"
              type="button"
              data-toggle="collapse"
              data-target="#collapse-accordion-<?php echo $i ?>"
            >
              <?php echo $bc_category[$i] ?>
            </button>
          </h5>
        </div>
        <div
          id="collapse-accordion-<?php echo $i ?>"
          class="collapse"
          data-parent="#collapse-accordion"
        >
          <?php $count = count($arr["res"]["videoContentsData"][$i]["videos"]) ?>
          <?php for($j = 0; $j <= $count-1; $j++) : ?>
          <div class="card-body">
            <a
              class="btn btn-light btn-block"
              href="<?php echo $bc_video_url[$i]{$j} ?>"
              role="button"
            >
              <?php echo $bc_video_title[$i][$j] ?>
            </a>
          </div>
          <? endfor; ?>
        </div>
      </div>
      <?php endfor; ?>
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

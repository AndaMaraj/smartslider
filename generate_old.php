<?php
/**
 * Created by PhpStorm.
 * User: Anda
 * Date: 3/22/2018
 * Time: 9:00 PM
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $size_names = array("300x100", "300x250", "728x90", "980x250", "990x250", "990x30", "990x60");
    $size_widths = array("300", "300", "728", "980", "990", "990", "990");
    $size_heights = array("100", "250", "90", "250", "220", "30", "60");
    $filePlaces = array();
    $parashtese = $_POST["name_prefix"];
    $url = $_POST["url"];
    $kaUrl = strlen($url) > 0;
    $sizeIndex = $_POST["size"];
    $madhesia = $size_names[$sizeIndex];
    $koha = $_POST["koha"];
    if (!empty($_FILES['upfiles']['name'])) {
        $i = 0;
        while ($i < count($_FILES["upfiles"]["name"])) {
            $target_dir = "assets/";
            $fileName = $_FILES["upfiles"]["name"][$i];
            $fileType = $_FILES["upfiles"]["type"][$i];
            $fileSize = $_FILES["upfiles"]["size"][$i];
            $fileTemp = $_FILES["upfiles"]["tmp_name"][$i];
            $tt = explode(".", $fileName);
            $target_file = $target_dir . basename($parashtese . "_" . time() . "_" . ($i + 1) . '_' . $madhesia . '.jpg');
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($fileTemp);
            $uploadOk = 1;
            if ($check !== false) {
                if (file_exists($target_file)) {
                    unlink($target_file);
                }
                if ($fileSize <= 500000) {
                    if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                        if (move_uploaded_file($fileTemp, $target_file)) {
                            array_push($filePlaces, $target_file);
                        } else {
                            $uploadOk = 0;
                            $message = "Immagine non inserito!";
                        }
                    } else {
                        echo "<Br>Formato del immagine:" . $imageFileType;
                    }
                }
            }
            $i++;
        }

        if ($uploadOk == 1) {
            $content = '<!DOCTYPE html>
                            <html>
                               <head>
                                  <title></title>
                                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                  <style type="text/css">
                                     #slideshow {
                                     margin: 50px auto;
                                     position: relative;
                                     width: ' . $size_widths[$sizeIndex] . 'px;
                                     height: ' . $size_heights[$sizeIndex] . 'px;
                                     padding: 10px;
                                     box-shadow: 0 0 10px rgba(0,0,0,0.4);
                                     }
                                     #slideshow > div {
                                     position: absolute;
                                     top: 10px;
                                     left: 10px;
                                     right: 10px;
                                     bottom: 10px;
                                     }
                                     img{
                                     width: ' . $size_widths[$sizeIndex] . 'px;
                                     height: ' . $size_heights[$sizeIndex] . 'px;
                                     }
                                  </style>
                                  <script type="text/javascript">
                                     $(document).ready(function(){
                                     $("#slideshow > div:gt(0)").hide();

                                     setInterval(function() {
                                     $(\'#slideshow > div:first\')
                                       .fadeOut(1000)
                                       .next()
                                       .fadeIn(1000)
                                       .end()
                                       .appendTo(\'#slideshow\');
                                     },  '.($koha*1000).');
                                     });
                                  </script>
                               </head>
                               <body>
                                  <div id="slideshow">
                                    ';
            foreach ($filePlaces as $filePlace) {
                $content .= '<div>';
                if ($kaUrl)
                    $content .= '<a href="' . $url . '" target="_blank" rel="nofollow">';
                $content .= '<img src="http://localhost/smartslider/' . $filePlace . '"/>';
                if ($kaUrl)
                    $content .= '</a>';
                $content .= "</div>";
            }
            $content .= '</div>
                               </body>
                            </html>';

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-disposition: attachment; filename=' . $parashtese . '_' . $madhesia . '.html');
            header('Content-Length: ' . strlen($content));
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Expires: 0');
            header('Pragma: public');
            echo $content;
            exit;
        }
    }
} else {
    ?>
    <html>
    <head>
      <title>Crea Banner</title>
      <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/ion.rangeSlider.css">
      <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css">
      <link rel="stylesheet" href="css/jquery.bxslider.css">
      <link rel="stylesheet" href="css/jquery.fancybox.css">
      <link rel="stylesheet" href="css/flexslider.css">
      <link rel="stylesheet" href="css/swiper.css">
      <link rel="stylesheet" href="css/swiper.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/media.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/custom.css">
    </head>
    <body>
    <form method="post" enctype="multipart/form-data" class="my-form">
      <p class="h3 text-center mb-3">Crea Banner</p>
        <p class="paragraph">
          <label for="defaultFormLoginEmailEx" class="grey-text">Denominazione del banner:</label>
          <input type="text" name="name_prefix" class="form-control">
        </p>
        <p class="paragraph">
          <label for="defaultFormLoginEmailEx" class="grey-text">Dimensione:</label>
          <select name="size">
              <option value="0" selected="selected">300x100</option>
              <option value="1" selected="selected">300x250</option>
              <option value="2" selected="selected">728x90</option>
              <option value="3" selected="selected">980x250</option>
              <option value="4" selected="selected">990x250</option>
              <option value="5" selected="selected">990x30</option>
              <option value="6" selected="selected">990x60</option>
          </select>
        </p>
        <p class="paragraph">
          <label for="defaultFormLoginEmailEx" class="grey-text">Url:</label>
          <input type="text" name="url" class="form-control">
        </p>
        <p class="paragraph">
          <label for="defaultFormLoginEmailEx" class="grey-text">Tempo in secondi (s):</label>
          <input type="number" min="1" max="10" name="koha" class="form-control">
        </p>
        <p class="paragraph">
          <label for="defaultFormLoginEmailEx" class="grey-text">Immagini:</label>
          <input type="file" name="upfiles[]" multiple class="form-control">
        </p>
        <p class="paragraph">
          <input type="submit" value="generate" class="btn btn-primary">
        </p>
    </form>
    </body>
    </html>
    <?php
}
?>

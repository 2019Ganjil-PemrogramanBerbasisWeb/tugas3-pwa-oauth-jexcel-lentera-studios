<?php
    $target_dir = "upload/";
    $target_file = $target_dir.basename($_FILES["gambarUser"]["name"]);
    $tmp_file = basename($_FILES["gambarUser"]["tmp_name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $valid = 1;

    move_uploaded_file($_FILES["gambarUser"]["tmp_name"], $target_file);

    if(isset($_POST["submit"])){
        $img_size = getimagesize($target_file);
        if($img_size != true){
            $valid = 0;
            echo "Bukan sebuah gambar.";
        } else{
            $img_w = $img_size[0];
            $img_h = $img_size[1];
        }

        $source_pict = imagecreatefromfile('img/twibbon.png');
        if($imageFileType == "jpg" || $imageFileType == "jpeg"){
            $target_pict = imagecreatefromfile($target_file);
        } else if($imageFileType == "png"){
            $target_pict = imagecreatefromfile($target_file);
        } else{
            $valid = 0;
            echo "Maaf hanya ekstensi PNG, JPG, dan JPEG yang diperbolehkan";
        }

        if($valid == 1){
            $result_pict = imagecreatetruecolor(1000, 1000);

            if($img_w > $img_h){
                $crop_pict = imagecrop($target_pict, ['x' => ($img_w - $img_h) / 2, 'y' => 0, 'width' => $img_h, 'height' => $img_h]);
                imagecopyresampled($result_pict, $crop_pict, 0, 0, 0, 0, 1000, 1000, $img_h, $img_h);
            } else if($img_h > $img_w){
                $crop_pict = imagecrop($target_pict, ['x' => 0, 'y' => ($img_h - $img_w) / 2, 'width' => $img_w, 'height' => $img_w]);
                imagecopyresampled($result_pict, $crop_pict, 0, 0, 0, 0, 1000, 1000, $img_w, $img_w);
            } else{
                imagecopyresampled($result_pict, $target_pict, 0, 0, 0, 0, 1000, 1000, $img_w, $img_h);
            }

            imagealphablending($source_pict, true);
            imagesavealpha($source_pict, true);

            imagecopy($result_pict, $source_pict, 0, 0, 0, 0, 1000, 1000);

            ob_start();
            imagepng($result_pict);

            $pict = ob_get_clean();

            // header('Content-Type: image/png');
            // echo '<img src="data:image/png;base64,'.base64_encode($pict).'" />';
            // header('Content-Disposition: Attachment;filename=twibbon.png');
            // echo '<a href="data:image/png;base64,'.base64_encode($pict).'" download>Download</a>';
        }
    }
?>

<html>
    <head>
        <title>Twibbon.in</title>
        <link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="manifest" href="manifest.json">
        <meta name="description" content="Pasang Twibbon ILITS Anda">
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            // This is the "Offline page" service worker

            // Add this below content to your HTML page, or add the js file to your page at the very top to register service worker

            // Check compatibility for the browser we're running this in
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('swork.js', {scope: './'})
                        .then((reg) => {
                        console.log('Service worker registered.', reg);
                        });
                });
            } else{
                console.log("Active service worker found, no need to register");
            }
        </script>
    </head>
    <body>
        <div class="row no-gutters">
            <div id="left" class="col-6">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col-6">
                        <img src="img/hero.svg" alt="" style="text-align: center;">
                    </div>
                </div>
            </div>
            <div id="right" class="col-6">
                <img src="data:image/png;base64,<?php echo base64_encode($pict) ?>">
                <a href="data:image/png;base64,<?php echo base64_encode($pict) ?>" download="MyTwibbon.png">Download</a>
            </div>
        </div>
    </body>
</html>

<?php
    imagedestroy($source_pict);
    imagedestroy($target_pict);
    imagedestroy($crop_pict);
    imagedestroy($result_pict);
?>
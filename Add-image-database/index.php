
<?php
if ($_POST) {
    $tmp_id = $_GET['id'];
    if ($_FILES["weare_img"]["name"]) {

        $resimadi = $_FILES["weare_img"]["name"];
        $resimYolu = "assets/upload/" . $resimadi;

        if (move_uploaded_file($_FILES["weare_img"]["tmp_name"], $resimYolu)) {



            $ekle = $db->prepare("UPDATE weare  SET 
                     weare_title =:weare_title,
                     weare_desc =:weare_desc,
                     weare_img =:weare_img WHERE id=:id");

            $ekle->execute([
                "weare_title" => $_POST["weare_title"],

                "weare_desc" => $_POST["weare_desc"],
                "weare_img" => $resimadi,
                "id" => $tmp_id
            ]);

            if ($ekle) {
                header("location:weare.php?status=ok");
            } else {
                header("location:weare.php?status=no");
            }
        }
    } else {
        $ekle = $db->prepare("UPDATE weare  SET 
                    weare_title =:weare_title,
                    weare_desc =:weare_desc
                   WHERE id=:id");

        $ekle->execute([
            "weare_title" => $_POST["weare_title"],

            "weare_desc" => $_POST["weare_desc"],

            "id" => $tmp_id
        ]);

        if ($ekle) {
            header("location:weare.php?status=ok");
        } else {
            header("location:weare.php?status=no");
        }
    }
}


?>

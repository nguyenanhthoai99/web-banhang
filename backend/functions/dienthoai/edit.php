<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật Sản Phẩm Tablet</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link href="/nguyenanhthoai/assets/vendor/DataTables/datatables.css" type="text/css" rel="stylesheet" />
    <link href="/nguyenanhthoai/assets/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css" type="text/css" rel="stylesheet" />
    <?php include_once(__DIR__ . '/../../layouts/partials/config.php'); ?>
</head>


<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <div class="container" style="margin-top: 80px;">
        <h2>Cập Nhật Tablet</h2>
        <?php
        include_once(__DIR__ . '/../../../dbconnect.php');

        $sp_ma = $_GET['sp_ma'];
        $sqlSanPham = "SELECT * FROM sanpham WHERE sp_ma = $sp_ma";
        $resultSanPham = mysqli_query($conn, $sqlSanPham);
        $dataSanPham = [];
        while ($rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
            $dataSanPham[] = array(
                'sp_ma' => $rowSanPham['sp_ma'],
                'sp_ten' => $rowSanPham['sp_ten'],
                'sp_gia' => $rowSanPham['sp_gia'],
                'sp_giacu' => $rowSanPham['sp_giacu'],
                'sp_soluong' => $rowSanPham['sp_soluong'],
                'sp_ngaycapnhat' => $rowSanPham['sp_ngaycapnhat'],
                'nsx_ma' => $rowSanPham['nsx_ma'],
                'sp_hinh' => $rowSanPham['sp_hinh'],
                'sp_hinhchitiet' => $rowSanPham['sp_hinhchitiet'],
                'dt_ma' => $rowSanPham['dt_ma'],
                'km_ma' => $rowSanPham['km_ma']

            );
        }
        $dataSanPham = $dataSanPham[0];

        $sqlNhaSanXuat = "SELECT * FROM nhasanxuat";
        $resultNhaSanXuat = mysqli_query($conn, $sqlNhaSanXuat);
        $dataNhaSanXuat = [];
        while ($rowNhaSanXuat = mysqli_fetch_array($resultNhaSanXuat, MYSQLI_ASSOC)) {
            $dataNhaSanXuat[] = array(
                'nsx_ten' => $rowNhaSanXuat['nsx_ten'],
                'nsx_ma' => $rowNhaSanXuat['nsx_ma']
            );
        }

        $sqlLoaiSanPham = "SELECT * FROM loaisanpham";
        $resultLoaiSanPham = mysqli_query($conn, $sqlLoaiSanPham);
        $dataLoaiSanPham = [];
        while ($rowLoaiSanPham = mysqli_fetch_array($resultLoaiSanPham, MYSQLI_ASSOC)) {
            $dataLoaiSanPham[] = array(
                'lsp_ten' => $rowLoaiSanPham['lsp_ten'],
                'lsp_ma' => $rowLoaiSanPham['lsp_ma']
            );
        }

        $sqlKhuyenMai = "SELECT * FROM khuyenmai ";
        $resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);
        $dataKhuyenMai = [];
        while ($rowKhuyenMai = mysqli_fetch_array($resultKhuyenMai, MYSQLI_ASSOC)) {
            $km_tomtat = '';
            if (!empty($rowKhuyenMai['km_ten'])) {
                if ($rowKhuyenMai['km_ma'] != 0) {
                    $km_tomtat = sprintf(
                        "Khuyến mãi: %s, nội dung: %s, thời gian: %s",
                        $rowKhuyenMai['km_ten'],
                        $rowKhuyenMai['km_noidung'],
                        $rowKhuyenMai['km_qua']

                    );
                } else {
                    $km_tomtat = sprintf(
                        "Khuyến mãi: %s",
                        $rowKhuyenMai['km_ten']
                    );
                }
            }
            $dataKhuyenMai[] = array(
                'km_ma' => $rowKhuyenMai['km_ma'],
                'km_tomtat' => $km_tomtat,
            );
        }

        $sqlDienThoai = "SELECT * FROM dienthoai WHERE dt_ma =" . $dataSanPham['dt_ma'];
        $resultDienThoai = mysqli_query($conn, $sqlDienThoai);
        $dataDienthoai = [];
        while ($rowDienThoai = mysqli_fetch_array($resultDienThoai, MYSQLI_ASSOC)) {
            $dataDienthoai[] = array(
                'dt_manhinh' => $rowDienThoai['dt_manhinh'],
                'dt_ten' => $rowDienThoai['dt_ten'],
                'dt_hedieuhanh' => $rowDienThoai['dt_hedieuhanh'],
                'dt_camerasau' => $rowDienThoai['dt_camerasau'],
                'dt_cameratruoc' => $rowDienThoai['dt_cameratruoc'],
                'dt_cpu' => $rowDienThoai['dt_cpu'],
                'dt_ram' => $rowDienThoai['dt_ram'],
                'dt_bonhotrong' => $rowDienThoai['dt_bonhotrong'],
                'dt_thenho' => $rowDienThoai['dt_thenho'],
                'dt_sim' => $rowDienThoai['dt_sim'],
                'dt_dungluongpin' => $rowDienThoai['dt_dungluongpin']

            );
        }
        $dataDienthoai = $dataDienthoai[0];
        ?>
        <form name="frmsanpham" id="frmsanpham" method="post" action="" class="mt-1" enctype="multipart/form-data">
            <div class="form-group">
                <?php
                if (isset($_POST["btnSave"])) {
                    $loi = kiemTraLoi();
                    if ($loi)
                        echo "<div style='background-color: #D88383; color: white;'>" . $loi . "</div>";
                }
                ?>
                <label for="sp_ten">Tên Sản phẩm Điện Thoại</label>
                <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên Sản phẩm Điện Thoại" value="<?= $dataSanPham['sp_ten'] ?>">
            </div>
            <div class="form-group">
                <img src="/nguyenanhthoai/fontend/images/dienthoai/<?= $dataSanPham['sp_hinh'] ?>" id="hinhDemo" name="hinhDemo" width="300px" height="300px">
            </div>
            <div class="form-group">
                <label for="sp_hinh">Hình Điện Thoại Đại Diện</label>
                <input type="file" class="form-control" id="sp_hinh" name="sp_hinh" placeholder="Hình Điện Thoại Đại Diện" onchange="showHinh()">
            </div>

            <div class="form-group">
                <img src="/nguyenanhthoai/fontend/images/dienthoai/<?= $dataSanPham['sp_hinhchitiet'] ?>" id="hinhDemoChiTiet" name="hinhDemoChiTiet" width="300px" height="300px">
            </div>
            <div class="form-group">
                <label for="sp_hinhchitiet">Hình Sản Phẩm Điện Thoại</label>
                <input type="file" class="form-control" id="sp_hinhchitiet" name="sp_hinhchitiet" placeholder="Hình Sản Phẩm Điện Thoại" onchange="showHinh()">
            </div>
            <div class="form-group">
                <label for="sp_gia">Giá Sản phẩm</label>
                <input type="text" class="form-control" id="sp_gia" name="sp_gia" placeholder="Giá Sản phẩm (VNĐ)" value="<?= $dataSanPham['sp_gia'] ?>">
            </div>
            <div class="form-group">
                <label for="sp_giacu">Giá cũ Sản phẩm</label>
                <input type="text" class="form-control" id="sp_giacu" name="sp_giacu" placeholder="Giá cũ Sản phẩm (VNĐ)" value="<?= $dataSanPham['sp_giacu'] ?>">
            </div>
            <div class="form-group">
                <label for="sp_ngaycapnhat">Ngày cập nhật</label>
                <input type="text" class="form-control" id="sp_ngaycapnhat" name="sp_ngaycapnhat" placeholder="Ngày cập nhật Sản phẩm (VD:2020-09-20 00:00:00)" value="<?= $dataSanPham['sp_ngaycapnhat'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="sp_soluong">Số lượng</label>
                <input type="text" class="form-control" id="sp_soluong" name="sp_soluong" placeholder="Số lượng Sản phẩm" value="<?= $dataSanPham['sp_soluong'] ?>">
            </div>
            <div class="form-group">
                <label for="nsx_ma">Nhà sản xuất</label>
                <select class="form-control" id="nsx_ma" name="nsx_ma">
                    <?php foreach ($dataNhaSanXuat as $nhasanxuat) : ?>
                        <?php if ($nhasanxuat['nsx_ma'] == $dataSanPham['nsx_ma']) : ?>
                            <option value="<?= $nhasanxuat['nsx_ma'] ?>" selected><?= $nhasanxuat['nsx_ten'] ?></option>
                        <?php else : ?>
                            <option value="<?= $nhasanxuat['nsx_ma'] ?>"><?= $nhasanxuat['nsx_ten'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="dt_manhinh">Màn Hình</label>
                <input type="text" class="form-control" id="dt_manhinh" name="dt_manhinh" placeholder="Màn hình điện thoại" value="<?= $dataDienthoai['dt_manhinh'] ?>">
            </div>
            <div class="form-group">
                <label for="dt_hedieuhanh">Hệ điều hành</label>
                <input type="text" class="form-control" id="dt_hedieuhanh" name="dt_hedieuhanh" placeholder="Hệ điều hành điện thoại" value="<?= $dataDienthoai['dt_hedieuhanh'] ?>">
            </div>
            <div class="form-group">
                <label for="dt_camerasau">Camera sau</label>
                <input type="text" class="form-control" id="dt_camerasau" name="dt_camerasau" placeholder="Camera sau điện thoại" value="<?= $dataDienthoai['dt_camerasau'] ?>">
            </div>
            <div class="form-group">
                <label for="dt_cameratruoc">Camera trước</label>
                <input type="text" class="form-control" id="dt_cameratruoc" name="dt_cameratruoc" placeholder="Camera trước điện thoại" value="<?= $dataDienthoai['dt_cameratruoc'] ?>">
            </div>
            <div class="form-group">
                <label for="dt_cpu">CPU</label>
                <input type="text" class="form-control" id="dt_cpu" name="dt_cpu" placeholder="CPU điện thoại" value="<?= $dataDienthoai['dt_cpu'] ?>">
            </div>
            <div class="form-group">
                <label for="dt_ram">RAM</label>
                <input type="text" class="form-control" id="dt_ram" name="dt_ram" placeholder="Ram điện thoại" value="<?= $dataDienthoai['dt_ram'] ?>">
            </div>
            <div class="form-group">
                <label for="dt_bonhotrong">Bộ Nhớ Trong</label>
                <input type="text" class="form-control" id="dt_bonhotrong" name="dt_bonhotrong" placeholder="Bộ Nhớ Trong điện thoại" value="<?= $dataDienthoai['dt_bonhotrong'] ?>">
            </div>
            <div class="form-group">
                <label for="dt_thenho">Thẻ Nhớ</label>
                <input type="text" class="form-control" id="dt_thenho" name="dt_thenho" placeholder="Thẻ nhớ điện thoại" value="<?= $dataDienthoai['dt_thenho'] ?>">
            </div>
            <div class="form-group">
                <label for="dt_sim">Thẻ SIM</label>
                <input type="text" class="form-control" id="dt_sim" name="dt_sim" placeholder="SIM điện thoại" value="<?= $dataDienthoai['dt_sim'] ?>">
            </div>
            <div class="form-group">
                <label for="dt_dungluongpin">Dung lượng pin</label>
                <input type="text" class="form-control" id="dt_dungluongpin" name="dt_dungluongpin" placeholder="Dung lượng pin điện thoại" value="<?= $dataDienthoai['dt_dungluongpin'] ?>">
            </div>
            <div class="form-group">
                <label for="km_ma">Khuyến mãi</label>
                <select class="form-control" id="km_ma" name="km_ma">
                    <?php foreach ($dataKhuyenMai as $khuyenmai) : ?>
                        <?php if ($khuyenmai['km_ma'] == $dataSanPham['km_ma']) : ?>
                            <option value="<?= $khuyenmai['km_ma'] ?>" selected><?= $khuyenmai['km_tomtat'] ?></option>
                        <?php else : ?>
                            <option value="<?= $khuyenmai['km_ma'] ?>"><?= $khuyenmai['km_tomtat'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <button class="btn btn-primary btn-lg btn-block" name="btnSave">Lưu dữ liệu</button>
                </div>
                <div class="col-md-7 text-right">
                    <a href="index.php"><button type="button" class="btn btn-info btn-md">Quay Về</button></a>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['btnSave'])) {
            $loi = kiemTraLoi();
            if ($loi) {
                return;
            }
            
            $sp_ten = htmlentities($_POST["sp_ten"]);
            $sp_giacu = htmlentities($_POST["sp_giacu"]);
            $sp_gia = htmlentities($_POST["sp_gia"]);
            $sp_ngaycapnhat =htmlentities($_POST["sp_ngaycapnhat"]);
            $sp_soluong = htmlentities($_POST["sp_soluong"]);
            $nsx_ma = htmlentities($_POST["nsx_ma"]);
            $km_ma = htmlentities($_POST["km_ma"]);
            $dt_manhinh = htmlentities($_POST["dt_manhinh"]);
            $dt_hedieuhanh = htmlentities($_POST["dt_hedieuhanh"]);
            $dt_camerasau = htmlentities($_POST["dt_camerasau"]);
            $dt_cameratruoc = htmlentities($_POST["dt_cameratruoc"]);
            $dt_cpu = htmlentities($_POST["dt_cpu"]);
            $dt_ram = htmlentities($_POST["dt_ram"]);
            $dt_bonhotrong = htmlentities($_POST["dt_bonhotrong"]);
            $dt_thenho = htmlentities($_POST["dt_thenho"]);
            $dt_sim = htmlentities($_POST["dt_sim"]);
            $dt_dungluongpin = htmlentities($_POST["dt_dungluongpin"]);

            if (isset($_FILES['sp_hinh'])) {
                $upload_dir_sp_hinh = __DIR__ . "/../../../fontend/images/dienthoai/";
                if ($_FILES['sp_hinh']['name'] == null) {
                    $tentaptin_hinh = $dataSanPham['sp_hinh'];
                } else {
                    $old_file_sp_hinh = $upload_dir_sp_hinh . $dataSanPham['sp_hinh'];
                    if (file_exists($old_file_sp_hinh)) {
                        unlink($old_file_sp_hinh);
                    }
                    $sp_hinh = $_FILES['sp_hinh']['name'];
                    $tentaptin_hinh = date('YdmHis') . '_' . $sp_hinh;
                    move_uploaded_file($_FILES['sp_hinh']['tmp_name'], $upload_dir_sp_hinh . $tentaptin_hinh);
                }
            }


            if (isset($_FILES['sp_hinhchitiet'])) {
                $upload_dir_sp_hinhChiTiet = __DIR__ . "/../../../fontend/images/dienthoai/";

                if ($_FILES['sp_hinhchitiet']['name'] == null) {
                    $tentaptin_hinhchitiet = $dataSanPham['sp_hinhchitiet'];
                } else {
                    $old_file_sp_hinhChiTiet = $upload_dir_sp_hinhChiTiet . $dataSanPham['sp_hinhchitiet'];
                    if (file_exists($old_file_sp_hinhChiTiet)) {
                        unlink($old_file_sp_hinhChiTiet);
                    }

                    $sp_hinhchitiet = $_FILES['sp_hinhchitiet']['name'];
                    $tentaptin_hinhchitiet = date('YdmHis') . '_' . $sp_hinhchitiet;
                    move_uploaded_file($_FILES['sp_hinhchitiet']['tmp_name'], $upload_dir_sp_hinhChiTiet . $tentaptin_hinh);
                }
            }



            $sqlDienThoai = "UPDATE dienthoai	SET dt_ten='$sp_ten', dt_manhinh='$dt_manhinh', dt_hedieuhanh='$dt_hedieuhanh',	dt_camerasau='$dt_camerasau', dt_cameratruoc='$dt_cameratruoc', dt_cpu='$dt_cpu', dt_ram='$dt_ram', dt_bonhotrong='$dt_bonhotrong', dt_thenho='$dt_thenho', dt_sim='$dt_sim', dt_dungluongpin='$dt_dungluongpin' WHERE dt_ma =" . $dataSanPham['dt_ma'];
            // print_r($sqlDienThoai);
            // die;
            mysqli_query($conn, $sqlDienThoai);

            $sqlSanPham = "UPDATE sanpham SET sp_ten = '$sp_ten', sp_gia = $sp_gia, sp_giacu = $sp_giacu, sp_soluong = $sp_soluong,	sp_ngaycapnhat= NOW(), nsx_ma = $nsx_ma, sp_hinh='$tentaptin_hinh', sp_hinhchitiet='$tentaptin_hinhchitiet', km_ma = $km_ma WHERE sp_ma =" . $sp_ma;
            // print_r($sqlSanPham);
            // die;
            mysqli_query($conn, $sqlSanPham);

            mysqli_close($conn);
            echo "<script>alert('Bạn cập nhật sản phẩm thành công')</script>";
            echo "<script>location.href = 'index.php';</script>";
        }
        ?>
    </div>

    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
</body>

</html>

<script>
    document.getElementById('sp_hinh').onchange = function(evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function() {
                document.getElementById("hinhDemo").src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        } else {

        }
    }

    document.getElementById('sp_hinhchitiet').onchange = function(evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function() {
                document.getElementById("hinhDemoChiTiet").src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        } else {

        }
    }
</script>

<?php

function kiemTraLoi()
{
    $loi = "";
    $sp_ten = $_POST["sp_ten"];
    $sp_giacu = $_POST["sp_giacu"];
    $sp_gia = $_POST["sp_gia"];
    $dt_manhinh = $_POST["dt_manhinh"];
    $dt_hedieuhanh = $_POST["dt_hedieuhanh"];
    $dt_camerasau = $_POST["dt_camerasau"];
    $dt_cameratruoc = $_POST["dt_cameratruoc"];
    $dt_cpu = $_POST["dt_cpu"];
    $dt_ram = $_POST["dt_ram"];
    $dt_bonhotrong = $_POST["dt_bonhotrong"];
    $dt_thenho = $_POST["dt_thenho"];
    $dt_sim = $_POST["dt_sim"];
    $dt_dungluongpin = $_POST["dt_dungluongpin"];

    if (empty($sp_ten)) {
        $loi .= "Tên Sản Phẩm không được rỗng <br>";
    } else {
        if (strlen($sp_ten) < 3) {
            $loi .= "Tên Sản Phẩm không được ít hơn 3 ký tự <br>";
        }
        if (strlen($sp_ten) > 30) {
            $loi .= "Tên Sản Phẩm  không được vượt quá 30 ký tự <br>";
        }
    }

    if (empty($sp_gia)) {
        $loi .= "Giá Sản Phẩm không được rỗng <br>";
    } else {
        if (($sp_gia < 0)) {
            $loi .= "Giá Sản Phẩm không được âm <br>";
        } else {
            if (strlen($sp_gia) < 3) {
                $loi .= "Giá Sản Phẩm không được ít hơn 3 ký tự <br>";
            }
            if (strlen($sp_gia) > 30) {
                $loi .= "Giá Sản Phẩm không được vượt quá 30 ký tự <br>";
            }
        }
    }

    if (empty($sp_giacu)) {
        $loi .= "Giá Sản Cũ Phẩm không được rỗng <br>";
    } else {
        if (($sp_giacu < 0)) {
            $loi .= "Giá Sản Cũ Phẩm không được âm <br>";
        } else {
            if (strlen($sp_giacu) < 3) {
                $loi .= "Giá Sản Cũ Phẩm không được ít hơn 3 ký tự <br>";
            }
            if (strlen($sp_giacu) > 30) {
                $loi .= "Giá Sản Cũ Phẩm không được vượt quá 30 ký tự <br>";
            }
        }
    }


    if (($_FILES['sp_hinh']['name']) != NULL) {
        if (!($_FILES['sp_hinh']['type'] == "image/png" || $_FILES['sp_hinh']['type'] == "image/jpeg" || $_FILES['sp_hinh']['type'] == "image/gif" || $_FILES['sp_hinh']['type'] == "image/jpg" || $_FILES['sp_hinh']['type'] == "image/PSD" || $_FILES['sp_hinh']['type'] == "image/PDF")) {
            $loi .= "File hình sản phẩm đại diện phải là file ảnh <br>";
        } else {
            if ($_FILES['sp_hinh']['size'] > 25600) {
                $loi .= "File hình sản phẩm đại diện không vượt quá 25mb <br>";
            }
        }
    }

    if (($_FILES['sp_hinhchitiet']['name']) != NULL) {
        if (!($_FILES['sp_hinhchitiet']['type'] == "image/png" || $_FILES['sp_hinhchitiet']['type'] == "image/jpeg" || $_FILES['sp_hinhchitiet']['type'] == "image/gif" || $_FILES['sp_hinhchitiet']['type'] == "image/jpg" || $_FILES['sp_hinhchitiet']['type'] == "image/PSD" || $_FILES['sp_hinhchitiet']['type'] == "image/PDF")) {
            $loi .= "File hình sản phẩm chi tiết phải là file ảnh <br>";
        } else {
            if ($_FILES['sp_hinhchitiet']['size'] > 25600) {
                $loi .= "File hình sản phẩm chi tiết không vượt quá 25mb <br>";
            }
        }
    }



    if (empty($dt_manhinh)) {
        $loi .= "Màn hình điện thoại không được rỗng <br>";
    } else {
        if (strlen($dt_manhinh) < 3) {
            $loi .= "Màn hình điện thoại không được ít hơn 3 ký tự <br>";
        }
        if (strlen($dt_manhinh) > 50) {
            $loi .= "Màn hình điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($dt_hedieuhanh)) {
        $loi .= "Hệ diều hành điện thoại không được rỗng <br>";
    } else {
        if (strlen($dt_hedieuhanh) < 3) {
            $loi .= "Hệ diều hành điện thoạikhông được ít hơn 3 ký tự <br>";
        }
        if (strlen($dt_hedieuhanh) > 50) {
            $loi .= "Hệ diều hành điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($dt_camerasau)) {
        $loi .= "Camera sau điện thoại không được rỗng <br>";
    } else {
        if (strlen($dt_camerasau) < 2) {
            $loi .= "Camera sau điện thoại không được ít hơn 2 ký tự <br>";
        }
        if (strlen($dt_camerasau) > 50) {
            $loi .= "Camera sau điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($dt_cameratruoc)) {
        $loi .= "Camera trước điện thoại không được rỗng <br>";
    } else {
        if (strlen($dt_cameratruoc) < 2) {
            $loi .= "Camera trước điện thoại không được ít hơn 2 ký tự <br>";
        }
        if (strlen($dt_cameratruoc) > 50) {
            $loi .= "Camera trước điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($dt_cpu)) {
        $loi .= "CPU điện thoại không được rỗng <br>";
    } else {
        if (strlen($dt_cpu) < 2) {
            $loi .= "CPU điện thoại không được ít hơn 2 ký tự <br>";
        }
        if (strlen($dt_cpu) > 50) {
            $loi .= "CPU điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($dt_ram)) {
        $loi .= "Ram điện thoại không được rỗng <br>";
    } else {
        if (strlen($dt_ram) < 3) {
            $loi .= "Ram điện thoại  không được ít hơn 3 ký tự <br>";
        }
        if (strlen($dt_ram) > 50) {
            $loi .= "Ram điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($dt_bonhotrong)) {
        $loi .= "Bộ Nhớ Trong điện thoại không được rỗng <br>";
    } else {
        if (strlen($dt_bonhotrong) < 2) {
            $loi .= "Bộ Nhớ Trong điện thoại không được ít hơn 2 ký tự <br>";
        }
        if (strlen($dt_bonhotrong) > 50) {
            $loi .= "Bộ Nhớ Trong điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($dt_thenho)) {
        $loi .= "Thẻ nhớ điện thoại không được rỗng <br>";
    } else {
        if (strlen($dt_thenho) < 2) {
            $loi .= "Thẻ nhớ điện thoại không được ít hơn 2 ký tự <br>";
        }
        if (strlen($dt_thenho) > 50) {
            $loi .= "Thẻ nhớ điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($dt_sim)) {
        $loi .= "SIM điện thoại không được rỗng <br>";
    } else {
        if (strlen($dt_sim) < 3) {
            $loi .= "SIM điện thoại không được ít hơn 3 ký tự <br>";
        }
        if (strlen($dt_sim) > 50) {
            $loi .= "SIM điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($dt_dungluongpin)) {
        $loi .= "Dung lượng điện thoại không được rỗng <br>";
    } else {
        if (strlen($dt_dungluongpin) < 3) {
            $loi .= "Dung lượng điện thoại không được ít hơn 3 ký tự <br>";
        }
        if (strlen($dt_dungluongpin) > 50) {
            $loi .= "Dung lượng điện thoạikhông được vượt quá 50 ký tự <br>";
        }
    }


    return $loi;
}

?>
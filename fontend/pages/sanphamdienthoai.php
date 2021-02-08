<?php
if (session_id() === '') {
    session_start();
}

?>
<?php
include_once(__DIR__ . '/../../dbconnect.php');

$itemId = $_GET["item"];
$slq = <<<OTE
    SELECT sp.sp_ma, sp.sp_gia, sp.sp_giacu, sp.sp_hinhchitiet, dt.dt_ten, dt.dt_manhinh, dt.dt_hedieuhanh,
    dt.dt_camerasau, dt.dt_cameratruoc, dt.dt_cpu, dt.dt_ram, dt.dt_bonhotrong, dt.dt_thenho,
    dt.dt_sim, dt.dt_dungluongpin
    FROM sanpham  sp
    JOIN dienthoai dt ON dt.dt_ma = sp.dt_ma
    WHERE sp.sp_ma = $itemId;
OTE;
$result = mysqli_query($conn, $slq);
$dataDienThoai = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $dataDienThoai[] = array(
        'sp_ma' => $row['sp_ma'],
        'sp_gia' => $row['sp_gia'],
        'sp_giacu' => $row['sp_giacu'],
        'sp_hinhchitiet' => $row['sp_hinhchitiet'],
        'dt_manhinh' => $row['dt_manhinh'],
        'dt_ten' => $row['dt_ten'],
        'dt_hedieuhanh' => $row['dt_hedieuhanh'],
        'dt_camerasau' => $row['dt_camerasau'],
        'dt_cameratruoc' => $row['dt_cameratruoc'],
        'dt_cpu' => $row['dt_cpu'],
        'dt_ram' => $row['dt_ram'],
        'dt_bonhotrong' => $row['dt_bonhotrong'],
        'dt_thenho' => $row['dt_thenho'],
        'dt_sim' => $row['dt_sim'],
        'dt_dungluongpin' => $row['dt_dungluongpin']
    );
}

$data = $dataDienThoai[0];
?>
<!DOCTYPE html>
<html lang="en">
<title><?= $data['dt_ten']; ?></title>

<head>
    <?php include_once(__DIR__ . '/../../backend/layouts/partials/config.php') ?>

    <?php
    include_once(__DIR__ . '/../../backend/layouts/styles.php');
    include_once(__DIR__ . '/../layouts/partials/header.php');
    include_once(__DIR__ . '/../../dbconnect.php');
    ?>
    <style>
        .main-sp {
            margin-top: 75px;
            background-color: white;
        }

        body {
            background-color: #f0f0f0;
        }

        .gia-sp-goc {
            color: red;
            font-size: 20px;
        }

        .gia-sp-giam {
            font-size: 20px;
        }

        .main-sanpham .hinh-sp {
            height: 500px;
            width: 100%;
            margin: 25px;
            margin-top: 70px;
        }

        .thongtin-sp {
            border: 1px solid #f0f0f0;
        }

        .tieude-sp {
            font-size: 32px;
            text-align: center;
        }

        .kt-sp {
            margin-left: 70px;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .mua-ngay {
            color: white;
            padding-left: 0px;
            padding-right: 50px;
        }

        .hinh-sp-laptop {
            height: 400px;
            width: 100%;
        }

        .hinh-sp-tablet {
            width: 100%;
            height: 600px;
            padding-top: 5px;
        }

        .hinh-dt-nbat {
            transition: 0.5s ease-in;

        }

        .thongtin-sp {
            margin-top: 75px;
        }

        .thongso-kt {
            font-size: 26px;
            margin-left: 10px;
        }

        .tieude-sp {
            font-size: 26px;
            margin-left: 10px;
        }

        @media only screen and (max-width: 320px) {
            .main-sanpham .hinh-sp {
                width: 100%;
                height: auto;
                margin-left: 0px;
                margin-top: 70px;
            }

            .kt-sp {
                margin-left: 0px;
                border-bottom: 1px solid #f0f0f0;
                margin-bottom: 10px;
                font-size: 12px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongso {
                float: right;
            }

            .thongso-kt {
                font-size: 16px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongtin-sp {
                margin-top: 0px;
            }

            .kt-sp .soluong {
                margin-top: 9px;
            }

            .gia-sp-goc {
                font-size: 16px;
            }

            .gia-sp-giam {
                font-size: 14px;
            }

            .mua-ngay {
                padding-right: 10px;
            }
        }

        @media (min-width: 321px) and (max-width: 375px) {
            .main-sanpham .hinh-sp {
                width: 100%;
                height: auto;
                margin-left: 0px;
                margin-top: 70px;
            }

            .kt-sp {
                margin-left: 0px;
                border-bottom: 1px solid #f0f0f0;
                margin-bottom: 10px;
                font-size: 12px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongso {
                float: right;
            }

            .thongso-kt {
                font-size: 16px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongtin-sp {
                margin-top: 0px;
            }

            .kt-sp .soluong {
                margin-top: 9px;
            }

            .gia-sp-goc {
                font-size: 16px;
            }

            .gia-sp-giam {
                font-size: 14px;
            }

            .mua-ngay {
                padding-right: 10px;
            }
        }

        @media (min-width: 376px) and (max-width: 575.98px) {
            .main-sanpham .hinh-sp {
                width: 100%;
                height: auto;
                margin-left: 0px;
                margin-top: 70px;
            }

            .kt-sp {
                margin-left: 0px;
                border-bottom: 1px solid #f0f0f0;
                margin-bottom: 10px;
                font-size: 14px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongso {
                float: right;
            }

            .thongso-kt {
                font-size: 18px;
            }

            .tieude-sp {
                font-size: 22px;
            }

            .thongtin-sp {
                margin-top: 0px;
            }

            .kt-sp .soluong {
                margin-top: 9px;
            }

            .gia-sp-goc {
                font-size: 18px;
            }

            .gia-sp-giam {
                font-size: 16px;
            }

            .mua-ngay {
                padding-right: 10px;
            }
        }

        @media (min-width: 576px) and (max-width: 763.98px) {
            .main-sanpham .hinh-sp {
                width: 100%;
                height: auto;
                margin-left: 0px;
                margin-top: 70px;
            }

            .kt-sp {
                margin-left: 0px;
                border-bottom: 1px solid #f0f0f0;
                margin-bottom: 10px;
                font-size: 14px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongso {
                float: right;
            }

            .thongso-kt {
                font-size: 18px;
            }

            .tieude-sp {
                font-size: 22px;
            }

            .thongtin-sp {
                margin-top: 0px;
            }

            .kt-sp .soluong {
                margin-top: 9px;
            }

            .gia-sp-goc {
                font-size: 18px;
            }

            .gia-sp-giam {
                font-size: 16px;
            }

            .mua-ngay {
                padding-right: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid mt-3 main-sp">
        <form action="xulymuahang.php?sp_ma=<?= $data['sp_ma']; ?>" method="POST" name="frmSanPham">
            <div class="row main-sanpham">
                <!-- hình sản phẩm -->
                <div class="col-md-5"><img src="/nguyenanhthoai/fontend/images/dienthoai/<?= $data['sp_hinhchitiet']; ?>" class="hinh-sp"></div>
                <!-- end hình sản phẩm -->
                <!-- Thông tin sp -->
                <div class="col-md-7 thongtin-sp">
                    <h1 class="tieude-sp display-4 mt-2"><?= $data['dt_ten']; ?></h1>
                    <hr>
                    <h1 class="thongso-kt">Thông số kỹ thuật</h1>
                    <div class="row kt-sp">
                        <div class="col-md-4 thongso">
                            Màn hình:
                        </div>
                        <div class="col-md-8">
                            <?= $data['dt_manhinh']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class="col-md-4 thongso">
                            Hệ điều hành:
                        </div>
                        <div class="col-md-8">
                            <?= $data['dt_hedieuhanh']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class="col-md-4 thongso">
                            Camera sau:
                        </div>
                        <div class="col-md-8">
                            <?= $data['dt_camerasau']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class="col-md-4 thongso">
                            Camera trước:
                        </div>
                        <div class="col-md-8">
                            <?= $data['dt_cameratruoc']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class="col-md-4 thongso">
                            CPU:
                        </div>
                        <div class="col-md-8">
                            <?= $data['dt_cpu']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class="col-md-4 thongso">
                            RAM:
                        </div>
                        <div class="col-md-8">
                            <?= $data['dt_ram']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class="col-md-4 thongso">
                            Bộ nhớ trong:
                        </div>
                        <div class="col-md-8">
                            <?= $data['dt_bonhotrong']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class="col-md-4 thongso">
                            Thẻ nhớ:
                        </div>
                        <div class="col-md-8">

                            <?= $data['dt_thenho']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class="col-md-4 thongso">
                            Thẻ SIM:
                        </div>
                        <div class="col-md-8">
                            <?= $data['dt_sim']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class="col-md-4 thongso">
                            Dung lượng pin:
                        </div>
                        <div class="col-md-8">
                            <?= $data['dt_dungluongpin']; ?>
                        </div>
                    </div>

                    <div class="row kt-sp">
                        <span class="gia-sp-goc">
                            <?= number_format($data['sp_gia'], 0, ".", ",") . ' vnđ'; ?>
                        </span>&emsp;
                        <span class="gia-sp-giam">
                            <del>
                                <?php
                                if ((($data['sp_giacu'] != null) && ($data['sp_giacu'] > $data['sp_gia'])))
                                    echo number_format($data['sp_giacu'], 0, ".", ",") . ' vnđ';
                                ?>
                            </del>
                        </span>
                    </div>
                    <div class="row kt-sp">
                        <label for="soluong" class="soluong">Số lượng đặt mua:</label>
                        <button type="button" id="btn-Tru" name="btn-Tru" style="width:50px;" onclick="tru()">
                            <i class="fa fa-minus tru"></i>
                        </button>
                        <input type="number" min="1" max="9" class="form-control" id="soluongmua" name="soluongmua" style="width:100px; text-align:center;" value="1">
                        <button type="button" id="btn-Cong" name="btn-Cong" style="width:50px;" onclick="cong()">
                            <i class="fa fa-plus cong"></i>
                        </button>
                    </div>
                    <button type="submit" class="btn btn-warning btn-lg btn-block mb-2 mua-ngay">MUA NGAY</button>
                </div>
                <!-- end thông tin sp -->
            </div>
        </form>
    </div>
    <div class="container-fluid">
        <?php include_once(__DIR__ . '/../layouts/partials/footer.php') ?>
    </div>
</body>
<script>
    var dem = 1;

    function cong() {
        dem = dem + 1;
        if (dem < 10) {
            document.getElementById("soluongmua").value = dem;

        } else {
            dem = 9;
        }
    }

    function tru() {
        dem = dem - 1;
        if (dem > 0) {
            document.getElementById("soluongmua").value = dem;
        } else {
            dem = 1;
        }
    }
</script>

</html>
<?php
include_once(__DIR__ . '/../../../dbconnect.php');

function showDebug($thongbao)
{
    echo '<script type="text/javascript">alert("' . $thongbao . '");</script>';
}

$sp_ma = $_GET['sp_ma'];
$sqlSelectSanPham = " SELECT * FROM sanpham Where sp_ma = $sp_ma";
$resultSanPham   = mysqli_query($conn, $sqlSelectSanPham);
$dataSanPham  = [];
while ($row  = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
    $dataSanPham[] = array(
        'tablet_ma' => $row['tablet_ma'],
        'sp_hinh' => $row['sp_hinh'],
        'sp_hinhchitiet' => $row['sp_hinhchitiet']
    );
}
$data = $dataSanPham[0];

// Hình Sản Phẩm đại diện
// $sp_hinhRow = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC);
$upload_dir_sp_hinh = __DIR__ . "/../../../fontend/images/tablet/";

$old_file_sp_hinh = $upload_dir_sp_hinh . $data['sp_hinh'];
if (file_exists($old_file_sp_hinh)) {

    unlink($old_file_sp_hinh);
}

// Hình Sản Phẩm chi tiết
$upload_dir_sp_hinhChiTiet = __DIR__ . "/../../../fontend/images/tablet/";

$old_file_sp_hinhChiTiet = $upload_dir_sp_hinhChiTiet . $data['sp_hinhchitiet'];
// var_dump($upload_dir_sp_hinhChiTiet . $data['sp_hinhchitiet']);
if (file_exists($old_file_sp_hinhChiTiet)) {

    unlink($old_file_sp_hinhChiTiet);
}


$sqlDeleteSanPham = "DELETE FROM `sanpham` WHERE sp_ma=" . $sp_ma;
// print_r($sqlDeleteSanPham);die;
$result = mysqli_query($conn, $sqlDeleteSanPham);


$sqlDeleteTablet = "DELETE FROM tablet WHERE tablet_ma =" . $data['tablet_ma'];
// showDebug($sqlDeleteDienThoai);

// if (mysqli_query($conn, $sqlDeleteDienThoai) or die(mysqli_error($conn)))
// {
//     showDebug(('blablabla'));
// }
$resultDeleteTablet = mysqli_query($conn, $sqlDeleteTablet);
mysqli_close($conn);
echo "<script>alert('Bạn xóa sản phẩm thành công')</script>";
echo "<script>location.href = 'index.php';</script>";

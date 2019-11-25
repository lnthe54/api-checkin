<?php 
include 'connect.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $userId = $_POST["user_id"];
    $name = $_POST["name"];
    $date = $_POST["date"];
    $gender = $_POST["gender"];
    $identifier = $_POST["identifier"];
    $computer = $_POST["computer"];

    $query = "UPDATE `tb_user` SET `name`='$name',`user_date`='$date',`user_gender`='$gender',`user_identifier`='$identifier',`user_computer`='$computer' WHERE user_id = '$userId'";
    $db = new Connection();
    $connection = $db->get_connection();
    $result = mysqli_query($connection, $query);

    if ($result) {
        $data["message"] = "Cập nhật thành công thành công";
        $data["status"] = 200;
    } else {
        $data["message"] = "Data not saved successfully";
        $data["status"] = 400;    
    }
}
else {
    $data["message"] = "Format not supported";
    $data["status"] = 100;    
}
mysqli_close($connection);
echo json_encode($data);
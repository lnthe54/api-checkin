<?php 
include 'connect.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $userId = $_POST["user_id"];
    $date = $_POST["date"];
    $typeCheckin = $_POST["type_checkin"];
    $reason = $_POST["reason"];

    $query = "INSERT INTO `tb_checkin`(`user_id`, `date`, `type_checkin`, `reason`) VALUES ('$userId','$date','$typeCheckin','$reason')";
    $db = new Connection();
    $connection = $db->get_connection();
    $result = mysqli_query($connection, $query);

    if ($result) {
        $data["message"] = "Chấm công thành công";
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
<?php
    include 'connect.php';
    header('Content-Type: application/json');
    
    $db = new Connection();
    $connection = $db->get_connection();

    mysqli_set_charset($connection,'UTF-8');
    $userId = $_POST["user_id"];

    $query = "SELECT * FROM tb_checkin WHERE user_id = '$userId'";

    $data = mysqli_query($connection, $query);

    class WorkTime{
        function WorkTime($id, $date, $typeCheckin, $reason){
            $this -> id = $id;
            $this -> date = $date;
            $this -> type = $typeCheckin;
            $this -> reason = $reason;
        }
    }

    $arrTime = array();

    while($row = mysqli_fetch_assoc($data)){
        array_push($arrTime, new WorkTime($row['user_id'], $row['date'], $row['type_checkin'], $row['reason']));
    }

    echo json_encode($arrTime);
?>
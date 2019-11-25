<?php
    include 'connect.php';
    header('Content-Type: application/json');
    
    $db = new Connection();
    $connection = $db->get_connection();

    mysqli_set_charset($connection,'UTF-8');

    $query = "SELECT * FROM tb_user";

    $data = mysqli_query($connection, $query);

    class Employee{
        function Employee($id, $name, $dateOfBirth, $gender, $identifier, $infoComputer, $positionId, $groupId){
            $this -> id = $id;
            $this -> name = $name;
            $this -> dateOfBirth = $dateOfBirth;
            $this -> gender = $gender;
            $this -> identifier = $identifier;
            $this -> infoComputer = $infoComputer;
            $this -> positionId = $positionId;
            $this -> groupId = $groupId;
        }
    }

    $arrEmployee = array();

    while($row = mysqli_fetch_assoc($data)){
        array_push($arrEmployee, new Employee($row['user_id'], $row['name'], $row['user_date'], $row['user_gender'], $row['user_identifier'],
         $row['user_computer'], $row['position_id'], $row['group_id']));
    }

    echo json_encode($arrEmployee);
?>
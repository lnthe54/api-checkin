<?php
include 'connect.php';
header('Content-Type: application/json');

class User {
    private $__db;
    private $__connection;

    public function __construct() {
        $this->db = new Connection();
        $this->connection = $this->db->get_connection();
    }

    public function does_user_exist($username, $pass) {
        $query = "SELECT * FROM tb_login as l, tb_user as u WHERE user_name = '$username' 
                                                                    AND password = '$pass' 
                                                                    AND l.user_id = u.user_id";
        $result = mysqli_query($this -> connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $data = array();
            array_push($data, array("user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "password" => $row['password'],
                "name" => $row['name'],
                "gender" => $row['user_gender'],
                "dateOfBirth" => $row['user_date'],
                "info_computer" => $row['user_computer'],
                "identifier" => $row['user_identifier'],
                "position_id" => $row['position_id'],
                "group_id" => $row['group_id'],
            ));

            $json['status'] = 200;
            $json['message'] = 'Đăng nhập thành công';
            $json['data'] = $data;

            echo json_encode($json);

            mysqli_close($this->connection);
        } else {
            $json['status'] = 400;
            $json['message'] = 'Bạn nhập sai tên đăng nhập hoặc mật khẩu';
            echo json_encode($json);
            mysqli_close($this->connection);
        }
    }
}

$user = new User();
if (isset($_POST['user_name'], $_POST['password'])) {
    $username = $_POST['user_name'];
    $pass = $_POST['password'];
    if (!empty($username) && !empty($pass)) {
        $encrypted_password = md5($pass);
        $user->does_user_exist($username, $pass);
    } else {
        $json['status'] = 100;
        $json['message'] = 'You must fill both fields';
        echo json_encode($json);
    }
}

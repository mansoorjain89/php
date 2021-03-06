<?php
class User {

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

public static function find_all_users(){
global $database;

$result_set = self::find_this_query("select * from users");
return $result_set;

}

public static function find_by_user_id($id){
global $database;

$result_set_array = self::find_this_query("select * from users where id = $id limit 1");
return !empty($result_set_array) ? array_shift($result_set_array) : false;
}

public static function find_this_query($sql) {
    global $database;
    $result_set = $database->query($sql);
    $the_object_array = [];

    while ($row = mysqli_fetch_array($result_set)) {
        $the_object_array[] = self::instantiation($row);
    }
    return $the_object_array;
}

public static function verify_user($username,$password) {

    global $database;
    $username = $database->escape_string($username);
    $password = $database->escape_string($password);

    $sql = "select * from users where";
    $sql .= "username = '{$username}'";
    $sql .= "and password = '{$password}' limit 1'";

    $result_set_array = self::find_this_query($sql);
    return !empty($result_set_array) ? array_shift($result_set_array) : false;

}

public static function instantiation($result) {
    $the_object = new self;
    foreach ($result as $the_attribute => $value) {
        if ($the_object->has_the_attribute($the_attribute)) {
            $the_object->{$the_attribute} = $value;
        }
    }
    return $the_object;
}

public function has_the_attribute($the_attribute) {
    $object_properties = get_object_vars($this);
    return array_key_exists($the_attribute,$object_properties);
}


}



 ?>

<?php

class User {
    public function get_data($id) {
        $query = "select * from users where userid = '$id' limit 1";

        $DB = new Database();
        $result = $DB->read($query);
        if($result) {
            return $result[0];
        }

        return false;
    }

    public function get_user($id) {
        $query = "select * from users where userid = '$id' limit 1";
        $DB = new Database();
        return $DB->read($query)[0];
    }

    public function  get_friends($id) {
        $query = "select * from users where userid != '$id' ";
        $DB = new Database();
        return $DB->read($query);
    }
}

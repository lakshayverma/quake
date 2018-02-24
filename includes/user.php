<?php

// If it is going to need the database, then it is probably smart to require it before we start. 
require_once(LIB_PATH . DS . "database.php");

class User extends DatabaseObject {

    protected static $table_name = "user";
    protected static $db_fields = array('id', 'first_name', 'last_name', 'user_name', 'password', 'address', 'email', 'img', 'type');
    public $id;
    public $first_name;
    public $last_name;
    public $user_name;
    public $password;
    public $address;
    public $email;
    public $img;
    public $type;

    public static function make($first_name, $last_name, $user_name, $password, $address, $email) {
        $user = new self;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->user_name = $user_name;
        $user->password = $password;
        $user->address = $address;
        $user->email = $email;
        return $user;
    }

    public function is_admin() {
        $type = strtolower($this->type);
        return ($type == "admin");
    }

    public function name() {
        return "$this->first_name $this->last_name";
    }

    public static function find_uninvited($event) {
        $sql = "select * from user"
                . " where"
                . " id not in"
                . " (select user from guest where event = $event)";
        return static::find_by_sql($sql);
    }

    public static function find_members_of_event($event) {
        $sql = "select * from user"
                . " where"
                . " id in"
                . " (select user from guest where event = $event and position in('Admin','Member'))";
        return static::find_by_sql($sql);
    }

    public function renderTableHeader() {
        return '
            <thead>
                <tr class="row">
                    <th class="col-sm-12 col-md-2 ">
                        Id
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Image
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        First Name
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Last Name
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        User Name
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Password
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Address
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Email
                    </th>
                    <th class="col-sm-12 col-md-2 ">
                        Type
                    </th>
                </tr>
            </thead>';
    }

    public function renderTableRow($edit = TRUE) {
        return "<tr class=\"row\">"
                . $this->table_edit($edit)
                . "<td class=\"col-sm-12 col-md-2\"> " . $this->avatar() . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->first_name . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->last_name . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->user_name . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->password . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->address . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->email . "</td>"
                . "<td class=\"col-sm-12 col-md-2\">" . $this->type . "</td>"
                . "</tr>";
    }

}

?>
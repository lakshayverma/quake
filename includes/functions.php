<?php

// Required functions
function __autoload($class_name) {
    $class_name = strtolower($class_name);
    $path = LIB_PATH . DS . "{$class_name}.php";
    if (file_exists($path)) {
        require_once($path);
    } else {
        die("The file {$class_name}.php could not be found.");
    }
}

function form_date_today() {
    return date("Y-m-d") . 'T' . date("h:i:s");
}

function redirect_to($location = NULL) {
    if ($location != NULL) {
        if (empty($location)) {
            $location = "index.php";
        }
        if (!headers_sent()) {
            header("Location: {$location}");
        }
        exit;
    }
}

// HTML Functions
function include_layout_template($template = "") {
    include(SITE_ROOT . DS . 'layouts' . DS . $template);
}

function output_message($message = "", $class = "") {
    if (!empty($message)) {
        return "<p class=\"message {$class}\">{$message}</p>";
    } else {
        return "";
    }
}

function strip_zeros_from_date($marked_string = "") {
    // remove marked zeros
    $no_zeros = str_replace("*0", "", $marked_string);

    // remove remaining marks
    $cleaned_string = str_replace("*", "", $no_zeros);
    return $cleaned_string;
}

// LOG functions
function log_action($action, $message = "") {
    $file = SITE_ROOT . DS . 'logs' . DS . 'site_logs.txt';
    if ($handle = fopen($file, 'a')) {
        $log = "";
        $log .= strftime("%Y-%m-%d %H:%M:%S", time()) . " | ";
        $log .= $action . " " . $message . "\r\n";
        fwrite($handle, $log);
        fclose($handle);
    }
}

function get_all_logs() {
    $file = SITE_ROOT . DS . 'logs' . DS . 'site_logs.txt';
    $log = "";
    if ($handle = fopen($file, 'r')) {
        $log = fread($handle, filesize($file));
        fclose($handle);
    }
    $tempLog = trim($log);
    if (empty($tempLog)) {
        $log = "No log information available yet.";
    }
    return $log;
}

function wipe_all_logs($user_id) {
    $file = SITE_ROOT . DS . 'logs' . DS . 'site_logs.txt';

    $username = User::find_by_id($user_id)->username;
    if ($handle = fopen($file, 'w')) {
        $log = "user: {$username} with id: " . $user_id . " cleared all previous logs on ";
        $log .= strftime("%Y-%m-%d %H:%M:%S", time());
        $log .= "\r\n";
        fwrite($handle, $log);
        fclose($handle);
    }
}

function admins_only() {
    give_access(TRUE);
}

function inside_persons_only() {
    give_access(FALSE, TRUE);
}

function members_only() {
    give_access(FALSE, FALSE);
}

function give_access($onlyAdmin = true, $onlyUsers = false) {
    global $session;
    $session->request_uri($_SERVER['REQUEST_URI']);
    if ($onlyUsers && $session->get_user_object()->type == 'client') {
        $session->message("Restricted Access.");
        redirect_to('index.php');
    }
    if ($onlyAdmin) {
        if (!$session->is_admin()) {
            $session->message("Only admins can view the requested page.");
            redirect_to('index.php');
        }
        // else keep going
    } else {
        if (!$session->is_logged_in()) {
            $session->message("You need to Login/Register first.");
            redirect_to('login.php');
        }
    }
}

function get_all_tables() {
    global $database;
    $result_set = $database->query("show tables");
    $database_tables = array();
    while ($table_detail = mysqli_fetch_array($result_set)) {
        $database_tables[$table_detail[0]] = get_table_details($table_detail[0]);
    }
    return $database_tables;
}

function get_table_details($table_name) {
    global $database;
    $table_result = $database->query("show columns from {$table_name}");
    while ($col = mysqli_fetch_assoc($table_result)) {
        $column[$col["Field"]] = $col["Type"];
    }
    return $column;
}

function get_input_type($column) {
    $col = strtoupper(substr($column, 0, 3));
    switch ($col) {
        case 'INT':
            return "number";
        case 'VAR':
            return 'text';
        case 'ENU':
            return 'select';

        case 'DAT':
        case 'TIM':
            return "datetime-local";

        default :
            return 'area';
    }
}

function create_input_element($name, $type, $default, $classes) {
    $column = get_input_type($type);
    if ($column === 'area') {
        $string = "<textarea id=\"{$name}\" name=\"{$name}\" class=\"{$classes}\">{$default}</textarea>";
    } elseif ($column === 'select') {
        $optionsString = substr($type, strpos($type, '('), strpos($type, ')'));
        $optionsString = str_replace('(', '', $optionsString);
        $optionsString = str_replace(')', '', $optionsString);
        $values = explode(',', $optionsString);

        $string = "<select id=\"{$name}\" name=\"{$name}\" class=\"{$classes}\">";
        foreach ($values as $option) {
            $option = str_replace('\'', '', $option);
            $string .= "<option value=\"{$option}\">{$option}</option>";
        }
        $string .= "</select>";
    } else {
        $string = "<input id=\"{$name}\" name=\"{$name}\" class=\"{$classes}\" type=\"{$column}\" ";
        if ($name == "id") {
            $string .= " disabled ";
        } else {
            $string .= " value=\"{$default}\" ";
        }
        $string .= "/>";
    }
    return $string;
}

function get_checkbox_value($checkbox) {
    if (strtolower($checkbox) === 'on') {
        return TRUE;
    } else {
        return FALSE;
    }
}
?>


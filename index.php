<?php
require_once 'db_connect.php';
require_once 'header.php';
require_once 'footer.php';

// Get action from URL
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Route to appropriate file based on action
switch ($action) {
    case 'index':
        require_once 'student_list.php';
        break;
    case 'create':
        require_once 'student_create.php';
        break;
    case 'store':
        require_once 'student_store.php';
        break;
    case 'edit':
        require_once 'student_edit.php';
        break;
    case 'update':
        require_once 'student_update.php';
        break;
    case 'delete':
        require_once 'student_delete.php';
        break;
    case 'details':
        require_once 'student_details.php';
        break;
    default:
        require_once 'student_list.php';
        break;
}
?>
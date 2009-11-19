<?php
$config['upload_path'] = './uploads/';

//This is the path to the uploads dir from your site root.
$config['public_path'] = 'uploads/';

//Bug in code igniter, must put images at end of list.
//http://codeigniter.com/bug_tracker/bug/6780/
$config['allowed_types'] = 'pdf|xo|zip|doc|txt|gif|jpg|png';
$config['remove_spaces'] = true;
$config['max_width'] = '1024';
$config['max_height'] = '768';

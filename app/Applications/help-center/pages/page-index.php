<?php
addAction('custom_admin_page_title', function(){
    echo 'Test';
}, 1);

addAction('custom_admin_page_content', function(){
    echo '<h1>Test</h1>';
}, 1);
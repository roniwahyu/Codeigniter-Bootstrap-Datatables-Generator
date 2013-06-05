<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>sip</title>
        <style>
            #notif{
                position: absolute;
                left: 35%;
                top: 0px;
                background: #ffcccc;
                width: 350px;
                -webkit-border-bottom-right-radius: 5px;
                -webkit-border-bottom-left-radius: 5px;
                -moz-border-radius-bottomright: 5px;
                -moz-border-radius-bottomleft: 5px;
                border-bottom-right-radius: 5px;
                border-bottom-left-radius: 5px;
                -webkit-box-shadow: 3px 3px 3px #707070;
                -moz-box-shadow: 3px 3px 3px #707070;
                box-shadow: 3px 3px 3px #707070;

            }
            #notif p{
                padding-top: 3px;
                text-align: center;
                color: red;
                padding-bottom: 4px;
            }
            #bar {
                width: 100%;
                height: 100px;
                
            }
            
        </style>
    </head>
    <body>
        <div id="notif">{php_open_first} echo $this->session->flashdata('notif');{php_close_first}</div>
        <div id="bar">{php_open_first} echo anchor('admin_login/logout','logout');{php_close_first}</div>
        {php_open_first}
        $this->load->view($content);
        {php_close_first}
    </body>
</html>

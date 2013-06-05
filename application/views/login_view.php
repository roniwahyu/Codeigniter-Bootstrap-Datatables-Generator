<html>

    <head>
        <title>Login page</title>

        <style>
            #login{
                width: 250px;
                height: 200px;
                margin: auto;
                margin-top: 20%;
                -webkit-box-shadow: 5px 5px 10px #7a797a;
                -moz-box-shadow: 5px 5px 10px #7a797a;
                box-shadow: 5px 5px 10px #7a797a;
                -webkit-border-top-left-radius: 15px;
                -webkit-border-bottom-right-radius: 5px;
                -moz-border-radius-topleft: 15px;
                -moz-border-radius-bottomright: 5px;
                border-top-left-radius: 15px;
                border-bottom-right-radius: 5px;
                border: 1px solid #D0D0D0;
            }
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
        </style>
    </head>

    <body>

        <div id="notif">
            <?php echo $this->session->flashdata('login_notif'); ?>




            <?php echo form_error('username'); ?>

            <?php echo form_error('password'); ?>
        </div>
        <?php echo form_open('admin_login/index'); ?>
        <div id="login">
            <br>
            <h3 align="center">Login</h3>
            <table border="0" align="center">



                <tr>
                    <td>username</td>
                    <td><input type="text" name="username"  /></td>
                </tr>

                <tr>
                    <td>password</td>
                    <td><input type="password" name="password" /></td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="post" value="Login" />


                    </td>
                </tr>
            </table>


        </div>

    </form>
</body>
</html>
<?php
    /**
     * In this case, we want to increase the default cost for BCRYPT to 12.
     * Note that we also switched to BCRYPT, which will always be 60 characters.
     */
    $pwd=$_GET["pwd"];
    $options = [
        'cost' => 12,
    ];
    //$hash = password_hash($pwd, PASSWORD_BCRYPT, $options);
    //echo $hash.'<br>';
    //$hash='$2y$12$8vw5D9JHcqw0OKqEA7tiZOhC9CXDXHtSU3zDo3Wa7xiitdq1mCbVq';
    $hash='$2y$12$tPyFBg4bakMgN.UzhwXd2eOk4BZAQusmCWZ.PI6GhAsWqvx9xsS1u';


    //$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

    if (password_verify('hussain', $hash)) 
    {
        echo 'Password is valid!';
    } 
    else 
    {
        echo 'Invalid password.';
    }
?>
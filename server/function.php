<?php

function check_tel($tel)
{
    $tel=trim($tel);
    if(!preg_match('/^09\d{9}$/', $tel))
    {
        $json=array('status'=>FALSE , 'data'=>"شماره تلفن را حتما به عدد وارد کنید");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    if (strstr($tel , "$") || strstr($tel , "_" )  || strstr($tel , "*")  ||  strstr($tel , "%") || strstr($tel , "!") || strstr($tel , "%") ) 
    {
        $json=array('status'=>FALSE , 'data'=>"شماره تلفن نمیتواند شامل کاراکتر باشد");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    if ($tel[0] != 0  ||  $tel[1] != 9 ) 
    {
        $json=array('status'=>FALSE , 'data'=>"شماره تلفن باید با 0 و 9 آغاز شود");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    if (strlen($tel) < 11 && strlen($tel) > 11) 
    {
        $json=array('status'=>FALSE , 'data'=>"شماره تلفن حتما باید 11 رقم باشد و با صفر شروع شود");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
}
function check_pass($password) //اوکی شد
{    
    $password=trim($password);
    $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";
    if(!preg_match($regex, $password)) 
    {
        $json=array('status'=>FALSE , 'data'=>"رمز عبور باید حداقل ۶ حرف و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند #$%! باشد.");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    if (strlen($password) < 8) 
    {
        $json=array('status'=>FALSE , 'data'=>"رمز عبور باید حداقل شامل 8 کاراکتر باشد");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
}
function check_fname($fname)  //اوکی شد
{
    $fname=trim($fname);
    if (empty($fname)) 
    {
        $json=array('status'=>FALSE , 'data'=>"نام نمیتواند خالی باشد");
        $out=json_encode($json, JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    $tedad=mb_strlen($fname);

    if ($tedad < 3) 
    {
        $json=array('status'=>FALSE , 'data'=>"نام نمیتواند کمتر از 3 حروف باشد");
        $out=json_encode($json, JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    if (strstr($fname,"$") || strstr($fname,"_" ) || strstr($fname,"@") || strstr($fname , "*")  ||  strstr($fname , "%") || strstr($fname , "!") || strstr($fname , "1") || strstr($fname , "2")|| strstr($fname , "3")|| strstr($fname, "4")|| strstr($fname , "5")|| strstr($fname , "6")|| strstr($fname , "7")|| strstr($fname , "8")|| strstr($fname , "9"))  
    {
        $json=array('status'=>FALSE , 'data'=>"نام را صحیح وارد کنید");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
}
function check_lname($lname) //اوکی شد
{
    $lname=trim($lname);
    if (empty($lname)) 
    {
        $json=array('status'=>FALSE , 'data'=>"نام خانوادگی نمیتواند خالی باشد");
        $out=json_encode($json, JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    $tedad=mb_strlen($lname);
    if ($tedad < 3) 
    {
        $json=array('status'=>FALSE , 'data'=>"نام خانوادگی نمیتواند کمتر از 3 حروف باشد");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    if (strstr($lname , "$") || strstr($lname , "#" ) || strstr($lname , "_" ) || strstr($lname , "@") || strstr($lname , "*")  ||  strstr($lname , "%") || strstr($lname , "!") || strstr($lname , "1") || strstr($lname , "2")|| strstr($lname , "3")|| strstr($lname , "4")|| strstr($lname , "5")|| strstr($lname , "6")|| strstr($lname , "7")|| strstr($lname , "8")|| strstr($lname , "9")) 
    {
        $json=array('status'=>FALSE , 'data'=>"نام خانوادگی را صحیح وارد کنید");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
}
function check_email($email)  //ایمیل اوکی شد
{
    $email=trim($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $json=array('status'=>FALSE , 'data'=>"فرمت ایمیل شما صحیح نیست");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    if (!strstr($email , "@")) 
    {
        $json=array('status'=>FALSE , 'data'=>"ایمیل باید حتما شامل @ باشد");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    if (strstr($email , "$") || strstr($email , "_" )  || strstr($email , "*")  ||  strstr($email , "%") || strstr($email , "!") || strstr($email , "%")) 
    {
        $json=array('status'=>FALSE , 'data'=>"ایمیل را صحیح وارد کنید");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
}
function insert($password , $fname , $lname , $email , $connection , $tel)
{
    $pass=password_hash($password , PASSWORD_DEFAULT );
                
    $sql = "INSERT INTO register (`fname` , `lname` , `email` , `tel` , `password`) VALUES ('$fname' , '$lname' , '$email' , '$tel' , '$pass')";

    if (mysqli_query($connection, $sql)) 
    {
        $json=array('status'=>TRUE , 'data'=>"اطلاعات کاربری شما با موفقیت ثبت شد");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
    } 
}
function check_email_tel($result , $email , $tel)
{
    foreach ($result as $o) 
    {
        $email1=$o['email'];
        $tel1=$o['tel'];

        if($email1 == $email) 
        {
            $messagg=array('status'=>FALSE , 'data'=>"ایمیل شما تکراری است");
            $ppaya=json_encode($messagg , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            echo $ppaya;
            exit;
        }
        if($tel1 == $tel) 
        {
            $messagg=array('status'=>FALSE , 'data'=>"شماره تلفن شما تکراری است");
            $paya=json_encode($messagg , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            echo $paya;
            exit;
        }
    }
}
    //_______________________________________________________________________LOGIN_______________________________________________________________________
function passverify($connection , $password , $sql)
{
    $result=mysqli_query($connection,$sql);

    if (mysqli_num_rows($result) > 0) 
    {
        $data=mysqli_fetch_assoc($result);

        if (password_verify($password , $data['password'])) 
        {
            $messagg=array('status'=>TRUE , 'data'=>"شما وارد شدید");
            $payaa=json_encode($messagg , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            echo $payaa;
            exit;
        }
        else 
        {
            $messagg=array('status'=>FALSE , 'data'=>"رمز عبور نادرست است");
            $payaa=json_encode($messagg , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            echo $payaa;
            exit;
        }
    }
    else 
    {
        $messagg=array('status'=>FALSE , 'data'=>"کاربر با این مشخصات وجود ندارد");
        $payaa=json_encode($messagg, JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $payaa;
        exit;
    } 
}
    // _______________________________________________________________________Forgetpass_______________________________________________________________________

    // function


?>
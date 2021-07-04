<?php
/*
  Designed By EA1 ~ Priest
  Sponsored By GHOST ~ DEVPARSE
  Mysqli Connection to Database = 'zen'
*/
include('inc_db.php');
// include '../Mailer/PHPMailerAutoload.php';
// $mail = new PHPMailer;
$connect = new connectDB();
$conn = $connect -> connectionString();
session_start();

//set time zone
date_default_timezone_set('Africa/Lagos');

// ==================================================================================
//                  FUNCTIONS 
// ==================================================================================
function cleanString($con, $val){
    return mysqli_real_escape_string($con, $val);
}
function message($err, $msg){
    return "<div id='alert-message' class='alert alert-$err customgabz-err-msg' style='font-family: ea1art1; margin-top: 10px;'>$msg</div>";
}

//Zion section

function countCartRec(){
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        $countd = 0;  
        foreach($cart_data as $countdata) { 
            $countd++; 
        }  
        return $countd;
    
    }else{
        return 0;
    }
}

function deleteOrder($conn, $orderid){
    $chk = mysqli_query($conn, "DELETE FROM tbl_order WHERE order_id='$orderid'");
    if($chk){
        //echo "<div class='alert alert-success'>Order successfully removed</div>";
    }else{
        echo "<div class='alert alert-danger'>Error occured while removing order</div>";
    }
}


//Stop zion section


// Admin login function starts here
function adminsignin($conn, $array){
    $adminid = cleanString($conn, $array[0]);
    $adminpassword = cleanString($conn, $array[1]);
    $encrpt = sha1($adminpassword);

    if(empty($adminid) || empty($adminpassword)){
        echo message("danger", "All fields are required");
    }
    else{
        $check = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE admin_id='$adminid' AND admin_password ='$encrpt'");
        if(mysqli_num_rows($check) > 0){
            $result = mysqli_fetch_array($check);
            session_start();
            $_SESSION['adminid'] = $result['admin_id']."_"."unique" ;
            header("location: index.php");
        }
        else{
            echo message("danger", "Invalid Login Parameters");
        } 
    }
    
}
// Admin login function ends here


// Upload product
function uploadproduct($conn, $array){
    

    $productname = cleanString($conn, $array[0]);
    $productdesc = cleanString($conn, $array[1]);
    $productfeatures = cleanString($conn, $array[2]);
    $productcategory = cleanString($conn, $array[3]);
    $productimage = $array[4]["name"];
    $proouctamount = cleanString($conn, $array[5]);
    $productquantity = cleanString($conn, $array[6]);
    $productSize = cleanString($conn, $array[7]);
    $productColor = cleanString($conn, $array[8]);


    $date = date("d M, Y");

    $extension=array("jpeg","jpg","png","gif");
    $imgname = "";
    foreach ($array[4]['tmp_name'] as $key => $image) {
        $img_name = $array[4]['name'][$key];
        $img_tmp = $array[4]['tmp_name'][$key];
        $ext=pathinfo($img_name,PATHINFO_EXTENSION);

        $imgname .= $img_name.',';

        $upload = 1;
        if (in_array($ext,$extension)) {
            move_uploaded_file($img_tmp, "product_image/".$img_name);
            $upload = 1;
        }
        else {
            echo message("danger", "Image Error");
            $upload = 0;
        }
    }

    if (empty($productname) || empty($productdesc) || empty($productfeatures) || empty($productcategory) || empty($productimage) || empty($proouctamount) ) {
        echo message("danger", "All Fields are Required");
    }

    elseif ($upload == 0) {
        echo message("danger", "Image Upload Error");
    }
    
    else{
       $uploadresult = mysqli_query($conn, "INSERT INTO `tbl_product`(`productname`, `description`, `feature`, `category`,  `image`, `amount`, `quantity`, `size`, `color`, `date`) VALUES ('$productname', '$productdesc', '$productfeatures', '$productcategory', '$imgname', '$proouctamount', '$productquantity', '$productSize', '$productColor','$date')") or die(mysqli_error($conn));
       if ($uploadresult) {
           echo message("success", "Product added Successfully");
       }
    }
}
function createads($conn, $array){
    $adsname = cleanString($conn, $array[0]);
    $adscategorydesc = cleanString($conn, $array[1]);
    $adsbriefdesc = cleanString($conn, $array[2]);
    $adscategory = cleanString($conn, $array[3]);
    echo $adsimage = $array[4]["name"];
    $adsbg = cleanString($conn, $array[5]);

    $ext = pathinfo($adsimage, PATHINFO_EXTENSION);
    $array = array('png','jpg','jpeg');

    $date = date("d M, Y");

    if (empty($adsname) || empty($adscategorydesc) || empty($adsbriefdesc) || empty($adscategory) || empty($adsimage) || empty($adsbg)) {
        echo message("danger", "All Field Are Required");
    }
    elseif (!in_array($ext, $array)) {
        echo message("danger", "Image File Error");
    }
    else{
        move_uploaded_file($_FILES['adsimage']['tmp_name'], "tabs_image/".$adsimage);

        $uploadads = mysqli_query($conn, "INSERT INTO `tbl_banner`(`head_title`, `banner_img`, `banner`, `title`, `description`, `adsbg`, `date`) VALUES ('$adsname', '$adsimage', '$adscategory', '$adscategorydesc', '$adsbriefdesc', '$adsbg', '$date')");
    }    
}

function createAccount($conn, $array){

    $fullname = cleanString($conn, $array[0]);
    $email = cleanString($conn, $array[1]);
    $password = cleanString($conn, $array[2]);
    $cpassword = cleanString($conn, $array[3]);
    $lastname = cleanString($conn, $array[4]);

    $encrpty = sha1($password);

    $chkemailqry = mysqli_query($conn, "SELECT * FROM tbl_client WHERE email='$email'");

    $date = date("d M, Y");
    $regid = rand();

    // $uppercase = preg_match('@[A-Z]@', $password);
    // $lowercase = preg_match('@[a-z]@', $password);
    // $number = preg_match('@[0-9]@', $password);
    // $specialchars = preg_match('@[^\w]@', $password);
 

    if(empty($fullname) || empty($email) || empty($password) || empty($cpassword) || empty($lastname)){
        echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Error: All fields are required");
    }
    elseif (!preg_match("/^[a-zA-Z]+$/", $fullname)) {
        echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Invalid Firstname");
    }
    elseif($password != $cpassword){
        echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Password does not match");
    }
    elseif (strlen($password) < 6) {
        echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Password too weak");
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Invalid Email");
    }
    elseif (mysqli_num_rows($chkemailqry) > 0) {
        echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Email Already Exists");
    }
    elseif (strlen($fullname) > 25) {
        echo message("danger", "Firstname has exceed limit of 25 characters");
    }
    elseif (strlen($lastname) > 25) {
        echo message("danger", "Firstname has exceed limit of 25 characters");
    }
    else{
        $check = mysqli_query($conn, "SELECT * FROM tbl_client WHERE email='$email'");
        if(mysqli_num_rows($check) > 0){
            echo message("danger", "Email address has been registered before");
        }
        else{
            $res = mysqli_query($conn, "INSERT INTO `tbl_client`(`regId`, `fullname`, `lastname`, `email`, `password`, `trn_date`) VALUES ('$regid', '$fullname', '$lastname', '$email', '$encrpty', '$date')");
            if($res){
                header("Location: signin.php?reguser=NTNhNTY4N2NiMjZkYzQxZjJhYjQwMzNlOTdlMTNhZGVmZDM3NDBkNg");
            }
            else{
                echo message("danger", "Registeration Not Successful");
            }
        }
    }
}

function signin($conn, $array){
    $email = cleanString($conn, $array[0]);
    $password = cleanString($conn, $array[1]);
    $encrpt = sha1($password);

    $check = mysqli_query($conn, "SELECT * FROM tbl_client WHERE email='$email' AND password ='$encrpt'");
    if(mysqli_num_rows($check) > 0){
        $result = mysqli_fetch_array($check);
        session_start();
        $_SESSION['clientId'] = $result['email'];
        header("location: ../cart.php");
    }
    else{
        echo message("danger", "Invalid Login Parameters");
    }
}

function updatedetails($conn, $arrval){
    $firstname = cleanString($conn, $arrval[0]);
    $lastname = cleanString($conn, $arrval[1]);
    $email = cleanString($conn, $arrval[2]);
    $phone = cleanString($conn, $arrval[3]);
    $country = cleanString($conn, $arrval[4]);
    $state = cleanString($conn, $arrval[5]);
    $address = cleanString($conn, $arrval[6]);
    $addressb = cleanString($conn, $arrval[7]);
    $postcode = cleanString($conn, $arrval[8]);
    $useriD = cleanString($conn, $arrval[9]);
    $phonenum = preg_replace("/[^0-9]/", '', $phone);

    if(empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($country) || empty($state) || empty($address) || empty($addressb) || empty($postcode)){
        echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Error: All fields are required");
    }
    elseif (strlen($firstname) > 25) {
        echo message("danger", "Firstname has exceed limit of 25 characters");
    }
    elseif (strlen($lastname) > 25) {
        echo message("danger", "Lastname has exceed limit of 25 characters");
    }
    elseif (!preg_match("/^[a-zA-Z]+$/", $firstname) || !preg_match("/^[a-zA-Z]+$/", $lastname)) {
        echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Invalid Name");
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Invalid Email");
    }
    elseif (!preg_match("/^[A-Z a-z]*$/", $state)) { 
     echo message("danger", "<i class='fal fa-exclamation-triangle'></i>  Invalid State"); 
    }
    elseif (!preg_match("/^[A-Z a-z]*$/", $country)) { 
     echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Invalid Country"); 
    }
    elseif (!is_numeric($postcode)) {
       echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Invalid Postal code"); 
    }
    elseif (strlen($postcode) < 3) {
       echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Invalid Postal code"); 
    }
    elseif (strlen($postcode) > 10) {
       echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Invalid Postal code"); 
    }
    elseif (strlen($phonenum) < 10 || strlen($phonenum) > 14) {
       echo message("danger", "<i class='fal fa-exclamation-triangle'></i> Invalid Phone Number");
    }
    else{
        $qry = mysqli_query($conn, "UPDATE `tbl_client` SET `fullname`='$firstname',`lastname`='$lastname',`email`='$email',`phoneNumber`='$phonenum',`country`='$country',`state`='$state',`address_1`='$address',`address_2`='$addressb',`postcode`='$postcode' WHERE email = '$useriD'");
    }

}

function updateproduct($conn, $array){
    $upproductname = cleanString($conn, $array[0]);
    $upproductdesc = cleanString($conn, $array[1]);
    $upproductfeatures = cleanString($conn, $array[2]);
    $upproductcategory = cleanString($conn, $array[3]);
    $upproductimage = $array[4]["name"];
    $upproductbackground = cleanString($conn, $array[5]);
    $upproouctamount = cleanString($conn, $array[6]);
    $upproductquantity = cleanString($conn, $array[7]);
    $productID = cleanString($conn, $array[8]);

    $url = base64_encode($productID);
    $encodeurl = urlencode($url);  

    if (empty($upproductname) || empty($upproductdesc) || empty($upproductfeatures) || empty($upproductcategory) || empty($upproductbackground) || empty($upproouctamount) || empty($upproductquantity)) {
        echo message("danger", "All Fields are Required");
    }
    else{
       $uploadresult = mysqli_query($conn, "UPDATE `tbl_product` SET `productname`='$upproductname',`category`='$upproductcategory',`description`='$upproductdesc',`feature`='$upproductfeatures',`quantity`='$upproductquantity',`amount`='$upproouctamount',`product_bg`='$upproductbackground' WHERE id = '$productID'");
       if ($uploadresult) {
            echo "<script>window.location.href ='manage-edit.php ?product=$encodeurl'</script>";
            echo message("success", "Product Updated Successfully");
       }
    }
}


function edit_category($id){
    global $conn;


}

$action = @$_POST['action'];
if($action == "post-category"){
    echo (new doSomething)->postCategory();
}
elseif($action == "view-category"){
    echo (new doSomething)->viewCategory();
}
class doSomething{

    public function postCategory(){
        global $conn;
        $cat = cleanString($conn,$_POST['value']);

        $res = mysqli_query($conn, "INSERT INTO `tbl_category`( `category`,`uploaded_by`) VALUES ('$cat', 'LozkeyDev')") or die(mysqli_error($conn));
        if ($res) {
            $status = 0;
        } else {
            $status = 1;
        }

        return json_encode(["status"=>$status]);
    }

    public function viewCategory(){
        global $conn;
        $selme = $conn->query("SELECT * FROM tbl_category") or die(mysqli_error($conn));
        $allcat = [];
        while($row = mysqli_fetch_array($selme)){
            $allcat[] = $row;
        }
        return json_encode(["result"=>$allcat]);
    }


}





?>
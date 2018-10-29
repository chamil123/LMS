<?php

if (!isset($_SESSION)) {
    session_start();
}
require '../model/MemberModel.php';
$member = new Member();
require '../model/AddressModel.php';
$address = new Address();
require '../model/GuranterModel.php';
$guranter = new Guranter();

$action = $_GET['action'];
if (isset($_POST['AddMember'])) {
    if ($action == "add") {
        $member_aline1 = $_POST['member_aline1'];
        $member_aline2 = $_POST['member_aline2'];
        $member_aline3 = $_POST['member_aline3'];
        $member_aline4 = $_POST['member_aline4'];
        $branch_code = $_POST['branch_code'];
        
       

        $member_br = $_POST['member_br'];
        $member_no = $_POST['member_no'];
        $centerNumber = $_POST['centerNumber'];

        $member_number = $member_br . "/" . $centerNumber."/".$member_no;
        $member_nic = $_POST['member_nic'];
        $member_surname = $_POST['member_surname'];
        $member_initial = strtoupper($_POST['member_initial']);

        $bar = $_POST['member_fullInitial'];
        $member_fullInitial = ucwords(strtolower($bar));
        $member_dob = $_POST['member_dob'];
        $member_status = $_POST['member_status'];
        $member_gender = $_POST['member_gender'];
        $member_nationality = $_POST['member_nationality'];
        $member_group = $_POST['member_group'];
        $member_mobile = $_POST['member_mobile'];
        $member_homenumber = $_POST['member_homenumber'];
        $centerid = $_POST['centerid'];

        $guranter_nic = $_POST['guranter_nic'];
        $guranter_surname = $_POST['guranter_surname'];
        $guranter_initial = $_POST['guranter_initial'];
        $guranter_fullInitial = $_POST['guranter_fullInitial'];
        $guranter_contact = $_POST['guranter_contact'];
        $guranter_dob = $_POST['guranter_dob'];
        $guranter_addressln1 = $_POST['guranter_addressln1'];
        $guranter_addressln2 = $_POST['guranter_addressln2'];
        $guranter_addressln3 = $_POST['guranter_addressln3'];
        $guranter_addressln4 = $_POST['guranter_addressln4'];
        
        echo 'member_aline1 : '.$member_aline1."<br/> member_aline2 : ".$member_aline2."<br/> member_aline3 : ".$member_aline3."<br/>  member_cityid : ".$member_cityid."<br/> branch_code : ".$branch_code."<br/> member_br : ".$member_br."<br/> member_no : ".$member_no."<br/> centerNumber : ".$centerNumber."<br/> member_number : ".$member_number."<br/> member_nic : ".
                
                $member_nic."<br/> member_surname : ".$member_surname."<br/> member_initial : ".$member_initial."<br/> member_fullInitial : ".$member_fullInitial."<br/> member_dob : ".$member_dob."<br/> member_status : ".$member_status."<br/> member_gender : ".$member_gender."<br/> member_nationality : ".$member_nationality."<br/> member_group : ".$member_group."<br/> guranter_dob : ".
                $member_mobile."<br/>".$member_homenumber."<br/>".$centerid."<br/>".$guranter_nic."<br/>".$guranter_surname."<br/>".$guranter_initial."<br/>".$guranter_fullInitial."<br/>".$guranter_contact."<br/>".
                $guranter_dob."<br/> guranter_addressln1 : ".$guranter_addressln1."<br/> guranter_addressln2 : ".$guranter_addressln2."<br/> guranter_addressln3 : ".$guranter_addressln3."<br/>  gurantor_cityid : ".$gurantor_cityid;
       
        //$resultMAddress = $address->addAddress($member_aline1, $member_aline2, $member_aline3, $member_aline4);
        $resultMember = $member->addMember($member_number, $member_nic, $member_surname, $member_initial, $member_fullInitial, $member_dob, $member_status, $member_gender, $member_nationality, $member_group, $member_mobile, $member_homenumber, $centerid, $branch_code,$member_aline1, $member_aline2, $member_aline3, $member_aline4);

       // $resultGAddress = $address->addAddress($guranter_addressln1, $guranter_addressln2, $guranter_addressln3, $guranter_addressln4);
        $resultGuranter = $guranter->addGuranter($guranter_nic, $guranter_surname, $guranter_initial, $guranter_fullInitial, $guranter_contact, $guranter_dob, $resultMember,$guranter_addressln1, $guranter_addressln2, $guranter_addressln3, $guranter_addressln4);
        if ($resultMember > 0) {
            $_SESSION['msgm'] = 1;
        }
//        header("Location:../../AddMember.php");
    }
}
if (isset($_POST['UpdateMember'])) {
    if ($action == "update") {
        $member_aline1 = $_POST['member_aline1'];
        $member_aline2 = $_POST['member_aline2'];
        $member_aline3 = $_POST['member_aline3'];
        $member_aline4 = $_POST['member_aline4'];
        $branch_code = $_POST['branch_code'];
        


        $member_br = $_POST['member_br'];
        $member_no = $_POST['member_no'];
        $centerNumber = $_POST['centerNumber'];

        $member_id = $_POST['member_id'];
        $member_number = $member_br . "/" . $centerNumber . "/" . $member_no;
        $member_nic = $_POST['member_nic'];
        $member_surname = $_POST['member_surname'];
        $member_initial = $_POST['member_initial'];
        $member_fullInitial = $_POST['member_fullInitial'];
        $member_dob = $_POST['member_dob'];
        $member_status = $_POST['member_status'];
        $member_gender = $_POST['member_gender'];
        $member_nationality = $_POST['member_nationality'];
        $member_group = $_POST['member_group'];
        $member_mobile = $_POST['member_mobile'];
        $member_homenumber = $_POST['member_homenumber'];
        $centerid = $_POST['centerid'];

        $guranter_id = $_POST['guranter_id'];
        $guranter_nic = $_POST['guranter_nic'];
        $guranter_surname = $_POST['guranter_surname'];
        $guranter_initial = $_POST['guranter_initial'];
        $guranter_fullInitial = $_POST['guranter_fullInitial'];
        $guranter_contact = $_POST['guranter_contact'];
        $guranter_dob = $_POST['guranter_dob'];
        $guranter_addressln1 = $_POST['guranter_addressln1'];
        $guranter_addressln2 = $_POST['guranter_addressln2'];
        $guranter_addressln3 = $_POST['guranter_addressln3'];
        $guranter_addressln4 = $_POST['guranter_addressln4'];


     //   $resultAddress = $address->updateMemberAddress($member_aline1, $member_aline2, $member_aline3, $member_aline4, $member_addressid);
        $resultMember = $member->updateMember($member_number, $member_nic, $member_surname, $member_initial, $member_fullInitial, $member_dob, $member_status, $member_gender, $member_nationality, $member_group, $member_mobile, $member_homenumber, $centerid, $member_id, $branch_code,$member_aline1, $member_aline2, $member_aline3, $member_aline4);
        //echo 'ssaaas : ' . $member_aline1 . " " . $member_aline2 . " " . $member_aline3 . " " . $member_aline4;
      //  $resultAddress = $address->updateGurantorAddress($guranter_addressln1, $guranter_addressln2, $guranter_addressln3, $guranter_addressln4, $gurantor_addressid);
        $resultGuranter = $guranter->updateGuranter($guranter_nic, $guranter_surname, $guranter_initial, $guranter_fullInitial, $guranter_contact, $guranter_dob, $member_id, $guranter_id,$guranter_addressln1, $guranter_addressln2, $guranter_addressln3, $guranter_addressln4);

        if ($resultMember > 0) {
            $_SESSION['msga'] = 3;
        }
        header("Location:../../ViewMembers.php");
    }
}if ($action == "deactivate") {
   
    $member_ids = $_GET['member_id'];
    
    echo 'dds : '.$member_ids;
    $result = $member->activateStatus($member_ids);
    if ($result > 0) {
        $_SESSION['msga'] = 3;
    }
    header("Location:../../ViewMembers.php");
}if ($action == "activate") {
    $member_ids = $_GET['member_id'];
    $result = $member->deactivateStatus($member_ids);
    if ($result > 0) {
        $_SESSION['msga'] = 3;
    }
    header("Location:../../ViewMembers.php");
}
?>
<?php     //start php tag
//include connect.php page for database connection
Include('config.php')
//if submit is not blanked i.e. it is clicked.
If(isset($_REQUEST['submit'])!='')
{
If($_REQUEST['uname']=='' || $_REQUEST['email']=='' || $_REQUEST['ugender']==''|| $_REQUEST['unum']==''|| $_REQUEST['cname']==''|| $_REQUEST['udept']==''|| $_REQUEST['uyear']=='')
{
Echo "please fill the empty field.";
}
Else
{
$sql="insert into attendee(name,gender,email,mobile,college,department,year) values('".$_REQUEST['uname']."', '".$_REQUEST['ugender']."', '".$_REQUEST['email']."', '".$_REQUEST['unum']."','".$_REQUEST['cname']."','".$_REQUEST['udept']."','".$_REQUEST['uyear']."')";
$res=mysql_query($sql);
If($res)
{
print "Record successfully inserted";
}
Else
{
print "There is some problem in inserting record";
}

}
}

?>
function checkName(pName,pNameMsg) 
{
	
	var Lname=pName;
	var Lname_msg=pNameMsg;
	var letters = /^[A-Za-z]+$/;

	if (Lname.length > 20) 
	{
		Lname_msg = "Please choose 20 characters max for the name";
		return false;
	}
    if (letters.test(Lname) == false) 
	{
  		Lname_msg = "Please enter alphabets only without space";
  		return false;
    } 
	else 
	{
  		Lname_msg = "";
		return true;
	}
	
}

function checkName() 
{
	var Lname=document.getElementById("name");
	var Lname_msg=document.getElementById("name_msg");
	var letters = /^[A-Za-z]+$/;

	if (Lname.value.length > 20) 
	{
		name_msg.textContent = "Please choose 20 characters max for the name";
		return false;
	}
        if (letters.test(Lname.value) == false) 
	{
  		Lname_msg.textContent="Please enter alphabets only without space";
  		return false;
        } else 
	{
  		Lname_msg.textContent="";
	}
}
function validate(e)
{
	hideErrors();

	if(formHasErrors())
	{
		e.preventDefault();
		return false;
	}

	return true;
}

function formHasErrors()
{
	// setting the error flag to false
	let errorFlag = false;

	let regName = new RegExp(/^$/);

	let validateName = document.getElementById("name").value;

	if(regName.test(validateName))
	{
		document.getElementById("name_error").style.display= "block";
		if(!errorFlag)
		{
			document.getElementById("name").focus();
			document.getElementById("name").select();
		}

		errorFlag = true;
	}

	let regexPhone = new RegExp(/^[0][1-9]\d{9}$|^[1-9]\d{9}$/);

	let validatePhone = document.getElementById("phonenumber").value;

	if(!regexPhone.test(validatePhone))
	{
		document.getElementById("phone_error").style.display= "block";
		if(!errorFlag)
		{
			document.getElementById("phonenumber").focus();
			document.getElementById("phonenumber").select();
		}

		errorFlag = true;
	}

	// creatin a regular expression for the email
	let regexEmail = new RegExp(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/);

	let validateEmail = document.getElementById("email").value;

	if(!regexEmail.test(validateEmail))
	{
		document.getElementById("email_error").style.display= "block";
		if(!errorFlag)
		{
			document.getElementById("email").focus();
			document.getElementById("email").select();
		}

		errorFlag = true;
	}

	let regMessage = new RegExp(/^$/);

	let validateMessage = document.getElementById("comments").value;

	if(regMessage.test(validateMessage))
	{
		document.getElementById("message_error").style.display= "block";
		if(!errorFlag)
		{
			document.getElementById("comments").focus();
			document.getElementById("comments").select();
		}

		errorFlag = true;
	}

	return errorFlag;
}

function hideErrors()
{
	let errorFields = document.getElementsByClassName("error");

	for(let i = 0; i < errorFields.length; i++)
	{
		errorFields[i].style.display = "none";
	}
}

function resetForm(e)
{

	hideErrors();
	return true;
	e.preventDefault();
	return false;
}

function load()
{
	hideErrors();
	//Event listner for the submit button
	document.getElementById("contact").addEventListener("submit", validate, false);
	//Event Listener for the reset
	document.getElementById("contact").addEventListener("reset", resetForm, false);
}

document.addEventListener("DOMContentLoaded", load, false);
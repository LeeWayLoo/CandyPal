function checkInputs(page)
{
	var issue;
	for(var i=0,len=document.forms[page].length-1;i<len;i++)
	{
		var input = document.forms[page][i].value;
		if(!input)
		{
			issue = "missing";
			break;
		}
		if(/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(input))
		{
			issue = "illegal";
		}
	}
	if(issue)
	{
		var error = document.getElementById("error");
		if(issue == "missing")
		{
			error.innerHTML = "<p style='color:red;'>Missing Fields</p><br>";
		}
		else if(issue == "illegal")
		{
			error.innerHTML = "<p style='color:red;'>No Illegal Characters Allowed</p><br>";
		}
		return false;
	}
	else
	{
		return true;
	}
}
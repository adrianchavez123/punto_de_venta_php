
function validar()
{
	var form = document.frm;
	
	var username = form.username.value;
	
	if(username.length == 0)
	{
		alert('Debes ingresar tu username');
		return false;
		
	}
	
	var password = form.password.value;
	
	if(password.length == 0)
	{
		alert('Debes ingresar tu password');
		return false;
		
	}
	
	form.submit();
}

function datosCompletos()
{
	
		
		
	var rfc = document.getElementById('rfc').value;
	if(rfc == "false")
	{
		alert('tienes que llenar todos tus datos');
		window.location.href='miCuenta.php';
	}
}














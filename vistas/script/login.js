function verificar()
{
	//e.preventDefault();
    logina=$("#logina").val();
    clavea=$("#clavea").val();
    
      alert ( logina.toString()+ " "+clavea.toString());

    $.post("../ajax/usuario.php?op=verificar&aa="+logina+"&bb="+clavea,
        {"logina":logina,"clavea":clavea},
        function(data)
    {

      

        if (data.toString()=="0")
        {
            bootbox.alert("Usuario y/o Password incorrectos");
                    return ;
        }
        else
        {
            
            
                $(location).attr("href","index.php");        
                    
            
        }
    });
}

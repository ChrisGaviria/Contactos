//Trae los datos del formulario y los envía al back via Ajax
function guardar_contacto(){    

    let cont_nombre = $("#cont_nombre").val();
    let cont_apellido = $("#cont_apellido").val();
    let cont_tel = $("#cont_tel").val();
    let cont_telsec = $("#cont_telsec").val();

    var parametros = {
        "cont_nombre" : cont_nombre,
        "cont_apellido" : cont_apellido,
        "cont_tel" : cont_tel,
       "cont_telsec" : cont_telsec
    };

    $.ajax({
        url: 'registrar_contacto.php',
        type: 'POST',
        dataType: "Json",
        data: parametros,
        success:function(datosretorna){
            if (datosretorna.respuesta==true) { 
                alert('registro guardado con exito!');
               location.reload();
            } else {
                alert('imposible guardar registro!');
            }
        },
        error:function(e){
            alert("Imposible Cargar Informacion!");
        }
    });
    
}





            
                
           
                
            
                
            
                
 
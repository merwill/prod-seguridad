                          

function openDialogConfiguracion(){
	
	var dialogHtml = null;
	var url = "/application/index";
	//var url = "http://zf-apigility/ping";
	
	dialogHtml = '<div class="modal" id="idModalConfiguracion" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">'+
		  // '     <div class="modal-backdrop">'+
		   '     <div class="modal-dialog modal-lg">'+
		   		'<div class="modal-content">'+
		    '    <div class="modal-header">'+
		    '        <button type="button" class="close" onclick="closeModalBootstrap('+"'idModalConfiguracion'" + ')" aria-hidden="true">&times;</button>'+
		    '        <h4 class="modal-title" id="myModalLabel">Configuración de datos</h4>'+
		    '    </div>'+
		    '    <div class="modal-body">'+
		    '        <div id="divContentConfiguracion" ></div>'+
		    '    </div>'+
		    '    <div class="modal-footer">'+
		    '        <button type="button" class="btn btn-primary" onclick="closeModalBootstrap('+"'idModalConfiguracion'" + ')">Cerrar</button>'+
		    //'        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>'+
		    //'        <button type="button" class="btn btn-default">idContent</button>'+
		    '    </div>'+
		    '</div>'+
			'</div>'+
			//'</div>'+
			'</div>';

	    $("#content").append(dialogHtml);
	    $('#idModalConfiguracion').modal('show');
	    
	    $('#divContentConfiguracion').load(url);
	    
//        $.ajax({
//    		"type": 'GET',
//	        "url": url,
//	     	"async": true,
//	        //"dataType": 'json',
//	        "data": "",
//	        "success": function(response){
//
//	        	console.log(response);
//			}
//		});
	    
}

function openModalBootstrap(idModal,title,idContent){
	
	var dialogHtml = null;
	
	dialogHtml = '<div class="modal" id="'+idModal+'" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">'+
	//'     <div class="modal-backdrop">'+
	'     <div class="modal-dialog modal-lg">'+
	'<div class="modal-content">'+
	'    <div class="modal-header" style="background-color: #EEEEEE">'+
	'        <button type="button" class="close" onclick="closeModalBootstrap('+"'" + idModal + "'" + ')" aria-hidden="true">&times;</button>'+
	'        <h4 class="modal-title" id="myModalLabel">'+title+'</h4>'+
	'    </div>'+
	'    <div class="modal-body">'+
	'        <div id="'+idContent+'" ></div>'+
	'    </div>'+
	'    <div class="modal-footer"  style="background-color: #EEEEEE">'+
	'        <button type="button" class="btn btn-default" onclick="closeModalBootstrap('+"'" + idModal + "'" + ')">Cerrar</button>'+
	//'        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>'+
	//'        <button type="button" class="btn btn-default">idContent</button>'+
	'    </div>'+
	'</div>'+
	'</div>'+
	//'</div>'+
	'</div>';
	
	$("#content").append(dialogHtml);
	$('#'+idModal).modal('show');
}

function closeModalBootstrap(idModal2){
	$('#'+idModal2).modal('hide');
	$('#'+idModal2).remove();
	return true;
}  

function openConfirmModalLogout(href){
	
	var dialogHtml = null;
	idModal = "idModalLogout";
	title = "Confirmación";
	idContent = "divLogout";
	content = "Esta seguro de salir?";
	
	dialogHtml = '<div class="modal" id="'+idModal+'" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">'+
		   '     <div class="modal-dialog modal-sm">'+
		   		'<div class="modal-content">'+
		    '    <div class="modal-header">'+
		    //'        <button type="button" class="close" onclick="closeModalBootstrap('+"'" + idModal + "'" + ')" aria-hidden="true">&times;</button>'+
		    '        <h4 class="modal-title" id="myModalLabel">'+title+'</h4>'+
		    '    </div>'+
		    '    <div class="modal-body">'+
		    '        <div id="'+idContent+'" >'+content+'</div>'+
		    '    </div>'+
		    '    <div class="modal-footer">'+
		    '        <button type="button" class="btn btn-primary" onclick="window.location='+"'" + href + "'" + ';">Aceptar</button>'+
		    '        <button type="button" class="btn btn-default" onclick="closeModalBootstrap('+"'" + idModal + "'" + ');">Cancelar</button>'+
		    '    </div>'+
		    '</div>'+
			'</div>'+
			'</div>';

	    $("#content").append(dialogHtml);
	    $('#'+idModal).modal('show');
}


                            
/**
 *
 * @param mensaje
 * @param title
 * @param paramWidth
 * @param paramHeight
 */
function dialogOpen(mensaje,title,paramWidth,paramHeight){

    var width = 400;
    var height = 200;

    if(paramWidth === undefined) { width = 400;  }else{width = paramWidth;}
    if(paramHeight === undefined) { height = 200;  }else{height = paramHeight;}

    var dialogArea = "<div id='dialogIdMensaje' style='display:true' title='MENSAJE'><h4>"+mensaje+"</h4></div>";

    $("#content").append(dialogArea);
    $('#dialogIdMensaje').wijdialog({
        "captionButtons": {"maximize": {"visible": false},
            "minimize": {"visible": false},
            "toggle": {"visible": false},
            "refresh": {"visible": false},
            "pin": {"visible": false},
            "close": {"visible": true}
        },
        "modal": true,
        "width": width,
        "height": height,
        "position": [ "center", "center"],
        "show": "slide",
        "title": title,
        "buttons": {"Cerrar": function(){jQuery(this).wijdialog('close');
            //jQuery(this).remove();
        }},
        "close": function(){
            jQuery(this).remove();
        }
    });
}

/**
 * Adjuntar documentos genericos
 */
function uploadFile(documento_id, seguimiento_id, div_update, url_update, es_acuse_recibo , uploadOne, adjunto_id_param){
	
	var dialogArea = "<div id='dialogIdUpload' style='display:true;' title='ADJUNTOS'><div id='divUpload'></div></div>";
	$("#content").append(dialogArea);

    var url_form = "/admin/reporte/upload-form";
    var url_save = "/admin/reporte/upload-save";
	if(documento_id === undefined) { 
		alert("Seleccione una fila por favor."); 
		return false;	
	} else{
		if(!documento_id){
			alert("Seleccione una fila por favor.");
			return false;
		}
	}
	if(seguimiento_id === undefined) { seguimiento_id = null;  }
	
	var uploadCountFiles = 0; 
	if(uploadOne === undefined) {
		uploadCountFiles = 20;  
	}else{
		uploadCountFiles = 1;
	}
	
	if(adjunto_id_param != undefined) {
		adjunto_id = adjunto_id_param;  
	}else{
		adjunto_id = 0;
	}
	
	
	//Determina si el adjunto es acuse de recibo
	var estado_acuse_recibo = '0';
	if(es_acuse_recibo === undefined || es_acuse_recibo === "") { 
		estado_acuse_recibo = '0';  
	}else{
		if(es_acuse_recibo == "ES_AR"){
			estado_acuse_recibo = '1';
		}
	}
	
    var data = {"doc": documento_id, "seg": seguimiento_id};

	$('#divUpload').load(url_form, data,
		function() {
			$('#dialogIdUpload').wijdialog({
				"captionButtons": {
					"maximize": {"visible": false},
					"minimize": {"visible": false},
					"toggle": {"visible": false},
					"refresh": {"visible": false},
					"pin": {"visible": false},
					"close": {"visible": true}
					},
				"modal": true,
				"width": 750,
				"height": 420,
				"title":'Adjuntar documentos: ' + documento_id,
				"buttons": {"Cerrar": function(){
					jQuery('#dialogIdUpload').wijdialog('close'); 
				}},
				"close": function(){
					jQuery('#dialogIdUpload').remove();
				}	
			});
				
			$('#uploader').plupload({
				"runtimes": "html5",
				"url": url_save + '/doc/' + documento_id + '/seg/' + seguimiento_id  + '/estado_acuse_recibo/' + estado_acuse_recibo,
				"max_file_size": "11mb",
				"max_file_count": uploadCountFiles,
				"unique_names": true,
				"filters": [ //{title : "Image files", extensions : "jpg"},
				             {title : "Pdf files", extensions : "pdf"}],
				"init" : {
					 BeforeUpload: function(up, file) {
			                
			                if(uploadOne == 1 && adjunto_id != 0) {
			                
				                $.ajax({
				    	    		"type": 'POST',
				    		        "url": "/admin/reporte/elimina-documento",
				    		     	"async": false,
				    		       // "dataType": 'json',
				    		        "data": {"id_adjunto": adjunto_id ,"documento_id": documento_id, "seguimiento_id": seguimiento_id} ,
				    		        "success": function(response){
	
//				    		        	if(response.respuesta){
//				    				        	
//				    		        	}else{
//				    		        		dialogOpen(response.mensaje, "ERROR");
//				    			        }	 
				    				}
				    			});			                
			                
			                }
			                
			            },
					FileUploaded: function(up, file, info) {
						//console.log(file);
						alert('El archivo: ' + file.name + ' fue agregado correctamente.');
						jQuery('#dialogIdUpload').wijdialog('close');
						$("#dialogIdUpload").remove();
						jQuery('#'+div_update).load(url_update);
					},
					Error: function(up, args) {
						
						var mensajeError = '';
						if(args.code == -9001){
							mensajeError = 'No puede adjuntar mas de un archivo.';
							args.message = "";
						}else{
							mensajeError = args.message;	
						}
						
						alert(mensajeError);
						$("div.plupload_message p i").html("");
					}
				}		
			})	
	});
}

/**
 * View Adjuntos
 * @param documento_id
 * @param url
 * @param div
 * @param dialod_id
 */
function viewAdjuntoGenerico(documento_id, seguimiento_id){

	var dialogArea = "<div id='dialogIdviewAdjuntos' style='display:true' title='ADJUNTOS'><div id='divViewAdjuntos'></div></div>";

	$("#content").append(dialogArea);
	//url unica para la generacion de la vista previa de un documento PDF
	url = "/admin/reporte/view-adjuntos-generico";
	if(seguimiento_id === undefined) { var seguimiento_id = -10;  }
    if(documento_id){		    
		$('#divViewAdjuntos').load(url,{"documento_id":documento_id, "seguimiento_id":seguimiento_id},
			function() {
			$('#dialogIdviewAdjuntos').wijdialog(
					{	"captionButtons": {
							"maximize": {"visible": true},
							"minimize": {"visible": false},
							"toggle": {"visible": false},
							"refresh": {"visible": false},
							"pin": {"visible": false},
							"close": {"visible": true}
							},
						"modal": false,
						//"width": 920,
						//"height": 700,
						//"maximizable" : true,
						"position": [ "center", "top"],
						"title": 'VISTA ADJUNTOS',
						"buttons": {"Cerrar": function(){
												jQuery(this).wijdialog('close');
												//jQuery(this).remove();
												}},
						"close": function(){
							jQuery(this).remove();
						}						
					});
			$('#dialogIdviewAdjuntos').wijdialog('maximize');
			}
		);
    }else{
        alert("Identificador no válido.");
        return;
    }	
}

function viewUnAdjunto(documento_id, seguimiento_id, adjunto_id){

	var dialogArea = "<div id='dialogIdviewAdjuntos' style='display:true' title='ADJUNTOS'><div id='divViewAdjuntos'></div></div>";

	$("#content").append(dialogArea);
	//url unica para la generacion de la vista previa de un documento PDF
	url = "/admin/reporte/view-un-adjunto";
	//if(seguimiento_id === undefined) { var seguimiento_id = -10;  }
    if(documento_id){		    
		$('#divViewAdjuntos').load(url,{"documento_id":documento_id, "seguimiento_id":seguimiento_id, "adjunto_id":adjunto_id},
			function() {
			$('#dialogIdviewAdjuntos').wijdialog(
					{	"captionButtons": {
							"maximize": {"visible": true},
							"minimize": {"visible": false},
							"toggle": {"visible": false},
							"refresh": {"visible": false},
							"pin": {"visible": false},
							"close": {"visible": true}
							},
						"modal": false,
						//"width": 920,
						//"height": 700,
						//"maximizable" : true,
						"position": [ "center", "top"],
						"title": 'VISTA ADJUNTOS',
						"buttons": {"Cerrar": function(){
												jQuery(this).wijdialog('close');
												//jQuery(this).remove();
												}},
						"close": function(){
							jQuery(this).remove();
						}						
					});
			$('#dialogIdviewAdjuntos').wijdialog('maximize');
			}
		);
    }else{
        alert("No se puede realizar la vista del adjunto. Identificador no válido.");
        return;
    }	
}



function imprimirHojaDeRuta(documento_ids){
	
	var dialogArea = "<div id='dialogIdHojaDeRuta' style='display:true' title='MENSAJE'><div id='divImpresion'></div></div>";
	
	$("#content").append(dialogArea);
	//$("#divImpresion").load('/vuc/ventanilla/imprimir-hoja-de-ruta/documento_id/'+documento_id);
	$("#divImpresion").load('/admin/reporte/hojaruta/id/'+documento_ids);
	$("#dialogIdHojaDeRuta").wijdialog(
			{	"captionButtons": {"maximize": {"visible": false},
					"minimize": {"visible": false},
					"toggle": {"visible": false},
					"refresh": {"visible": false},
					"pin": {"visible": false},
					"close": {"visible": true}
					},
				"modal": true,
				//"width": 900,
				//"height": 600,
				"position": [ "center", "center"],
				"title": "IMPRESION HOJA DE RUTA",
				"buttons": {"Cerrar": function(){jQuery(this).wijdialog('close');
									  //jQuery(this).remove();
				}},
				"close": function(){
					jQuery(this).remove();
				}	
			});	
	$('#dialogIdHojaDeRuta').wijdialog('maximize');
}

function viewSeguimientoFlujo(idDoc, hr ){
	
	var dialogArea = "<div id='dialogIdViewSeguimientoFlujo' style='display:true' title='MENSAJE'><div id='divImpresion'></div></div>";
	//alert("hola:"+hr+"-");
	$("#content").append(dialogArea);
	$("#divImpresion").load('/operador/seguimiento/viewflujo',{
        "id":idDoc,
        "idHR":hr
    });
	$("#dialogIdViewSeguimientoFlujo").wijdialog(
				{	"captionButtons": {
                    "maximize": {"visible": true},
                    "minimize": {"visible": false},
                    "refresh": {"visible": false},
                    "toggle": {"visible": false},
                    "pin": {"visible": false},
                    "close": {"visible": true}
                },
                    "modal": true,
                    "width": $(window).width(),
                    "height": $(window).height(),

					"position": {"top":"0px"},
					"title": "SEGUIMIENTO - FLUJO",
					"buttons": {
						"Cerrar": function(){jQuery(this).wijdialog('close');
											//jQuery(this).remove();
						}},
					"close": function(){
						jQuery(this).remove();
					}			
				});
	$('#dialogIdViewSeguimientoFlujo').wijdialog('maximize');
}

function imprimir_reporte(url_params, title){
	
	var dialogArea = "<div id='dialogIdReporte' style='display:true' title='MENSAJE'><div id='divImpresion'></div></div>";
	
	$("#content").append(dialogArea);
	$("#divImpresion").load(url_params);
	$("#dialogIdReporte").wijdialog(
			{	"captionButtons": {"maximize": {"visible": false},
					"minimize": {"visible": false},
					"toggle": {"visible": false},
					"refresh": {"visible": false},
					"pin": {"visible": false},
					"close": {"visible": true}
					},
				"modal": true,
				//"width": '990',
				//"height": '500',

				"position": [ "center", "top"],
				"title": title,
				"buttons": {
					"Cerrar": function(){jQuery(this).wijdialog('close'); 
							//jQuery(this).remove();
				}},
				"close": function(){
					jQuery(this).remove();
				}	
		});	
	$('#dialogIdReporte').wijdialog('maximize');
	
}

function viewAdjuntoSeg(id,doc,seg){
	var selectBox = document.getElementById(id);
	var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	if(selectedValue==0){ return }
	var adj = selectedValue;
	viewUnAdjunto(doc, seg, adj);
}

function select2add(id, tamanio, tdata, bmultiple, tplaceholder){
	$("#"+id).select2({
		width: tamanio,
		createSearchChoice:function(term, data) { 
			if ($(data).filter(function() { 
				return this.text.localeCompare(term)===0; 
			}).length===0) {
				return {id:term, text:term};
				}
			},
		multiple: bmultiple,
		placeholder: tplaceholder,
		dropdownCssClass: "select2-detalle",
		escapeMarkup: function (m) { return m; },
		data: tdata
	});
}

function select2edit(id, tamanio, tdata, sdata, bmultiple){
	$("#"+id).select2({
        width: tamanio,
        data: tdata,
        multiple: bmultiple,
		dropdownCssClass: "select2-detalle",
		escapeMarkup: function (m) { return m; },
        initSelection: function (element, callback) {
            callback(sdata);            
        }
    }).select2("val", [])
    .on("change", function() {
        console.log($(this).select2("val"))
    });
}

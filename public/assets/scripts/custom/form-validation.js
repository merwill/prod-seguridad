var FormValidation = function () {
	
	var ajaxEnviar = function (form) {
		//$('#modal_nuevo').modal('hide');
        App.startPageLoading();
        $.ajax({
            type: $(form).attr('method'),
            url: $(form).attr('action'),
            data: $(form).serialize(),
            dataType: "json",
            success: function (data) {
                if(data.respuesta){ 	
                    App.startPageLoading();
                    $('#modal_nuevo').modal('hide');
                    jQuery('#content').load('/administracion/index/parametrica');
                    App.showMessage(data.mensaje);
                }else{
                    //App.showMessage(data.mensaje,'ERROR');
                    bootbox.alert(data.mensaje);
                }
                App.stopPageLoading();
            },
            error : function(jqXHR, status, error) {
                App.showMessage('Ocurrio un error al ejecutar la p&aacute;gina.','ERROR');
                App.stopPageLoading();
            },
        });
       // $('#modal_nuevo').html('');
	}
	
    var handleFormSector = function() {
        //formSector
        var form1 = $('#formInsumo'); ///onsole.log(form1);
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);
//        var _ajax_enviar = function () {
//            var e = window, a = 'inner';
//            if (!('innerWidth' in window)) {
//                a = 'client';
//                e = document.documentElement || document.body;
//            }
//            return {
//                width: e[a + 'Width'],
//                height: e[a + 'Height']
//            }
//        }
        form1.validate({ 
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
//            	nombre: {
//                    required: true
//                },
//                id_aplicacion: {
//                	required: true
//                },
//                estado: {
//                    required: true
//                    //maxlength: 10
//                },
                
            },
            messages: { // custom messages for radio buttons and checkboxes
//            	nombre: {
//                        required: "Requerido"
//                    },
//                    id_aplicacion: {
//                    	required: "Requerido"
//                    },
//                    estado: {
//                    	required: "Requerido"
//                    },
                },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
            	bootbox.confirm("Est&aacute; seguro registrar los datos?", function(result) {
                    if(result){
                    	ajaxEnviar(form);
                    }
                    
                });
            	
            	//alert("www");
            }
        });
    }
    
 /*   var handleFormBanco = function() {
        //formSector
        var form1 = $('#formBanco');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                descripcion: {
                    maxlength: 100,
                    required: true
                },
                sigla: {
                    required: false,
                    maxlength: 10
                },
                
            },
            messages: { // custom messages for radio buttons and checkboxes
                    descripcion: {
                        required: "Debe registrar la descripci&oacute;n",
                        maxlength: "Como mínimo 100 caracteres"
                    },
                    sigla: {
                        maxlength: "Como mínimo 10 caracteres"
                    }
                },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
            	ajaxEnviar(form);
            }
        });
    }
    
    var handleFormRamo = function() {
        //formSector
        var form1 = $('#formRamo');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                descripcion: {
                    maxlength: 100,
                    required: true
                },
                sigla: {
                    required: false,
                    maxlength: 10
                },
                
            },
            messages: { // custom messages for radio buttons and checkboxes
                    descripcion: {
                        required: "Debe registrar la descripci&oacute;n",
                        maxlength: "Como mínimo 100 caracteres"
                    },
                    sigla: {
                        maxlength: "Como mínimo 10 caracteres"
                    }
                },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
            	ajaxEnviar(form);
            }
        });
    }
    
    var handleFormGestion = function() {
        //formSector
        var form1 = $('#formGestion');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                gestion: {
                    number: true,
                    maxlength: 4,
                    minlength: 4
                },
                n_tramite: {
                    number: true
                },
                n_modificacion_datos: {
                    number: true
                },
                n_resolucion: {
                    number: true
                },
                
            },
            messages: { // custom messages for radio buttons and checkboxes
                    gestion: {
                        number: "Solo Números",
                        maxlength: "La gestión debe ser de 4 digitos"
                    },
                    n_tramite: {
                        number: "Solo Números",
                    },
                    n_modificacion_datos: {
                        number: "Solo Números",
                    },
                    n_resolucion: {
                        number: "Solo Números",
                    },
             },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
            	ajaxEnviar(form);
            }
        });
    }
    
    var handleFormRegional = function() {
        //formSector
        var form1 = $('#formRegional');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                regional: {
                    required: true,
                },
                
            },
            messages: { // custom messages for radio buttons and checkboxes
                regional: {
                    required: "Registrar el nombre de la regional",
                },
             },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
            	ajaxEnviar(form);
            }
        });
    }
    
    var handleFormTipoCuenta = function() {
        //formSector
        var form1 = $('#formTipoCuenta');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                descripcion: {
                    maxlength: 100,
                    required: true
                },
                sigla: {
                    required: false,
                    maxlength: 10
                },
                
            },
            messages: { // custom messages for radio buttons and checkboxes
                    descripcion: {
                        required: "Debe registrar la descripci&oacute;n",
                        maxlength: "Como mínimo 100 caracteres"
                    },
                    sigla: {
                        maxlength: "Como mínimo 10 caracteres"
                    }
                },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
            	ajaxEnviar(form);
            }
        });
    }
    
    var handleFormTipoTramite = function() {
        //formSector
        var form1 = $('#formTipoTramite');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                descripcion: {
                    maxlength: 100,
                    required: true
                },
                sigla: {
                    required: false,
                    maxlength: 10
                },
                costo: {
                    required: true,
                    maxlength: 10
                },
                
            },
            messages: { // custom messages for radio buttons and checkboxes
                    descripcion: {
                        required: "Debe registrar la descripci&oacute;n",
                        maxlength: "Como mínimo 100 caracteres"
                    },
                    sigla: {
                        maxlength: "Como mínimo 10 caracteres"
                    },
                    descripcion: {
                        required: "Debe registrar el costo del trámite",
                    },
                },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
            	ajaxEnviar(form);
            }
        });
    }
    
    var handleFormTipoProceso = function() {
        //formSector
        var form1 = $('#formTipoProceso');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                nombre: {
                    maxlength: 100,
                    required: true
                },
                sigla: {
                    required: false,
                    maxlength: 10
                },
                
            },
            messages: { // custom messages for radio buttons and checkboxes
                    nombre: {
                        required: "Debe registrar el nombre del proceso",
                        maxlength: "Como mínimo 100 caracteres"
                    },
                    sigla: {
                        maxlength: "Como mínimo 10 caracteres"
                    }
                },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
            	ajaxEnviar(form);
            }
        });
    }
    
    var handleFormTipoBanco = function() {
        //formSector
        var form1 = $('#formTipoBanco');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                banco_id: {
                    required: true
                },
                tipo_cuenta_id: {
                    required: true,
                },
                numero_cuenta: {
                    required: true,
                },
            },
            messages: { // custom messages for radio buttons and checkboxes
                    banco_id: {
                        required: "Debe seleccionar el banco",
                    },
                    tipo_cuenta_id: {
                        required: "Debe seleccionar el tipo de cuenta",
                    },
                    numero_cuenta: {
                        required: "Registrar el número de cuenta",
                    }
                },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
            	ajaxEnviar(form);
            }
        });
    }
    
    var handleFormTipoEntidad = function() {
        //formSector
        var form1 = $('#formTipoEntidad');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                descripcion: {
                    required: true
                },
                sector_entidad_id: {
                    required: true,
                },
            },
            messages: { // custom messages for radio buttons and checkboxes
                    descripcion: {
                        required: "Debe registrar la descripción",
                    },
                    sector_entidad_id: {
                        required: "Debe seleccionar el tipo de sector",
                    },
                },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
            	ajaxEnviar(form);
            }
        });
    }
    */
    return {
        //main function to initiate the module
        init: function () {

            handleFormSector();
           // ajaxEnviar('#formInsumo');
//            handleFormBanco();
//            handleFormRamo();
//            handleFormGestion();
//            handleFormRegional();
//            handleFormTipoCuenta();
//            handleFormTipoTramite();
//            handleFormTipoProceso();
//            handleFormTipoBanco();
//            handleFormTipoEntidad();
        }

    };

}();
const { default: Axios } = require("axios");
const { default: swal } = require("sweetalert");
const { default: Swal } = require("sweetalert2");

//*********************Mi codigo de Javascript************************


new Vue({
    el:'#app_login',
    data:{
        usuario:'',
        password:''
    },

    methods:{
        iniciarSesion: function(){
            axios.post('login',{
                usuario: this.usuario,
                password: this.password
            })
            
            .then(response=>{
                //if (response.data.error){
                    //console.log(response.error.data);
                    //location.reload();
                //console.log(response);
                //window.location.href = '/menu';
                //window.location.hostname + '/menu';
                //Swal('Has iniciado sesion','Datos correctos','success');
                //} else{
                   // window.location.href = "menu";
                    Swal.fire({
                        title:'Has iniciado sesión',
                        text:'Datos correctos',
                        icon:'success',
                        closeOnClickOutside: false,
                        closeOnEsc: false
                    }

                    ).then(select =>{
                        if (select){
                            window.location.href = "menu";
                        }
                    })
                //}
            })
            
            .catch(error=>{
                
                let er = error.response.data.errors;
                let mensaje = "Error no identificado";

                
                if (er.hasOwnProperty('usuario')){
                    mensaje = er.usuario[0];
                }else if(er.hasOwnProperty('password')){
                    mensaje = er.password[0];
                }else if(er.hasOwnProperty('login')){
                    mensaje = er.login[0];
                }else if(er.hasOwnProperty('logout')){
                    mensaje = er.logout[0];
                }
                Swal.fire(
                    'ERROR',
                    mensaje,
                    'error'
                  )
                //console.log(response.error.data);
                //window.location.href = '/index';
            })
        }
    }
})
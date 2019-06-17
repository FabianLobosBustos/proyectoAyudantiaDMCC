<template>
    <div v-if="login">
        <div v-if="proceso">
            <menu-asignatura-component></menu-asignatura-component>
        </div>
        <div v-else>
            <asignatura-component class ="col l3" v-for = "(asignatura,index) in asignaturas"
                :key="asignatura.id"
                :asignatura = "asignatura"
                @asignaturaBoton= "seleccionAsignatura(index)"> 
            </asignatura-component>
        </div>
    </div>
    <div v-else>
        <ingreso-coordinator-component @botonIngresar="logear"></ingreso-coordinator-component> 
    </div>
    

</template>
<!--
<style scoped>
    .container{
      height: 150px;
    }
    .input-field{
      top: 30px;
    }
</style>
-->
<script>
  
    export default {
        data(){
            return {
                login: false,
                asignaturas:null,
                proceso: false,
                asignatura: null
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods:{
           logear(res){
               console.log('Me logie');
               //ESTAS DEBERIAN SER SOLAMENTE LAS SUNJECTS DEL COORDINADOR EN CUESTION
               axios.get('/subjects').then((response)=>{
                this.asignaturas = response.data; 
                console.log(response);
                this.login = true;
             });
           },
           seleccionAsignatura(index){
               this.proceso = true;
               this.asignatura = this.asignaturas[index];
               //AQUI PONER LA FUNCIONALIDAD DE QUE ME CAMBIE AL MENU DE ASIGNATURA
           } 
        }
    }
</script>
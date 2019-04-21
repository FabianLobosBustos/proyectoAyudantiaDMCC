<template>
<div>   
        <div v-if= "login">
            <p class= "center-align">
                Formulatio único para concursar al cargo de ayudante alumno para
                el periodo que comprende los meses de Inserte Meses:
            <p>
            <br>
                <div class="container ">
                    <div class= "row">
                            <asignatura-component class ="col l3" v-for = "(asignatura) in asignaturas"
                                :key="asignatura.id"
                                :asignatura = "asignatura"> 
                            </asignatura-component>
                    </div>

                </div>
        </div>
        <div v-else>
            <mensaje-component ></mensaje-component>
            <div class="container">
                <ingreso-component @botonIngresar= "logear"></ingreso-component>
            </div>
        </div>
</div>

</template>

<script>
    export default {
        data(){
            return {
                asignaturas:[{
                    id: 1,
                    name: "Algebra 1"
                },{
                    id: 2,
                    name: "Algebra 2"
                },{
                    id: 3,
                    name: "Calculo 1"
                },{
                    id: 4,
                    name: "Calculo 2"
                },{
                    id: 5,
                    name: "Ecuaciones diferenciales"
                }],
                student:[],
                login: true
            }
        },
        mounted() {
            console.log('Component mounted.');
           // axios.get('/asignatura').then((response)=>{
            //    this.asignaturas = response.data; 
            // });
        },
        methods:{
            logear(params){
                let student = {
                    id:1,
                    rut: params.rut,
                    name: "cristian",
                    apellido: "sepúlveda"
                };
                this.student = student;
                this.login = true;
            }
        }
    }
</script>

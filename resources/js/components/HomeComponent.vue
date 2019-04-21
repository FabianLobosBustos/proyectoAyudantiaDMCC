<template>

    <div v-if="login">
        <formulario-component v-if="proceso"
            :estudiante = "student"
            :asignatura = "asignaturaActual">
        </formulario-component>   

        <div v-else class="container ">
            <p class= "center-align">
                    Formulatio único para concursar al cargo de ayudante alumno para
                    el periodo que comprende los meses de Inserte Meses:
            <p>
            <br>
            <div class= "row">
                <asignatura-component class ="col l3" v-for = "(asignatura,index) in asignaturas"
                    :key="asignatura.id"
                    :asignatura = "asignatura"
                    @asignaturaBoton= "seleccionAsignatura(index)"> 
                </asignatura-component>
            </div>
        </div>
    </div>                    

    <div v-else>
        <mensaje-component ></mensaje-component>
        <div class="container">
            <ingreso-component @botonIngresar="logear"></ingreso-component>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                asignaturas:[{   //aqui deberia un un arreglo vacio para el axios
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
                asignaturaActual: [],
                login: false,
                proceso: false
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
                //aqui debo obtener una respuesta con el alumno y esa se la paso al this.student
                let student = {
                    id:1,
                    rut: params.rut,
                    nombre: "cristian",
                    apellidoP: "sepúlveda",
                    apellidoM: "córdova",
                    correo: "cristian@usach.cl",
                    direccion: "suPutamadre 123, calle la pulgas 69",
                    telefono: "12345678"
                };
                this.student = student;
                this.login = true;
            },
            seleccionAsignatura(index){
                this.asignaturaActual = this.asignaturas[index];
                this.proceso = true;
            }
        }
    }
</script>

<template>

    <div v-if="login">
        <formulario-component v-if="proceso"
            :estudiante = "student"
            :asignatura = "asignaturaActual"
            :faculty = "facultad"
            :career = "carrera"
            @botonEnviar="cambioProceso">
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
                proceso: false,
                facultad: "facultad",
                carrera: "carrera"
            }
        },
        mounted() {
            console.log('Component mounted.');
            axios.get('/subjects').then((response)=>{
                this.asignaturas = response.data; 
             });
        },
        methods:{
            logear(res){
                //aqui debo obtener una respuesta con el alumno y esa se la paso al this.student
                let studentX = {
                    rut: res.rut,
                    name: "",
                    lastNameMom: "",
                    lastNameDad:"",
                    email: "",
                    address: "",
                    fone: "",
                    level: ""
                };             
                axios.post('students/checkByRut', {rut: res.rut
                        }
                ).then((response)=>{
                if(response.data == 0){
                    this.student = studentX;
                    console.log(this.student);
                }
                else{
                    this.student = response.data;
                console.log(this.student);
                } 
                this.login = true;
                });
            },
            seleccionAsignatura(index){
                this.asignaturaActual = this.asignaturas[index];
                this.proceso = true;
                console.log(this.student);
                //AQUI SE PIDEN LOS REQUISITOS DE LA ASIGNATURA EN CUESTIÓN
            },
            cambioProceso(){
                this.proceso = false;
                console.log(this.student.rut)
                axios.post('students/checkByRut', {rut: this.student.rut
                        }
                ).then((response)=>{
                this.student = response.data;
                }); 
            }
        }
    }
</script>

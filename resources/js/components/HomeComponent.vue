<template>

    <div v-if="login">
        <formulario-component v-if="proceso"
            :estudiante = "student"
            :asignatura = "asignaturaActual"
            :faculties = "faculties"
            :career = "carrera"
            :notaAlumno = "notaAlumno"
            :requisitos = "requisitos"
            @botonEnviar="cambioProceso"
            @botonAtras="actualizarEstado">
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
                faculties:null ,
                carrera: "carrera",
                requisitos: null,
                notaAlumno: []
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
                    this.student = response.data[0];
                console.log(this.student);
                } 
                this.login = true;
                });
            },
            seleccionAsignatura(index){
                this.asignaturaActual = this.asignaturas[index];
                console.log(this.student);
                axios.get('/allFacultiesCareers').then((response)=>{
                this.faculties = response.data; 
                });

                const url = "subject/"+this.asignaturaActual.id+"/requirements";
                axios.get(url).then((response)=>{
                    this.requisitos = response.data; 
                    console.log("requisitos");
                    console.log(response.data);
                });

                const urlNotas = "student/"+this.student.id+"/subject/"+this.asignaturaActual.id;
                axios.get(urlNotas).then((response)=>{
                    console.log(response.data);
                    var i,j;
                    for(i=0;i<this.requisitos.length;i++){
                        for(j=0;j<response.data.length;j++){
                            if(this.requisitos[i][0] == response.data[j].subject_id){
                                this.notaAlumno[i] = response.data[j].score;
                                console.log("estamos en el for:"+i + "," +j);
                                console.log(this.notaAlumno[i]);
                            }
                        }
                    }
                    console.log("ahora muestro las notas del alumno");
                    console.log(this.notaAlumno);
                                    this.proceso = true;

                });
            },
            cambioProceso(){
                console.log(this.student.rut)
                axios.post('students/checkByRut', {rut: this.student.rut
                        }
                ).then((response)=>{
                this.student = response.data[0];
                });
                const urlNotas = "student/"+this.student.id+"/subject/"+this.asignaturaActual.id;
                axios.get(urlNotas).then((response)=>{
                    console.log(response.data);
                    var i,j;
                    for(i=0;i<this.requisitos.length;i++){
                        for(j=0;j<response.data.length;j++){
                            if(this.requisitos[i][0] == response.data[j].subject_id){
                                this.notaAlumno[i] = response.data[j].score;
                                console.log("estamos en el for:"+i + "," +j);
                                console.log(this.notaAlumno[i]);
                            }
                        }
                    }
                    console.log("ahora muestro las notas del alumno");
                    console.log(this.notaAlumno);
                });
                this.proceso = false; 
            },
            actualizarEstado(){
                this.proceso= false; 
            }
            
        }
    }
</script>




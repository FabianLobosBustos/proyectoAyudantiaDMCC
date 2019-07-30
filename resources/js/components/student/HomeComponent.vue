<template>

    <div v-if="login">
        <formulario-component v-if="proceso"
            :estudiante = "assistant"
            :asignatura = "asignaturaActual"
            :faculties = "faculties"
            :career = "carrera"
            :assistantFaculty = "assistantFaculty"
            :assistantCareer = "assistantCareer"
            :notaAlumno = "notaAlumno"
            :requisitos = "requisitos"
            :subjectPeriod = "subjectPhase"
            @botonEnviar="cambioProceso"
            @botonAtras="actualizarEstado">
        </formulario-component>   

        <div v-else class="container ">
            <p class= "center-align presentacion">
                    Formulario único para concursar al cargo de ayudante alumno para
                    el periodo {{subjectPhase.semester}}-{{subjectPhase.year}}
            <p>
            <br>
            <br>
            <br>
            <div class= "row card cardA">
                <asignatura-component class ="col l4" v-for = "(asignatura,index) in asignaturas"
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

<style scoped>
.cardA{
        padding-top: 30px;
        padding-bottom: 20px;
        background-color: #f3f3f3;
        box-shadow: 8px 7px 13px 7px rgba(0,0,0,0.52);

    }
.presentacion{
    line-height: 1.2;
    font-weight: 500;
    font-size: 25px;
    padding-top: 40px;
    color: #333333
    
}
</style>
<script>
    export default {
        data(){
            return {
                asignaturas:[{   //aqui deberia un un arreglo vacio para el axios {{subjectPhase.semester}}-{{subjectPhase.year}}
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
                assistant:[],
                asignaturaActual: [],
                login: false,
                proceso: false,
                faculties:null ,
                carrera: "carrera",
                requisitos: null,
                notaAlumno: [],
                assistantFaculty:null,
                assistantCareer:null,
                subjectPhase:null 
            }
        },
        mounted() {
            console.log('Component mounted.');
            axios.get('/subjects').then((response)=>{
                this.asignaturas = response.data; 
             });
            const urlPhase = "phaseBySubject/"+this.asignaturas[0].id;
                axios.get(urlPhase).then((response)=>{
                    console.log("la respuesta:");
                    console.log(response.data);
                    this.subjectPhase = response.data;
                    console.log("el id del periodo es "+this.subjectPhase.id);
                });
        },
        methods:{
            logear(res){
                //aqui debo obtener una respuesta con el alumno y esa se la paso al this.assistant
                let assistantX = {
                    rut: res.rut,
                    name: "",
                    lastNameMom: "",
                    lastNameDad:"",
                    email: "",
                    address: "",
                    fone: "",
                    level: "",
                    id: null
                };             
                axios.post('assistants/checkByRut', {rut: res.rut
                        }
                ).then((response)=>{
                if(response.data == 0){
                    this.assistant = assistantX;
                    console.log(this.assistant);
                }
                else{
                    console.log("response:");
                    console.log(response.data);
                    this.assistantFaculty = response.data.faculty.name;
                    this.assistantCareer = response.data.career.name;
                    this.assistant = response.data.assistant;
                } 
                this.login = true;
                });
            },
            seleccionAsignatura(index){
                this.asignaturaActual = this.asignaturas[index];
                console.log(this.assistant);
                axios.get('/allFacultiesCareers').then((response)=>{
                    this.faculties = response.data; 
                });
                const urlPhase = "phaseBySubject/"+this.asignaturaActual.id;
                axios.get(urlPhase).then((response)=>{
                    console.log("la respuesta:");
                    console.log(response.data);
                    this.subjectPhase = response.data;
                    console.log("el id del periodo es "+this.subjectPhase.id);
                });

                

                console.log(this.assistant.id);
                if(this.assistant.id!=null){
                    const urlNotas = "assistant/"+this.assistant.id+"/subject/"+this.asignaturaActual.id;
                    console.log("pedi las notas del qlo ");
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
                }
                const url = "subject/"+this.asignaturaActual.id+"/requirements";
                axios.get(url).then((response)=>{
                    this.requisitos = response.data; 
                    console.log("requisitos");
                    console.log(response.data);
                    this.proceso = true;
                });

            },
            cambioProceso(){
                console.log(this.assistant.rut)
                axios.post('assistants/checkByRut', {rut: this.assistant.rut
                        }
                ).then((response)=>{
                console.log("la respuesta en el cambio de proceso:");
                console.log(response.data);
                this.assistant = response.data.assistant;
                this.assistantFaculty = response.data.faculty.name;
                this.assistantCareer = response.data.career.name;
                });
                /*const urlNotas = "assistant/"+this.assistant.id+"/subject/"+this.asignaturaActual.id;
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
                });*/
                this.proceso = false; 
            },
            actualizarEstado(){
                this.proceso= false; 
            }
            
        }
    }
</script>




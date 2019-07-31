<template>
    <div class ="todo" v-if="login">
        <div v-if="proceso">
            <formulario-component 
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
        </div>
        <div v-else>
            <div class="container cardA"> 
                <p class= "center-align presentacion">
                        FORMULARIO ÚNICO PARA CONCURSAR AL CARGO DE AYUDANTE ALUMNO PARA EL PERIODO <span class ="periodo">{{subjectPhase.semester}}-{{subjectPhase.year}}</span>
                <p>
                <br>
                <br>
                <div  class= "row card cardA">
                    <h5 class="titulointerno">Ayudantias disponibles a postular:</h5>
                    <div class="lds-roller-container2">
                        <div v-if="spinner2" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    </div>
                    <asignatura-component :spinner2 = "spinner2" class ="col l4" v-for = "(asignatura,index) in asignaturas"
                        :key="asignatura.id"
                        :asignatura = "asignatura"
                        @asignaturaBoton= "seleccionAsignatura(index)"> 
                    </asignatura-component>
                </div>
            </div>
        </div>
    </div>                    

    <div v-else class ="container home">
        <h3 class="titulo">POSTULACIÓN DE AYUDANTIAS</h3>
        <P class = "texto">Bienvenido al sistema de postulación de <span class="claves">ayudantias</span>, en 
        este sitio podrás postular como ayudante a las <span class="claves">asignaturas</span> 
        que tengan activo este proceso, <span class="claves">ingresa tu rut para comenzar:</span>
        </p>
        <div class="lds-roller-container">
            <div v-if="spinner1" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
        <br>
        <br>
        <br>
        <div class="container">
            <ingreso-component :spinner1 = "spinner1"  @botonIngresar="logear"></ingreso-component>
        </div>
    </div>

</template>

<style scoped>
.texto{
    color:#333;
    font-size: 20px;
    line-height: 1.2;

}
.claves{
    color:rgb(46, 45, 45);
    font-weight: 600;
    font-size: 20px;
    line-height: 1.2;
}
.periodo{
    color: orange;
}
.titulo{
    padding-top: 20px; 
    padding-bottom: 40px;
    font-family: 'Merriweather', serif;
    text-align: center;
    font-weight: 500;
}
.titulointerno{ 
        padding-bottom: 30px;
        color:#333;
        margin-left: 15px;
        font-weight: 500;
    }
.cardA{

        padding-top: 10px;
        padding-bottom: 20px;
        background-color: #ffffff;
    }
.presentacion{
    line-height: 1.2;
    font-weight: 500;
    font-size: 40px;
    padding-top: 10px;
    color: #333;
    font-family: 'Merriweather', serif;
    text-align: center;
}
.lds-roller-container{
    position: absolute;
    right: 50%;
}
.lds-roller-container2{
    position: absolute;
    right: 50%;
    top: -30%;
}
.lds-roller {
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 32px 32px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: rgb(62, 23, 206);
  margin: -3px 0 0 -3px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}
.lds-roller div:nth-child(1):after {
  top: 50px;
  left: 50px;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 54px;
  left: 45px;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 57px;
  left: 39px;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 58px;
  left: 32px;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 57px;
  left: 25px;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 54px;
  left: 19px;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 50px;
  left: 14px;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 45px;
  left: 10px;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
     
  }
}


</style>
<script>
    export default {
        name: 'ProgressSpinnerIndeterminate',
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
                spinner1:false,
                spinner2:false,
                spinner3:false,
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
                this.spinner1 = true;
                var resp = res.rut;
                var cuerpo = resp.slice(0,-1);
                var dv = resp.slice(-1).toUpperCase();
                //aqui debo obtener una respuesta con el alumno y esa se la paso al this.assistant
                let assistantX = {
                    rut: cuerpo,
                    verificatorDigit: dv,
                    name: "",
                    lastNameMom: "",
                    lastNameDad:"",
                    email: "",
                    address: "",
                    fone: "",
                    level: "",
                    id: null
                };             
                axios.post('assistants/checkByRut', {rut: cuerpo
                        }
                ).then((response)=>{
                    console.log("response:");
                    console.log(response.data);
                if(response.data == 0){
                    this.assistant = assistantX;
                    console.log(this.assistant);
                }
                else{
                    console.log("response:");
                    console.log(response.data);
                    this.assistantFaculty = response.data.faculty.name;
                    this.assistantCareer = response.data.career.name;
                    this.career = response.data.career.name;
                    this.assistant = response.data.assistant;
                } 
                this.spinner1 = false;
                this.login = true;
                });
            },
            seleccionAsignatura(index){
                this.spinner2 = true;
                this.asignaturaActual = this.asignaturas[index];
                console.log(this.assistant);
                axios.get('/allFacultiesCareers').then((response)=>{
                    this.faculties = response.data;
                    console.log("facultades: ", response.data); 
                });
                const urlPhase = "phaseBySubject/"+this.asignaturaActual.id;
                axios.get(urlPhase).then((response)=>{
                    console.log("la respuesta:");
                    console.log(response.data);
                    this.subjectPhase = response.data;
                    console.log("el id del periodo es "+this.subjectPhase.id);
                });

                const url = "subject/"+this.asignaturaActual.id+"/requirements";
                axios.get(url).then((response)=>{
                    this.requisitos = response.data; 
                    console.log("requisitos");
                    console.log(response.data);
                });
                
                if(this.assistant.id!=null){
                    const urlNotas = "assistant/"+this.assistant.id+"/subject/"+this.asignaturaActual.id;
                    console.log("pedi las notas del qlo ");
                    axios.get(urlNotas).then((response)=>{
                        console.log("entre aqui?");
                        console.log(response.data);
                        var i,j;
                        for(i=0;i<this.requisitos.length;i++){
                            console.log("entre aqui22222?");
                            for(j=0;j<response.data.length;j++){
                                console.log("entre aqui333333?");
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
                        this.proceso = true;
                        this.spinner2 = false;
                    });
                }
                else{
                    this.proceso = true;
                    this.spinner2 = false;
                }
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




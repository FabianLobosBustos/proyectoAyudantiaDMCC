<template v-if="bool">
    <div class="container "> 
        <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">  
        <div class="row card cardT tarjeta">
            <h4 class="center-align titulo">POSTULACIÓN DE AYUDANTE PARA LA ASIGNATURA <nombreAsig>{{asignatura.name}}</nombreAsig></h4>  
            <br>
            <br>
            <form class="col s12"  v-on:submit.prevent=enviar() >
                <div class="row card cardI ">
                    <h5 class="titulointerno"> Datos Personales:</h5> 
                    <div class="col s6">
                        <p class = "parrafo" for="nombre">Nombre:</p>
                        <input class ="validate" required type="text"  placeholder="Ingresa tu nombre" id="nombre" v-model ="estudiante.name">    
                    </div>
                    <div class="col s6">
                        <p class = "parrafo" for="correo">Correo:</p>
                        <input class="validate" required type="email" placeholder="ejemplo@usach.cl" id="correo" v-model="estudiante.email">
                            
                    </div>
                    <div class="col s6">
                        <p class = "parrafo" for="apellidoPaterno">Apellido Paterno:</p>
                        <input class="validate" required type="text" placeholder="Ingresa tu Apellido Paterno" id="apellidoPaterno" v-model="estudiante.lastNameDad">    
                    </div>
                    <div class="col s6">
                        <p class = "parrafo" for="apellidoMaterno">Apellido Materno:</p>
                        <input class="validate" required type="text" placeholder="Ingresa tu Apellido Materno" id="apellidoMaterno" v-model="estudiante.lastNameMom">
                    </div>
                    <div class="col s6">
                        <p class = "parrafo" for="telefono">Teléfono:</p>
                        <input class="validate" required type="number" placeholder="12345678" id="telefono" v-model="estudiante.fone">
                    </div>
                    <div class="col s6">
                        <p class = "parrafo" for="direccion">Dirección:</p>
                        <input class="validate" required type="text" placeholder="Ingresa tu dirección " id="direccion" v-model="estudiante.address">
                    </div>
                </div>
                <div class="row card cardI">
                    <h5 class="titulointerno"> Datos Curriculares:</h5> 
                    <div class="col s6">
                        <p class = "parrafo">Facultad:</p>
                            <select @change="onChange()"  class="browser-default validate"  required type="text" v-model="facultyStudent">
                                <option disabled selected >Seleccione su Facultad</option>
                                <option v-for = "(facultad,index) in faculties"
                                    :key="index"
                                    >{{facultad.faculty_name}}
                                </option>
                            </select>
                    </div>
                    <div class="col s6">
                        <p class = "parrafo">Carrera:</p>
                            <select  class="browser-default validate" v-if="facultadSeleccionada" required type="text" v-model="careerStudent">
                                <option disabled selected >Seleccione su Carrera</option>
                                <option v-for = "(carrera,index) in careers"
                                    :key="index"
                                    >{{carrera.career_name}}
                                </option>
                            </select>
                            <select class="browser-default validate" v-else required type="text" v-model="careerStudent" disabled>
                                <option disabled selected >Seleccione su Carrera</option>
                                <option v-for = "(carrera,index) in careers"
                                    :key="index"
                                    >{{carrera.career_name}}
                                </option>
                            </select>

                        <!--<p class = "parrafo" for="Carrera">Carrera:</p>
                        <input class="validate" required type="text" placeholder="Ingrese Carrera" id="Carrera" v-model ="career">-->
                    </div>
                    <div class="col s6">
                        <p class = "parrafo">Nivel:</p>
                        <input required id="email_inline" type="number" class="validate" max="12" min="1" v-model="estudiante.level">
                        
                        <span class="helper-text" data-error="Error" > Correspode al nivel de la asignatura más baja</span>
                    </div>
                    <div class="col s6">
                        <p class = "parrafo">PPA:</p>
                        <input required id="email_inline" type="number" class="validate" max="7" min="0" v-model="estudiante.ppa">
                        
                        <span step="0.1" class="helper-text" data-error="Error" placeholder="ej: 1.89" >Corresponde al Promedio Ponderado Acumulado</span>
                    </div>
                </div> 
                <div class="row card cardI ">
                    <h5 class="titulointerno"> Datos sobre la asignatura:</h5>     
                    <div class="col s12">
                        <div class="col s4" v-for= "(requisito, index) in requisitos" :key= index>
                                <p class = "parrafo">Nota {{requisito[1]}}:</p>
                                <input step="0.1" id="email_inline" type="number" required class="validate" placeholder="ej: 4.8" max="7.0" min="4.0" v-model="notaAlumno[index]">
                                <span class="helper-text" data-error="Error" ></span>
                        </div>
                    </div>
                    <div class="col s6">
                        <p class = "parrafo veces">Cantidad de veces que ha sido ayudante de {{asignatura.name}}:</p>
                        <input required id="email_inlin" type="number" class="validate"  min=0 v-model="postulacion.numberTimes">   
                    </div>
                    <div class="col s6">
                        <br>
                        <p class = "parrafo" for="Referencia">Profesor de Referencia:</p>
                        <input  class="validate" required type="text" placeholder="Ingrese nombre del profesor" id="Referencia" v-model="postulacion.reference">
                    </div>
                    <div class="col s6">
                        <button class="waves-effect orange btn" type="submit" v-on:click= "atras()">Atrás</button>    
                    </div>
                    <div class="col s6 right-align">
                        <button class="waves-effect orange btn" type="submit" v-on:click= "enviar()">Enviar</button>    
                    </div>
                </div>
                
            </form>
        </div>

    </div> 
</template>

<style scoped>
    
    .tarjeta{
        background-color: #f3f3f3;
        box-shadow: 8px 7px 13px 7px rgba(0,0,0,0.52);
        padding-bottom: 90px;
    }
    .cardI{
        padding-left: 20px;
        padding-bottom: 20px;
        margin-left: 10px;
        margin-right: 10px;
    }
    .veces{
        margin-top:24px;
    }
    .col{
        
        line-height: 0.7;
    }
    .titulointerno{
        padding-top: 20px; 
        padding-bottom: 30px;
        color:orange;
        margin-top: 20px;
        margin-left: 15px;
    }
    .btn{
        font-size:13px;
        width: 220px;
        height: 35px;
        bottom: -100px
    }
    .parrafo{
        font-weight: 600;
        font-size: 15px;
    }
    nombreAsig{   
        font-family: 'Merriweather', serif;   
        color:orange;
    }
    .titulo{
        padding-top: 40px; 
        font-family: 'Merriweather', serif;
        color:darkblue;
    }    
</style>


<script>
    export default {
        props: ['estudiante', 'asignatura','faculties','career','notaAlumno','requisitos','studentFaculty','studentCareer','subjectPeriod'],
        data(){
            return {
                asignaturas: 1,
                postulacion: [{
                    numberTimes:"",
                    reference: ""
                    }],
                careerStudent: null,
                facultyStudent: null,
                careers: null,
                facultadSeleccionada: false
            }
        },
        mounted() {

            //este par de weas, mandarlas desde el home, por el problema del cargado.
            console.log('Component mounted.');
            console.log('facultad:');
            console.log(this.studentFaculty);
            console.log('carrera:');
            console.log(this.studentCareer);
            console.log("arreglo de facultades: ");
            console.log(this.faculties);
            if(this.studentFaculty != null){
                var i;
                var index = -1;
                console.log("largo de faculties: "+this.faculties.length);
                    for(i=0;i<this.faculties.length;i++){
                        console.log("facultad[i]");
                        console.log(this.faculties[i].faculty_name);
                        console.log(this.studentFaculty);
                        if(this.studentFaculty === this.faculties[i].faculty_name){  
                            console.log("entre al IF RECULIAO CONCHETUMARE")  
                            index = i;
                        }
                    }
                    this.facultyStudent = this.studentFaculty;
                    this.careerStudent = this.studentCareer; 
                    console.log("index:");
                    console.log(index);
                    console.log(this.faculties[index])
                    this.careers = this.faculties[index].careers;
                    
                this.facultadSeleccionada = true;
            }
        },
        methods:{
            onChange(){
                var i;
                var index = -1;
                if(this.facultyStudent != null){
                    for(i=0;i<this.faculties.length;i++){
                        if(this.facultyStudent == this.faculties[i].faculty_name){
                        index = i;
                        }
                    }
                    //console.log(event.target.value)
                    this.careers = this.faculties[index].careers;
                    console.log(this.careers);
                    this.facultadSeleccionada = true;
                }
            },
            enviar(){
                var i;
                for (i = 0; i < this.notaAlumno.length; i++) {
                    this.notaAlumno[i] = parseFloat(this.notaAlumno[i]);
                };
                for (i = 0; i < this.requisitos.length; i++) {
                    this.requisitos[i] = {id:this.requisitos[i][0],
                                        name: this.requisitos[i][1]};
                    console.log("el requisito sub i : ");
                    console.log(this.requisitos[i]);
                };
                const params = {
                assistantSend:{
                    rut: this.estudiante.rut,
                    name: this.estudiante.name,
                    email: this.estudiante.email,
                    lastNameDad: this.estudiante.lastNameDad,
                    lastNameMom: this.estudiante.lastNameMom,
                    fone: this.estudiante.fone,
                    address: this.estudiante.address,
                    level: this.estudiante.level,
                    ppa: this.estudiante.ppa,
                    career: this.careerStudent,
                    faculty: this.facultyStudent
                },
                postulationSend:{
                    numberTime: (this.postulacion.numberTimes),
                    referenceTeacher_id: parseInt(this.postulacion.reference),
                    subject_id: this.asignatura.id,
                    subjectPeriod: this.subjectPeriod.id
                },
                requirement: this.requisitos,
                studentScore: this.notaAlumno

              };
              console.log(params);
              axios.post('postulations', params).then((response)=>{
                  this.$emit('botonEnviar');
                  console.log("lo envie");
                  console.log(response);
              }); 
            },
            atras(){
                this.$emit('botonAtras');
            }
        }
    }
</script>
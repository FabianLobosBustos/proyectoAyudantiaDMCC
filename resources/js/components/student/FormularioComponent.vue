<template v-if="bool">
    <div class="container ">  
        <div class="row card">
            <h5 class="center-align">Postulación de ayudante para asignatura {{asignatura.name}}</h5>
            <br>
            <form class="col s12"  v-on:submit.prevent=enviar() >
                    <div class="col s6">
                        <label for="nombre">Nombre:</label>
                        <input class ="validate" required type="text"  placeholder="Ingresa tu nombre" id="nombre" v-model ="estudiante.name">    
                    </div>
                    <div class="col s6">
                        <label for="correo">Correo:</label>
                        <input class="validate" required type="email" placeholder="ejemplo@usach.cl" id="correo" v-model="estudiante.email">
                            
                    </div>
                    <div class=" col s6">
                        <label for="apellidoPaterno">Apellido Paterno:</label>
                        <input class="validate" required type="text" placeholder="Ingresa tu Apellido Paterno" id="apellidoPaterno" v-model="estudiante.lastNameDad">    
                    </div>
                    <div class="col s6">
                        <label for="apellidoMaterno">Apellido Materno:</label>
                        <input class="validate" required type="text" placeholder="Ingresa tu Apellido Materno" id="apellidoMaterno" v-model="estudiante.lastNameMom">
                    </div>
                    <div class="col s6">
                        <label for="telefono">Teléfono:</label>
                        <input class="validate" required type="text" placeholder="12345678" id="telefono" v-model="estudiante.fone">
                    </div>
                    <div class="col s6">
                        <label for="direccion">Dirección:</label>
                        <input class="validate" required type="text" placeholder="Ingresa tu dirección " id="direccion" v-model="estudiante.address">
                    </div>
                    <div class="col s6">
                        <label>Facultad:</label>
                            <select @change="onChange()"  class="browser-default validate"  required type="text" v-model="faculty">
                                <option disabled selected >Seleccione su Facultad</option>
                                <option v-for = "(facultad,index) in faculties"
                                    :key="index"
                                    >{{facultad.faculty_name}}
                                </option>
                            </select>
                    </div>
                    <div class="col s6">
                        <label>Carrera:</label>
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

                        <!--<label for="Carrera">Carrera:</label>
                        <input class="validate" required type="text" placeholder="Ingrese Carrera" id="Carrera" v-model ="career">-->
                    </div>
                    <div class="col s6">
                        <label>Cantidad de veces que ha sido ayudante de {{asignatura.name}}:</label>
                        <input id="email_inlin" type="number" class="validate"  min=0 v-model="postulacion.numberTimes">   
                    </div>
                    <div class="col s6">
                        <label>Nivel:</label>
                        <input id="email_inline" type="number" class="validate" max="12" min="1" v-model="estudiante.level">
                        
                        <span class="helper-text" data-error="wrong" data-success="right"> Correspode al nivel de la asignatura más baja</span>
                    </div>
                    <div class="col s12">
                        <div class="col s4" v-for= "(requisito, index) in requisitos" :key= index>
                                <label>Nota {{requisito[1]}}:</label>
                                <input step="0.1" id="email_inline" type="number" required class="validate" placeholder="ej: 4.8" max="7.0" min="4.0" v-model="notaAlumno[index]">
                                <span class="helper-text" data-error="wrong" data-success="right"></span>
                        </div>
                    </div>
                    <div class="col s12">
                        <br>
                        <label for="Referencia">Profesor de Referencia:</label>
                        <input class="validate" required type="text" placeholder="Ingrese nombre del profesor" id="Referencia" v-model="postulacion.reference">
                    </div>
                    <div class="col s6">
                        <button class="waves-effect orange btn" type="button" v-on:click= "atras()">Atrás</button>    
                    </div>
                    <div class="col s6 right-align">
                        <button class="waves-effect orange btn" type="button" v-on:click= "enviar()">Enviar</button>    
                    </div> 
            </form>
        </div>
            
    {{notaAlumno}}

    </div> 
</template>

<style scoped>
    
    .card{
        height: 150vh;
    }
    .col{
        height: 13vh;
    }
    .btn{
        font-size:13px;
        width: 220px;
        height: 35px;
        bottom: -100px
    }
    
</style>


<script>
    export default {
        props: ['estudiante', 'asignatura','faculties','career','notaAlumno','requisitos'],
        data(){
            return {
                asignaturas: 1,
                postulacion: [{
                    numberTimes:"",
                    reference: ""
                    }],
                faculty: null,
                careerStudent: null,
                careers: null,
                facultadSeleccionada: false
            }
        },
        mounted() {

            //este par de weas, mandarlas desde el home, por el problema del cargado.
            console.log('Component mounted.');
            
                   
        },
        methods:{
            onChange(){
                var i;
                var index = -1;
                if(this.faculty != null){
                    for(i=0;i<this.faculties.length;i++){
                        if(this.faculty == this.faculties[i].faculty_name){
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
                    this.notaAlumno[i] = parseInt(this.notaAlumno[i]);
                };
                for (i = 0; i < this.requisitos.length; i++) {
                    this.requisitos[i] = {id:this.requisitos[i][0],
                                        name: this.requisitos[i][1]};
                    console.log("el requisito sub i : ");
                    console.log(this.requisitos[i]);
                };
                const params = {
                studentSend:{
                    rut: this.estudiante.rut,
                    name: this.estudiante.name,
                    email: this.estudiante.email,
                    lastNameDad: this.estudiante.lastNameDad,
                    lastNameMom: this.estudiante.lastNameMom,
                    fone: this.estudiante.fone,
                    address: this.estudiante.address,
                    level: this.estudiante.level,
                    career: this.careerStudent,
                    faculty: this.faculty.faculty_name
                },
                postulationSend:{
                    numberTime: parseInt(this.postulacion.numberTimes),
                    referenceTeacher_id: parseInt(this.postulacion.reference),
                    subject_id: this.asignatura.id
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
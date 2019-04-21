<template v-if="bool">
    <div class="container ">
        <div class="row card">
            <h5 class="center-align">Postulación de ayudante para asignatura {{asignatura.name}}</h5>
            <br>
            <form class="col s12  ">
                    <div class="col s6">
                        <label for="nombre">Nombre:</label>
                        <input class ="validate" required type="text"  placeholder="Ingresa tu nombre" id="nombre" v-model="estudiante.nombre" >    
                    </div>
                    <div class="col s6">
                        <label for="correo">Correo:</label>
                        <input class="validate" required type="email" placeholder="ejemplo@usach.cl" id="correo" v-bind:value ="estudiante.correo">
                            
                    </div>
                    <div class=" col s6">
                        <label for="apellidoPaterno">Apellido Paterno:</label>
                        <input class="validate" required type="text" placeholder="Ingresa tu Apellido Paterno" id="apellidoPaterno" v-bind:value ="estudiante.apellidoP">    
                    </div>
                    <div class="col s6">
                        <label for="apellidoMaterno">Apellido Materno:</label>
                        <input class="validate" required type="text" placeholder="Ingresa tu Apellido Materno" id="apellidoMaterno" v-bind:value ="estudiante.apellidoM">
                    </div>
                    <div class="col s6">
                        <label for="telefono">Teléfono:</label>
                        <input class="validate" required type="text" placeholder="12345678" id="telefono" v-bind:value ="estudiante.telefono">
                    </div>
                    <div class="col s6">
                        <label for="direccion">Dirección:</label>
                        <input class="validate" required type="text" placeholder="Ingresa tu dirección " id="direccion" v-bind:value ="estudiante.direccion">
                    </div>
                    <div class="col s6">
                        <label for="facultad">Facultad:</label>
                        <input class="validate" required type="text" placeholder="Ingrese facultad" id="facultad" v-bind:value ="estudiante.facultad">
                    </div>
                    <div class="col s6">
                        <label for="Carrera">Carrera:</label>
                        <input class="validate" required type="text" placeholder="Ingrese Carrera" id="Carrera" v-bind:value ="estudiante.carrera">
                    </div>
                    <div class="col s3">
                        <label>Cantidad de veces que ha sido ayudante:</label>
                    </div>
                    <div class="col s3">
                        <label>
                            <input checked name="group1" type="radio" value=0 />
                            <span>ninguna</span>
                        </label>
                    </div>
                    <div class="col s3">
                        <label>
                            <input name="group1" type="radio" value=1/>
                            <span>una vez</span>
                        </label>
                    </div>
                    <div class="col s3">
                        <label>
                            <input name="group1" type="radio" value =2/>
                            <span>dos o más veces</span>
                        </label>
                    </div>
                    <div class="col s6">
                        <div class="col s4" v-for= "requisito in requisitos" :key= requisito.id>
                                Nota {{requisito.name}}:
                                <input step="0.1" id="email_inline" type="number" required class="validate" placeholder="ej: 4.8" max="7.0" min="4.0">
                                <span class="helper-text" data-error="wrong" data-success="right"></span>
                        </div>
                    </div>
                    <div class="col s6">
                        Level:
                        <input id="email_inline" type="number" class="validate" max="12" min="1">
                        
                        <span class="helper-text" data-error="wrong" data-success="right"> Correspode al nivel de la asignatura más baja</span>
                    </div>
                    <div class="col s12">
                        <br>
                        <label for="Referencia">Profesor de Referencia:</label>
                        <input class="validate" required type="text" placeholder="Ingrese nombre del profesor" id="Referencia">
                    </div>
                    <div class="col s6">
                        <button class="waves-effect orange btn" type="submit">Atrás</button>    
                    </div>
                    <div class="col s6 right-align">
                        <button class="waves-effect orange btn" type="submit" v-on:click= "enviar()">Enviar</button>    
                    </div> 
                    <div class="col s12">
                        {{estudiante.nombre}}
                    </div>
                    
            </form>
        </div>
            
    
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
        props: ['estudiante', 'asignatura'],
        data(){
            return {
                asignaturas: 1,
                student:[],
                requisitos: [{   //esto deberia cargar solo con axios en el mounted()
                    id: 1,
                    name: "Calculo 1"
                },{
                    id: 2,
                    name: "Algebra 1"
                },{
                    id: 3,
                    name: "Algebra 2"
                }]
            }
        },
        mounted() {
            console.log('Component mounted.');
            //axios.get('/pensamientos').then((response)=>{
              //  this.pensamientos = response.data; 
            //}); aqui se obtiene al alumno y se guarda en el data student
            this.student = estudiante;
           
        },
        methods:{
            enviar(){
              const params = {
                studentSend:[{
                    id: this.student.id,
                    rut: this.student.rut,
                    name: this.student.nombre
                }]
              };
              //aqui debemos hacer el axios que envie el rut, debo reibir al estudiante
              this.$emit('botonIngresar', params);
            }
        }
    }
</script>
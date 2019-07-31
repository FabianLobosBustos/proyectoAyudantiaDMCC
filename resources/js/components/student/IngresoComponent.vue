<template>

    <div class="card cardB">
      <form v-bind:disabled="spinner1" class="container" method="post" v-on:submit.prevent="ingresar()">      
        <div class="input-field col s6 ">
          <p class = "parrafo" for ="rutt">Rut: <span class="suave"> (sin puntos ni guión)</span></p>
          <input  required id="rutt" type="text" class="validate" placeholder= "12345678k" v-model= "rut">
          <span v-if="formato" class="helper-text formato" >Error en formato, recuerde no incluir puntos ni guión</span>
          <span v-if="valido"  class="helper-text formato" >Rut inválido</span>
          <span v-if="vacio"  class="helper-text formato" >Ingrese rut</span>
          <a v-bind:disabled="spinner1" class="waves-effect orange btn boton" type="submit" v-on:click= "ingresar()">Ingresar</a>
        </div>
      </form>
      
    </div>

</template>

<style scoped>
    .suave{
      color: gray;
      font-size: 12px;
    }
    .cardB{
        margin-bottom: 15px;
        padding-bottom: 65px;
        background-color: #ffffff;
    }
    .container{
      height: 150px;
    }
    .input-field{
      top: 30px;
    }
    .formato{
      color:red;
    }
    .parrafo{
      font-weight: 600;
      font-size: 15px;
      line-height: 1.0;
    }
</style>

<script>
    export default {
      props: ['spinner1'],
        data(){
            return {
                rut:'',
                formato: false,
                valido: false,
                vacio: false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            ingresar(){
              this.formato=false;
              this.valido=false;
              this.vacio =false;
              if(this.rut == ""){
                this.vacio = true;
                return false;
              }
              var valido = 0;
                //VALIDACION DEL RUT
                console.log("rut qlo es:", this.rut);
                var rutRazo = this.rut;
                var formato = rutRazo.replace('-','');
                formato = formato.replace('.','');
                if(formato!=rutRazo){
                  console.log("error de formato");
                  this.formato = true;
                  return false;
                }
                // Aislar Cuerpo y Dígito Verificador
                var cuerpo = rutRazo.slice(0,-1);
                var dv = rutRazo.slice(-1).toUpperCase();

                // Formatear RUN
                var rutFormateado = cuerpo + '-'+ dv;

                // Si no cumple con el mínimo ej. (n.nnn.nnn)
                if(cuerpo.length < 7) {console.log("RUT INCORRECTO"); 
                  this.valido=true; 
                  return false;}

                // Calcular Dígito Verificador
                var suma = 0;
                var multiplo = 2;
                var i;
                var index;
                // Para cada dígito del Cuerpo
                for(i=1;i<=cuerpo.length;i++) {
                
                    // Obtener su Producto con el Múltiplo Correspondiente
                    index = multiplo * rutRazo.charAt(cuerpo.length - i);
                    
                    // Sumar al Contador General
                    suma = suma + index;
                    
                    // Consolidar Múltiplo dentro del rango [2,7]
                    if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
            
                }

                // Calcular Dígito Verificador en base al Módulo 11
                var dvEsperado = 11 - (suma % 11);

                // Casos Especiales (0 y K)
                dv = (dv == 'K')?10:dv;
                dv = (dv == 0)?11:dv;

                // Validar que el Cuerpo coincide con su Dígito Verificador
                if(dvEsperado == dv) {  
                    console.log("dvEsperado = ",dvEsperado);
                    console.log("dv = ",dv);
                    valido = 1; 
                    }
                if(valido == 1){
                    console.log("rut valido :3");
                }
                else{
                    console.log("rut entero malo :o");
                    this.valido = true;cuerpo
                    return false;
                }
              const params = {
                rut: rutRazo
              };
              //aqui debemos hacer el axios que envie el rut, debo reibir al estudiante
              this.$emit('botonIngresar', params);
            }
        }
    }
</script>


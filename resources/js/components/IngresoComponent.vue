<template>

    <div class="container z-depth-3">
      <form class="container " v-on:submit.prevent="ingresar()">      
        <div class="input-field col s6 ">
          <input id="rutt" type="text" class="validate " placeholder= "12.345.678-9" v-model= "rut">
          <label for="rutt">Rut:</label>
          <a class="waves-effect orange btn"  v-on:click= "ingresar()">Ingresar</a>
        </div>
      </form>
    </div>

</template>

<style scoped>
    .container{
      height: 150px;
    }
    .input-field{
      top: 30px;
    }
</style>

<script>
    export default {
        data(){
            return {
                rut:''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            ingresar(){
              const params = {
                rut: this.rut
              };
              //aqui debemos hacer el axios que envie el rut, debo reibir al estudiante
              this.$emit('botonIngresar', params);
            }
        }
    }
</script>


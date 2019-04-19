<template>

    <div class="container z-depth-3">
      <div class="container">      
        <div class="input-field col s6 ">
          <input id="rutt" type="text" class="validate " placeholder= "12.345.678-9" v-model= "rut">
          <label for="rutt">Rut:</label>
          <a class="waves-effect orange btn" v-on:click= "ingresar()">Ingresar</a>
        </div>
      </div>
    </div>

</template>

<style>
    .container{
      height: 150px;
    }
    .input-field{
      top: 17px;
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
              this.rut = "chupa la corneta";
            }
        }
    }
</script>


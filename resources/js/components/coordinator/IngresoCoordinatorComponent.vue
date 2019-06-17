<template>
    <div>
       <a class="waves-effect orange btn"  v-on:click= "ingresar()">Ingresa!</a>
    </div>
    

</template>
<!--
<style scoped>
    .container{
      height: 150px;
    }
    .input-field{
      top: 30px;
    }
</style>
-->
<script>
  
    export default {
        data(){
            return {
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods:{
            ingresar(){
                //se emite el evento de que se esta ingresando.
                const params = null;
                this.$emit('botonIngresar', params);
            }
        }
    }
</script>
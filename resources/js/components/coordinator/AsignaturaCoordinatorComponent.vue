<template>
    
    

</template>


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
<template>
    <div>
        <a class="waves-effect orange btn  z-depth-4 " v-on:click= "seleccion()">{{asignatura.name}}</a>
    </div>
</template>

<style scoped>
    .btn{
        font-size:13px;
        width: 220px;
        height: 35px;
    }
    div{
      height: 13vh;
    }
</style>
</style>


<script>
    export default {
        props: ['asignatura'],
        data(){
            return {
                nombre:''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            seleccion(){
              const params = {
                rut: this.nombre
              };
              //aqui debemos hacer el axios que envie el rut, debo reibir al estudiante
              this.$emit('asignaturaBoton', params);
            }
        }
    }
</script>
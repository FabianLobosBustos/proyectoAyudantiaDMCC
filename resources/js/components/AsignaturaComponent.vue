<template>
    <div>
        <a class="waves-effect orange btn z-depth-4 " v-on:click= "ingresar()">{{asignatura.name}}</a>
    </div>
</template>

<style>
    .btn{
        font-size:13px;
        width: 220px;
        height: 35px;
    }
    
</style>

<script>
    export default {
        props: ['asignatura'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
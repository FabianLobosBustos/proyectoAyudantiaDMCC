<template>
    <div class="container row">
        <div class="boton col s12">
            <a class="waves-effect orange btn "  v-on:click= "modificar()">Modificar Requisitos</a>
        </div>
    
        <div class="boton col s4">
            <a class="waves-effect orange btn"  v-on:click= "exportarExcel()">Exportar Excel</a>
        </div>

        <div class="boton col s2">
            <label>Periodo: </label>
        </div>

        <div class="col s6">
            <select @change="onChange()"  class="browser-default validate espacio"  required type="text" v-model="periodoExcel">
                <option disabled selected >Seleccione el periodo:</option>
                <option v-for = "(periodo,index) in periodos"
                        :key="index">
                        {{periodo.semester}}{{periodo.year}}
                </option>
            </select>
        </div>



        <div class="boton col s4">
            <a class="waves-effect orange btn s6"  v-on:click= "exportarPdf()">Exportar PDF</a>
        </div>

        <div class="boton col s2">
            <label>Periodo: </label>
        </div>

        <div class="col s6">
            <select @change="onChange()"  class="browser-default validate espacio"  required type="text" v-model="periodoPdf">
                <option disabled selected >Seleccione el periodo:</option>
                <option v-for = "(periodo,index) in periodos"
                        :key="index">
                        {{periodo.semester}}{{periodo.year}}
                </option>
            </select>
        </div>
    </div>
</template>
<style scoped>
    .boton{
      height: 60px;
    }
    .btn{
        width: 200px;
    }
    .espacio{
        width: 150px;
    }
</style>

<script>
  
    export default {
         props: ['periodos'],
        data(){
            return {
                periodoExcel: null,
                periodoPdf: null
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods:{
            modificar(){
                //se emite el evento de que se esta ingresando.
                const params = null;
               // this.$emit('botonIngresar', params);
            },
            exportarExcel(){
                //se emite el evento de que se esta ingresando.
                const params1 = null;
                //this.$emit('botonIngresar', params);
            },
            exportarPdf(){
                //se emite el evento de que se esta ingresando.
                const params2 = null;
                //this.$emit('botonIngresar', params);
            }
        }
    }
</script>
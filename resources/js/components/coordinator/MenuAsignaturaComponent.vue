<template>
    <div class="container row">
        <div class="col s12">
            <div class="boton col s12">
                <a class="waves-effect orange btn "  v-on:click= "modificar()">Modificar Requisitos</a>
            </div>
        </div>
        <div class="col s12">
            <div class="boton col s4">
                <a class="waves-effect orange btn" v-bind:disabled="periodoExcelSeleccionado == 0"  v-on:click= "exportarExcel()">Exportar Excel</a>
            </div>

            <div class="boton col s2">
                <label>Periodo: </label>
            </div>
        
            <div class="col s6">
                <select @change="onChange()"  class="browser-default validate espacio"  required type="text" v-model="periodoExcel">
                    <option disabled selected >Seleccione el periodo:</option>
                    <option v-for = "(periodo,index) in periods"
                            :key="index">
                            {{periodo.semester}}-{{periodo.year}}
                    </option>
                </select>
            </div>
        </div>
        <div class="col s12">
            <div class="boton col s4">
                <a class="waves-effect orange btn s6" v-bind:disabled="periodoPdfSeleccionado == 0" v-on:click= "exportarPdf()">Exportar PDF</a>
            </div>

            <div class="boton col s2">
                <label>Periodo: </label>
            </div>

            <div class="col s6">
                <select @change="onChange()"  class="browser-default validate espacio"  required type="text" v-model="periodoPdf">
                    <option disabled selected >Seleccione el periodo:</option>
                    <option v-for = "(periodo,index) in periods"
                            :key="index">
                            {{periodo.semester}}-{{periodo.year}}
                    </option>
                </select>
            </div>
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
         props: ['periods','asignaturaActual'],
        data(){
            return {
                periodoExcel: null,
                periodoPdf: null,
                periodoExcelSeleccionado: 0,
                periodoPdfSeleccionado: 0
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
                axios.get("subjectsdownloadPostulationExportPDF/"+this.asignaturaActual.id).then((response)=>{
                console.log("finish");
             });
            },
            onChange(){
                if(this.periodoExcel != null){
                    this.periodoExcelSeleccionado = 1;
                }
                if(this.periodoPdf != null){
                    this.periodoPdfSeleccionado = 1;
                    console.log(this.periodoPdfSeleccionado);
                }
                
            }
            
        }
    }
</script>
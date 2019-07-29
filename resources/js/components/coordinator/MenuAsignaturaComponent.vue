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
                <select @change="onChange()"  class="browser-default validate espacio"  required type="text" v-model="periodoActualExcel">
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
                <select @change="onChange()"  class="browser-default validate espacio"  required type="text" v-model="periodoActualPDF">
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
                periodoPdfSeleccionado: 0,
                periodoActualPDF: null,
                periodoActualExcel: null
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
                var i;
                var index = -1;
                for(i=0;i<this.periods.length;i++){
                        var str1 = this.periods[i].semester+"-"+this.periods[i].year;
                        console.log(str1);
                        console.log("===");
                        console.log(this.periodoActualExcel+"");
                        if((this.periods[i].semester+"-"+this.periods[i].year) === this.periodoActualExcel+""){
                            index = i;
                        }
                }
                const urlPDF = "downloadPostulationExportEXCEL/"+this.asignaturaActual.id+"/period/"+this.periods[index].id;
                axios({
                    url: urlPDF,
                    method: 'GET',
                    responseType: 'blob', // important
                    }).then((response) => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', "postulaciones_"+this.asignaturaActual.name+"_"+this.periodoActualExcel+".xls");
                    document.body.appendChild(link);
                    link.click();
                    });
            },
            exportarPdf(){
                var i;
                var index = -1;
                for(i=0;i<this.periods.length;i++){
                        var str1 = this.periods[i].semester+"-"+this.periods[i].year;
                        console.log(str1);
                        console.log("===");
                        console.log(this.periodoActualPDF+"");
                        if((this.periods[i].semester+"-"+this.periods[i].year) === this.periodoActualPDF+""){
                            index = i;
                        }
                }
                const urlPDF = "downloadPostulationExportPDF/"+this.asignaturaActual.id+"/period/"+this.periods[index].id;
                axios({
                    url: urlPDF,
                    method: 'GET',
                    responseType: 'blob', // important
                    }).then((response) => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', "postulaciones_"+this.asignaturaActual.name+"_"+this.periodoActualPDF+".pdf");
                    document.body.appendChild(link);
                    link.click();
                    });
            },
            onChange(){
                console.log("estoy en el onchangue");
                console.log(this.periodoPdfSeleccionado);
                if(this.periodoActualExcel != null){
                    
                    this.periodoExcelSeleccionado = 1;
                }
                if(this.periodoActualPDF != null){
                    this.periodoPdfSeleccionado = 1;
                    console.log(this.periodoPdfSeleccionado);
                }
                
                                console.log(this.periodoPdfSeleccionado);

            }
            
        }
    }
</script>
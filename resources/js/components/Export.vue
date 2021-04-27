<template>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-chevron-right fa5x"></i> Exportación de listados
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center">Archivo</th>
                    <th class="text-center">Tipo del archivo</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center" v-for="list in array_list" :Key="list.id">
                   <td  v-text="list.name"></td>
                    <td>
                      <a href="#" class="btn  btn-danger btn-sm p-1" title="generar PDF" @click="export_pdf(list.option,'pdf')">
                        <i class="fas fa-file-pdf"></i> Generar PDF
                      </a>
                      <a href="#" class="btn  btn-success btn-sm p-1" title="generar EXCEL" @click="export_pdf(list.option,'excel')" >
                        <i class="fas fa-file-excel"></i> Generar EXCEL
                      </a>
                    </td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</template>


<script>
  import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';
  import {es}  from 'vue2-datepicker/locale/es';
  import VueCurrencyFilter from 'vue-currency-filter'
  Vue.use(VueCurrencyFilter, {
    symbol: '$', // El símbolo, por ejemplo €
    thousandsSeparator: ',', // Separador de miles
    fractionCount: 2, // ¿Cuántos decimales mostrar?
    fractionSeparator: '.', // Separador de decimales
    symbolPosition: 'front', // Posición del símbolo. Puede ser al inicio ('front') o al final ('') es decir, si queremos que sea al final, en lugar de front ponemos una cadena vacía ''
    symbolSpacing: true // Indica si debe poner un espacio entre el símbolo y la cantidad
  })
//    import moment from 'moment';
  export default {
      
    data() {
        return {
           
            array_list : {
                '0' : {name : 'listado de clientes',
                       option : 0
                       },
                '1' : {name : 'listado de colaboradores',
                       option : 1
                       },
                '2' : {name : 'listado de productos',
                       option : 1
                       }
            },
            option : 0,
            url : '',
            document : '',
          }
    },
    computed:{

    },


    methods : {
      // here create pdf with a url
        export_pdf(option,type_document){
          this.document = type_document;
          switch (option) {
            case 0 : {
                if (this.document == 'pdf') {
                  this.url = 'pdfCustomers';
                }else{
                  this.url =  'excelCustomers';
                }

                break;
            };
            case 1 : {
                if (this.document == 'pdf') {
                  this.url = 'pdfCustomers';
                }else{
                  this.url =  'excelCustomers';
                }
                break;
            };
            default:
              break;
          }
          let me=this;
          window.open(me.url,'_blank');
        },

        detalleBills(id_bill){
          let me=this;
          var url = 'bill/billDetail?id_bill='+id_bill;
          axios.get(url).then(function (response) {
              me.billDetail = response.data.billDetail[0];
              me.daysDetail = response.data.days;
              me.salesDetail = response.data.sales;
              me.additionalsDetail = response.data.additionals;
              //  console.log( me.billDetail);
              //  console.log( me.daysDetail);
              //  console.log( me.salesDetail);
              //  console.log( me.additionalsDetail);

          })
            .catch(function (error) {
              console.log(error);
            });
        },

    },

    mounted() {

        // this.listBills(1,this.search,this.valor);

    }
  }
</script>

<style>
 
</style>
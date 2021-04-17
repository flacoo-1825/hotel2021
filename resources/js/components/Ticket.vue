<template>
  <div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <i class="fas fa-chevron-right fa5x"></i> Ventas habitación
        </div>
        <template v-if="facture == 0">
          <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="input-group">
                        <select class="form-control col-md-3" v-model="valor">
                          <option value="number_bill">Factura</option>
                        </select>
                        <input type="text" v-model="search" @keyup="listBills(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Factura</th>
                        <th>total</th>
                        <th>Detalles factura</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center" v-for="bill in arrayBill" :Key="bill.id">
                        <td  v-text="bill.number_bill"></td>
                        <td>{{bill.total_bill | currency}}</td>
                        <td>
                          <a href="#" class="btn  btn-warning btn-sm p-1" title="Ver" @click="openModal('bill','ver',bill)" >
                            <i class="far fa-eye"></i> Ver Detalle
                          </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                  <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,search,valor)">Anterior</a>
                  </li>
                  <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,search,valor)" v-text="page"></a>
                  </li>
                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,search,valor)">Siguiente</a>
                  </li>
                </ul>
            </nav>
          </div>
        </template>
        <template v-if="facture == 1">
          <h1>here Data</h1>
        </template>
        
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
            lang: {
                formatLocale: {
                    firstDayOfWeek: 7,
                    },
                    monthBeforeYear: false,
            },
            facture  : 0,
            name_bill : '',
            total_bills : '',
            desactivar : 0,
            arrayBill: [],
            arrayLinksActive : [],
            bill : '',
            number_bill : '',
            modal : 0,
            titleModal : '',
            arrayDetalleBills : [],
            arrayDetalleSales : [],
            accion : 0,
            bill_id : 0,
            search:'',
            valor : 'number_bill',
            arrayError : [],
            error : [],
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
          }
    },
    computed:{
        //muestra la pagina activa
        isActived: function(){
            return this.pagination.current_page;
        },
        //Calcula las paginas
        pagesNumber: function() {
            if(!this.pagination.to) {
                return [];
            }
            
            var from = this.pagination.current_page - this.offset; 
            if(from < 1) {
                from = 1;
            }

            var to = from + (this.offset * 2); 
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }  

            var pagesArray = [];
            while(from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;             

        }
    },


    methods : {

        listBills(page,search,valor){
          let me=this;
          var url = 'bill?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
              var respuesta= response.data;
              me.arrayBill = respuesta.bills.data;
              me.pagination= respuesta.pagination;
            // console.log(response);

          })
            .catch(function (error) {
              console.log(error);
            });
        },

        detalleBills(number_bill){
          let me=this;
          var url = 'bill/listbills?number_bill='+number_bill;
          axios.get(url).then(function (response) {
                var respuesta = response.data;
                 me.arrayDetalleBills= respuesta.bills;
                 me.arrayDetalleSales= respuesta.sales;
              // me.arrayDetalle = respuesta.bills.data;
              //console.log(me.arrayDetalleBills);

          })
            .catch(function (error) {
              console.log(error);
            });
        },

        cambiarPagina(page,search,valor){
          let me = this;
          //Actualiza la página actual
          me.pagination.current_page = page;
          //Envia la petición para visualizar la data de esa página
          me.listBills(page,search,valor);
        },

        openModal(accion, data = [] ){

          switch(accion){

              case  "bill_detail" : {
                this.facture = 1;
              }
          }

      },

        closeModal(){
          this.modal = 0;
          this.arrayError = [];
          this.listBills(1,this.search,this.valor);
        },

    },

    mounted() {

        this.listBills(1,this.search,this.valor);

    }
  }
</script>

<style>
     
    .modal-content{
    width:100% ! important;
    position:  absolute ! important; 
    }
    .mostrar{
    display:  list-item ! important;  
    opacity:  1 ! important;
    position:  absolute ! important;
    background-color: #3c29297a !important;
    }

    .certificate label {
       font-size: 30px;
       padding-right: 10px;
    }
    .certificate h2{
       color: rgb(235, 23, 23);
       font-size: 40px;
    }

    .form_certificate{
      overflow: auto;
    }



</style>
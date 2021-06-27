<template>
  <div class="container-fluid">
    <div class="card">
        <template v-if="facture == 0">
          <div class="card-header">
            <i class="fas fa-chevron-right fa5x"></i> Ventas habitación
          </div>
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
                          <a href="#" class="btn  btn-warning btn-sm p-1" title="Ver" @click="openModal('bill_detail',bill)" >
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
          <div class="card-header">
              <i class="fas fa-chevron-right fa5x"></i> Factura de habitación
              <button type="button" class="btn btn-danger"  @click="closedModal('bill_detail')">
                  <i class="far fa-times-circle"></i>&nbsp;Cerrar
              </button>
          </div>
            <div class="card-body">
              <div class="container-fluid mb-5">
                <div class="row">
                  <div class="col-md-8 mb-2">
                  </div>
                  <div class="col-md-4 mb-2 certificate  input-group">
                      <label for="text-input ">Factura</label>
                      <h2 v-text="billDetail.number_bill"></h2>
                  </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-12 col-md-12 mb-2 text-center certificate">
                        <h3>Información del huéped</h3>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-4 mb-2 input-group">
                      <label for="text-input ">Cliente :
                        <span v-text="billDetail.name_client">
                          </span>
                          <span v-text="billDetail.firstSurname_client">&nbsp
                          </span>
                          <span v-text="billDetail.secondSurname_client">&nbsp
                          </span>
                      </label>
                  </div>
                  <div class="col-sm-12 col-md-4 mb-2 input-group">
                      <label for="text-input ">Celular : <span v-text="billDetail.phone_client"></span></label>
                  </div>
                  <div class="col-sm-12 col-md-4 mb-2 input-group">
                      <label for="text-input ">Número de documento : <span v-text="billDetail.cedula_client"></span></label>
                  </div>
                   <div class="col-sm-12 col-md-4 mb-2 input-group">
                      <label for="text-input ">Nacionalidad : <span v-text="billDetail.nationality_client"></span></label>
                  </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-2 text-center certificate">
                        <h3>Detalle habitación</h3>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-2 input-group">
                      <label for="text-input ">Habitación : <span v-text="billDetail.number"></span></label>
                  </div>
                  <div class="col-md-4 mb-2 input-group">
                      <label for="text-input ">Tipo habitación : <span v-text="billDetail.name_type_room"></span></label>
                  </div>
                  <div class="col-md-4 mb-2 input-group">
                      <label for="text-input ">Precio : <span >{{billDetail.price | currency}}</span></label>
                  </div>
                </div>
                <hr>
                <div class="row mb-4 mt-3">
                    <div class="col-md-12 mb-2 text-center certificate">
                        <h3>Días de estadía</h3>
                    </div>
                </div>
                <div class="row">
                  <table class="table table-bordered table-striped table-sm">
                    <thead >
                        <tr>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Tipo de ventilación</th>
                            <th class="text-center">precio día/hora</th>
                            <th class="text-center">total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" v-for="day in daysDetail" :Key="day.id">
                          <td v-text="day.date_day"></td>
                          <td  v-text="day.type_frozen_day"></td>
                          <td>{{day.price_day + day.price_hour | currency}}</td>
                          <td>{{day.total_day | currency}}</td>
                        </tr>
                    </tbody>
                  </table>
                  <table class="table table-hover  table-sm text-center" >
                      <thead >
                        <tr class="d-flex justify-content-end">
                          <th>Total días</th>
                          <th class="bg-warning">{{billDetail.total_days | currency}}</th>
                        </tr>
                      </thead>
                    </table>
                </div>
                <hr>
                <div class="row mb-4 mt-3">
                    <div class="col-md-12 mb-2 text-center certificate">
                        <h3>Productos consumidos</h3>
                    </div>
                </div>
                <div class="row">
                  <table class="table table-bordered table-striped table-sm">
                    <thead >
                        <tr>
                            <th class="text-center">Producto</th>
                            <th class="text-center">cantidad</th>
                            <th class="text-center">total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" v-for="product in salesDetail" :Key="product.id">
                          <td v-text="product.name_product"> </td>
                          <td  v-text="product.quantity_sales"></td>
                          <td>{{product.total_sales | currency}}</td>
                        </tr>
                    </tbody>
                  </table>
                  <table class="table table-hover  table-sm text-center" >
                    <thead >
                      <tr class="d-flex justify-content-end">
                        <th>Total productos</th>
                        <th class="bg-warning">{{billDetail.total_products | currency}}</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <hr>
                <div class="row mb-4 mt-3">
                    <div class="col-md-12 mb-2 text-center certificate">
                        <h4>Servicios adicionales</h4>
                    </div>
                </div>
                <div class="row">
                  <table class="table table-bordered table-striped table-sm">
                    <thead >
                        <tr>
                            <th class="text-center">Producto</th>
                            <th class="text-center">total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" v-for="additional in additionalsDetail"  :Key="additional.id">
                          <td v-text="additional.name_additional"></td>
                          <td>{{additional.price_additional | currency}}</td>
                        </tr>
                    </tbody>
                  </table>
                  <table class="table table-hover  table-sm text-center" >
                    <thead >
                      <tr class="d-flex justify-content-end">
                        <th>Total adicionales </th>
                        <th class="bg-warning">{{billDetail.total_additionals | currency}}</th>
                      </tr>
                    </thead>
                  </table>
                  <table class="table table-hover  table-sm text-center" >
                    <thead >
                      <tr class="d-flex justify-content-end">
                        <th>Total fatura</th>
                        <th class="bg-success">{{billDetail.total_bill | currency}}</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
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
            billDetail : [],
            daysDetail : [],
            additionalsDetail : [],
            salesDetail : [],
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
                this.id_bill = data['id'];
                this.detalleBills(this.id_bill);
              }
          }

      },

        closedModal(accion){
          switch(accion){

              case  "bill_detail" : {
                this.facture = 0;
              }
          }
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
<template>
    <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Ventas Recepción
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="valor">
                                      <option value="number_checkbooks">Factura</option>
                                    </select>
                                    <input type="text" v-model="search" @keyup="listCheckbooks(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
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
                                <tr class="text-center" v-for="checkbook in arrayCheckbook" :Key="checkbook.id">
                                   <td  v-text="checkbook.number_checkbooks"></td>
                                   <td>{{checkbook.total_checkbooks | currency}}</td>
                                   <td>
                                      <a href="#" class="btn  btn-outline-info btn-sm p-1" title="Ver" @click="openModal('checkbook','ver',checkbook)" >
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
                </div>
                <!-- Fin ejemplo de tabla Listado -->
                 <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" >
                  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content container bg-container-modal">
                      <div class="text-center">
                        <h3 class="modal-title degraded-orange" v-text="titleModal"></h3>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6 mb-2 certificate  input-group">
                            </div>
                            <div class="col-md-6 mb-2 certificate  input-group">
                                <label for="text-input ">Factura</label>
                                <h2 v-text="number_checkbooks"></h2>
                            </div>
                          </div>
                        <div class="row">
                          <div class="col">
                            <table class="table table-hover  table-sm text-center" >
                              <thead >
                                <tr>
                                  <th>Producto</th>
                                  <th>Precio C/u</th>
                                  <th>cantidad</th>
                                  <th>total</th>
                                </tr>
                              </thead>
                                <tbody class="bg-white text-center table-bordered">
                                  <tr v-for="product in arrayDetalle " :key="product.id">
                                    <td v-text="product.name_product"></td>
                                    <td  >Precio : {{product.price_unit_sales | currency}} </td>
                                    <td>{{product.quantity_sales | currency}}</td>
                                    <td v-text="product.total_sales"></td>
                                  </tr>
                                </tbody>  
                            </table>
                            <table class="table table-hover  table-sm text-center" >
                                <thead >
                                  <tr class="d-flex justify-content-end">
                                    <th>total</th>
                                    <th>{{total_checkbooks | currency}}</th>
                                  </tr>
                                </thead>
                              </table>
                          </div>
                        </div>
                      </div>
                      <div class="row modal-footer">
                          <div class="col-lg-2">
                            <a class="btn btn-danger  text-white" @click="closeModal()">
                              <i class="fas fa-times-circle"></i> Cerrar
                            </a>
                          </div>   
                      </div>
                      <!-- /.modal-content -->
                    </div>
                  <!-- /.modal-dialog -->
                  </div>
        </div>

    </div>
            <!--closed here Data-->

           
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
            name_checkbook : '',
            total_checkbooks : '',
            desactivar : 0,
            arrayCheckbook: [],
            arrayLinksActive : [],
            checkbook : '',
            number_checkbooks : '',
            modal : 0,
            titleModal : '',
            arrayDetalle : [],
            accion : 0,
            checkbook_id : 0,
            search:'',
            valor : 'number_checkbooks',
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

        listCheckbooks(page,search,valor){
          let me=this;
          var url = 'checkbook?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
              var respuesta= response.data;
              me.arrayCheckbook = respuesta.checkbooks.data;
              me.pagination= respuesta.pagination;
            // console.log(response);

          })
            .catch(function (error) {
              console.log(error);
            });
        },

        detalleCheckbooks(number_checkbooks){
          let me=this;
          var url = 'checkbook/listcheckbooks?number_checkbooks='+number_checkbooks;
          axios.get(url).then(function (response) {
                 me.arrayDetalle= response.data;
              // me.arrayDetalle = respuesta.checkbooks.data;
              // console.log(response);

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
          me.listCheckbooks(page,search,valor);
        },

        openModal(model, accion, data = [] ){

          switch(model){
              case  "checkbook" : {

                  switch(accion){

                      case "ver" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 1;
                            this.titleModal = 'Detalle de la factura';
                            this.accion = 3;
                            this.checkbook_id = '';
                            this.number_checkbooks =  data['number_checkbooks'];
                            this.total_checkbooks =  data['total_checkbooks'];
                            this.detalleCheckbooks(this.number_checkbooks);
                          break;

                      }
                  }
              }
          }

      },

        closeModal(){
          this.modal = 0;
          this.arrayError = [];
          this.listCheckbooks(1,this.search,this.valor);
        },

    },

    mounted() {

        this.listCheckbooks(1,this.search,this.valor);

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
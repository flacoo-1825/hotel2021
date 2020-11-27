<template>
    <div class="container-fluid">
        <template v-if="factura==0">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Compras
                        <button type="button" class="btn btn-success shadow"  @click="openModal('product','buy')">
                            <i class="fas fa-cash-register"></i> Ingresar Compra
                        </button>
                    </div>
                    <div class="card-body">
                      <div class="form-group row">
                          <div class="col-md-6">
                              <div class="input-group">
                                  <select class="form-control col-md-3" v-model="valor">
                                    <option value="number_bill">Factura</option>
                                  </select>
                                  <input type="text" v-model="search" @keyup="listBillBuy(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
                                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                              </div>
                          </div>
                      </div>
                      <table class="table table-bordered table-striped table-sm">
                          <thead>
                              <tr>
                                  <th>Factura</th>
                                  <th>total</th>
                                  <th>Detalles factura Compra</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr class="text-center"  v-for="bill in arrayBill" :Key="bill.id" :class="[bill.state_bill == isActived ? '' : 'table-info']">
                                  <td  v-text="bill.number_bill"></td>
                                  <td>{{bill.total_bill | currency}}</td>
                                  <td>
                                    <a href="#" class="btn  btn-success btn-sm p-1" title="Ver" @click="openModal('product','ver',bill)" >
                                      <i class="far fa-eye"></i> Ver Detalle
                                    </a>
                                    <template v-if="bill.state_bill">
                                      <span class="btn btn-warning">
                                        <i class="fas fa-check"></i>
                                      </span>
                                    </template>
                                    <template v-else>
                                      <span class="btn btn-danger" @click="active(bill.id)">
                                        <i class="fas fa-minus-circle"></i>
                                      </span>
                                    </template>
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
        </template>
        <template v-if="factura==1">
          <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Ingreso de Factura de compra
                        <span>
                            <button type="button" class="btn btn-danger"  @click="factura=0;search='';closeModal('product');arrayProducts=[]">
                              <i class="fas fa-times-circle"></i> Cerrar
                            </button>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid mb-5">
                          <div class="row text-center mb-5">
                            <div class="col-sm-12">
                                <h1>Factura</h1>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-6 mb-2">
                              <label class=" form-control-label" for="text-input">Proveedor</label>
                              <select class="form-control custom-select" v-model='provider_id' v-bind:disabled="desactivar==1">
                                  <option value="0" >Seleccione una opción</option>
                                  <option v-for="provider in arrayProvidersActive" :Key="provider.id" :value="provider.id" v-text="provider.name_provider"></option>
                              </select>
                            </div>
                            <div class="col-sm-6 mb-2">
                              <label class=" form-control-label" for="text-input">Forma de Pago</label>
                              <select class="form-control custom-select" v-model='class_pay' v-bind:disabled="desactivar==1">
                                  <option value="0" >Seleccione una opción</option>
                                  <option value="Contado">Contado</option>
                                  <option value="Credito">Crédito</option>
                              </select>
                            </div>
                            <div class="col-lg-6 mb-2 mt-3 category">
                                <label for="text-input ">Tipo de Factura : </label>
                                <input v-model="number_bill_buy">
                            </div>
                            <template v-if="class_pay=='Credito'">
                              <div class="col-lg-6 mb-2 mt-3 category">
                                  <label for="text-input ">Fecha de pago : </label>
                                  <date-picker v-model="date_pay"  :language="es" :lang="lang" valueType="format"></date-picker>
                              </div>
                            </template>
                          </div>
                          <div class="row mb-4 mt-5">
                              <div class="col-md-12 mb-2 text-center certificate">
                                  <h3>Productos facturados</h3>
                              </div>
                              <div class="col-md-12 mb-2 text-right certificate">
                                  <button type="button" class="btn btn-success"  @click="openModal('product','products')">
                                    <i class="fas fa-plus-circle"></i> Productos a ser facturados
                                  </button>
                              </div>
                          </div>
                          <div class="row">
                            <table class="table table-bordered table-striped table-sm">
                              <thead>
                                  <tr>
                                      <th>Producto</th>
                                      <th>valor C/u</th>
                                      <th>Cantidad</th>
                                      <th>subTotal
                                      </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr class="text-center" v-for="product in listProduct" :Key="product.id">
                                    <td class="imgProduct">
                                      <img :src="ruta+product.url_img" alt="not fount">
                                    </td>
                                    <td>{{product.sale_product | currency}}</td>
                                    <td  v-text="product.cantidad_product"></td>
                                    <td class="d-flex justify-content-between">
                                        <span>{{product.sale_product*product.cantidad_product | currency}}</span>
                                        <a href="#" class="btn btn-danger btn-sm" title="Inactivo"  @click="deleteProduct(product)"><i class="fas fa-trash-alt">
                                          </i> Eliminar
                                        </a>
                                    </td>
                                  </tr>
                              </tbody>
                            </table>
                            <table class="table table-hover  table-sm text-center" >
                                <thead >
                                  <tr class="d-flex justify-content-end">
                                    <th>total</th>
                                    <th>
                                      <input type="number" v-model="total_facture">
                                    </th>
                                  </tr>
                                </thead>
                            </table>
                          </div>
                          <div class="row">
                            <div class="col-sm-12 mb-2 mt-3">
                              <div class="form-group">
                                <label for="exampleFormControlTextarea1">Observaciones</label>
                                <textarea class="form-control" v-model="description_bill" id="exampleFormControlTextarea1" rows="4"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row mt-4">
                            <div class="col">
                              <a href="#" class="btn btn-success btn-block shadow" @click="registerBill(listProduct)">
                                <i class="fas fa-share-square"></i> Ingresar compra
                              </a>
                            </div>
                          </div>
                        </div>
                    </div>
          </div>
        </template>
        <template v-if="factura==2">
          <div class="card">
            <div class="card-header">
                <i class="fas fa-chevron-right fa5x"></i> Factura de Compra
                <span>
                    <button type="button" class="btn btn-danger"  @click="factura=0;closeModal('modal')">
                      <i class="fas fa-times-circle"></i> Cerrar
                    </button>
                </span>
            </div>
              <div class="card-body">
                <div class="container-fluid mb-5">
                  <div class="row text-center mb-5">
                    <div class="col-sm-4">
                        <h1>Factura : </h1>
                    </div>
                    <div class="col-sm-8 mb-2 certificate  input-group">
                      <h2 v-text="number_bill"></h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 mb-2 mt-3">
                      <label>Proveedor : <span v-text="name_provider"></span></label>
                    </div>
                    <div class="col-sm-6 mb-2 mt-3">
                      <label>Empresa : <span v-text="name_company"></span></label>
                    </div>
                    <div class="col-sm-3 mb-2 mt-3">
                      <label>Nit : <span v-text="nit_provider"></span></label>
                    </div>
                    <div class="col-sm-3 mb-2 mt-3">
                      <label class=" form-control-label" for="text-input">Forma de Pago : <span v-text="class_pay"></span></label>
                    </div>
                    <template v-if="class_pay=='Crédito'">
                      <div class="col-sm-6 mb-2 mt-3">
                          <label >Fecha de pago : <span v-text="date_pay"></span></label>
                      </div>
                    </template>
                    <div class="col-lg-3 mb-2 mt-3">
                        <label for="text-input ">Tipo de Factura : 
                          <span v-text="number_bill_buy"></span>
                        </label>
                    </div>
                    <div class="col-sm-3 mb-2 mt-3">
                      <label class=" form-control-label" for="text-input">E-mail : <span v-text="email_provider"></span></label>
                    </div>
                    <div class="col-sm-3 mb-2 mt-3">
                      <label class=" form-control-label" for="text-input">Teléfono : <span v-text="phone_provider"></span></label>
                    </div>
                  </div>
                  <hr>
                  <div class="row mb-4 mt-5">
                      <div class="col-md-12 mb-2 text-center certificate">
                          <h3>Productos facturados</h3>
                      </div>
                  </div>
                  <div class="row">
                    <table class="table table-bordered table-striped table-sm">
                      <thead>
                          <tr>
                              <th>Producto</th>
                              <th>valor C/u</th>
                              <th>Cantidad</th>
                              <th>subTotal
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr class="text-center" v-for="product in arrayDetailsBuy" :Key="product.id">
                            <td class="imgProduct">
                              <img :src="ruta+product.img_product" alt="not fount">
                            </td>
                            <td>{{product.sale_product | currency}}</td>
                            <td  v-text="product.quantity_buy"></td>
                            <td class="d-flex justify-content-between">
                                <span>{{product.total_buy | currency}}</span>
                            </td>
                          </tr>
                      </tbody>
                    </table>
                    <table class="table table-hover  table-sm text-center" >
                        <thead >
                          <tr class="d-flex justify-content-end">
                            <th>total</th>
                            <th>
                              <span>{{total_bill | currency}}</span>
                            </th>
                          </tr>
                        </thead>
                    </table>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 mb-2 mt-3">
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Observaciones</label>
                        <textarea Disabled class="form-control"  id="exampleFormControlTextarea1" rows="4" v-model="description_bill"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </template>
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : add2}" >
                  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content container bg-container-modal">
                      <div class="text-center">
                        <h3 class="modal-title degraded-orange" v-text="titleModal"></h3>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <template v-if="newSale==1">
                              <div class="input-group">
                                <input type="text" v-model="search" @keyup="listProductProvider(1,search,valor)"  class="form-control" placeholder="Producto a buscar">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                              </div>
                            </template>
                          </div>
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
                                <tr v-for="product in arrayProducts " :key="product.id">
                                  <td v-text="product.name_product"></td>
                                  <td>Precio :  
                                    <input type="number" v-model="sale_product">
                                  </td>
                                  <td>
                                    <input type="number" v-model="cantidad_product">
                                  </td>
                                  <td>{{sale_product*cantidad_product | currency}}</td>
                                  <td>
                                    <a href="#" class="btn btn-success "  title="Agregar" @click="addProduct(product)" >
                                      <i class="fas fa-trash-alt"></i> Agregar
                                    </a>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="row modal-footer">
                          <div class="col-lg-2">
                            <a class="btn btn-danger  text-white" @click="closeModal('product')">
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
  export default {

    data() {
        return {
            lang: {
                formatLocale: {
                    firstDayOfWeek: 7,
                    },
                    monthBeforeYear: false,
            },
            arrayProvidersActive : [],
            provider_id : '',
            class_pay : '',
            number_bill_buy : '',
            number_bill : '',
            date_pay : '',
            number_update_buy : '',
            number_buy : '',
            arrayBill : [],
            arrayDetailsBill : [],
            arrayDetailsBuy : [],
            name_provider : '',
            name_company : '',
            nit_provider : '',
            email_provider : '',
            phone_provider : '',
            total_facture : '',
            total_bill : '',
            description_bill : '',
            option : 0,
            listSales : [],
            newSale: 0,
            eliminar : 0,
            number_facture : '',
            number : 0,
            check : [],
            ruta : 'img/products/',
            url_img : '',
            total : '',
            name_product : '',
            sale_product : 0,
            cantidad_product : 1,
            factura : 0,
            number_check : '',
            number_update_reception : '',
            number_reception : '',
            name_room : 'Clase de habitación',
            type_id:0,
            type_room : 0,
            number_update_check : '',
            stateRoom : 'Disponible',
            cc_client: '',
            additional : [],
            client_id : 0,
            temperature_exit_client : 0,
            temperature_entry_client : 0,
            cedula_client : '',
            entry_certificate : new Date(),
            cityOrigin_certificate : '',
            cityDestination_certificate : '',
            children_certificate : '',
            adults_certificate : '',
            observation_certificate : '',
            placaCar_certificate : '',
            placabike_certificate : '',
            name_client : '',
            firstSurname_client : '',
            secondSurname_client : '',
            phone_client : '',
            birth_date_client : new Date(),
            gender_client : 0,
            age_client : '',
            state_client : 0,
            number_certificate : '032CT',
            number_update : 0,
            email_client : '',
            address_client : '',
            city_client : '',
            nationality_client : '',
            number : '',
            price : '',
            frozen : '',
            state : '',
            price_air : '',
            
            firstSurname_acomp : '',
            secondSurname_acomp : '',
            cedula_acomp : '',
            listProduct : [],
            arrayroom : [],
            client : [],
            arrayRoom : [],
            arrayProducts : [],
            dataRoom : [],
            listRoomFree : [],
            arrayAddition : [],
            listAdditional : [],
            rooms : '',
            opcion : 'Elige una opción',
            modal : 0,
            titleModal : '',
            accion : 0,
            rooms_id : 0,
            add : 0,
            add2 : 0,
            add3 : 0,
            desactivar : 0,
            condition : 1,
            search:'',
            valor : 'number_bill',
            arrayError : [],
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
            es : es,
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

        listBillBuy(page,search,valor){
          let me=this;
          var valor = 'number_bill'
          var url = 'bill/indexBuy?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.arrayBill = respuesta.bills.data;
               me.pagination= respuesta.pagination;
              // console.log(me.arrayBill);

          })
            .catch(function (error) {
              console.log(error);
              });
        },
        detailsBuy(number_bill_buy){
          let me=this;
          var valor = 'number_bill'
          var url = 'bill/detailsBillsBuy?number_bill_buy=' + number_bill_buy;
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.arrayDetailsBill = respuesta.bills;
               me.arrayDetailsBuy = respuesta.buys;
               //console.log(me.arrayDetailsBill);
              // console.log(me.arrayDetailsBuy);
               me.date_pay = me.arrayDetailsBuy[0]['date_pay'];
               me.class_pay = me.arrayDetailsBuy[0]['class_pay'];
               me.name_company =  me.arrayDetailsBill[0]['company_provider'];
               me.name_provider =  me.arrayDetailsBill[0]['name_provider'];
               me.number_bill =  me.arrayDetailsBill[0]['number_bill'];
               me.number_bill_buy =  me.arrayDetailsBuy[0]['number_bill_buy'];
               me.nit_provider =  me.arrayDetailsBill[0]['nit_provider'];
               me.email_provider =  me.arrayDetailsBill[0]['email_provider'];
               me.phone_provider =  me.arrayDetailsBill[0]['phone_provider'];
               me.total_bill =  me.arrayDetailsBill[0]['total_bill'];
               me.description_bill =  me.arrayDetailsBill[0]['description_bill'];
          })
            .catch(function (error) {
              console.log(error);
              });
        },

        FormAdditional(){
            if (this.price_additional === '' || this.description_additional === '') {
              Swal.fire('Debes Completar los campos')
             
            }else{
                this.additional = {
                'id' : this.id,
                'name_additional' : 'Otro',
                'price_additional' :this.price_additional,
                'description_additional' : this.description_additional,
              },
              // console.log(this.additional);
              this.addAddition = 0;
              this.addAdditional(this.additional);
            }
        },

        listProviderActive(){
          let me=this;
          var url = 'provider/active';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.arrayProvidersActive = respuesta.provider;
            //   me.pagination= respuesta.pagination;
            //  console.log(respuesta);

          })
            .catch(function (error) {
              console.log(error);
            });
        },

        listProductProvider(page,search){
          let me=this;
          var valor = 'name_product';
          var provider_id = this.provider_id;
          var url = 'product/provider?page=' + page + '&search='+ search + "&valor=" + valor + '&provider_id=' + provider_id;
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.arrayProducts = respuesta.products.data;
               me.pagination= respuesta.pagination;
              // console.log(me.arrayProducts);

          })
            .catch(function (error) {
              console.log(error);
              });
        },

        registerBuy(listProduct){
            // console.log(listProduct);
          let me = this;
          var url  = 'buy/register';
          axios.post(url,{

              'provider_id' : this.provider_id,
              'number_bill_buy' : this.number_bill_buy,
              'class_buy' : this.class_pay,
              'listBuy' : this.listProduct,
              'date_pay' : this.date_pay,
              'number_bill' : this.number_buy,

          }).then(function (response) {
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Compra registrada con éxito',
                showConfirmButton: false,
                timer: 1500
              });
            })
            .catch(function (error) {
                  var respuesta = error.response.data;
                  me.arrayError = respuesta.errors;
                  console.log(error.response.data);
            });
        },
        registerBill(listProduct){
            //  var listProduct = this.answer;
            // console.log(listProduct);
            if (this.provider_id === '' || this.class_pay == '' || this.total_facture === ''
            || this.number_bill_buy === '' || this.listProduct == []) {
                Swal.fire('Algunos campos están vacíos!')
            }else{
              let me = this;
              me.registerBuy(this.listProduct);
              var url  = 'bill/register';
              axios.post(url,{
 
                  'customer_id' :    null,
                  'room_id' :    null,
                  'certificate_id' :   null,
                  'taxe_id'    : null,
                  'worker_id'    : null,
                  'buy_id'    : null,
                  'sale_id'  : null,
                  'provider_id' : this.provider_id,
                  'number_bill': this.number_buy,
                  'faker_number_bill'    : "No",
                  'class_bill' : 'Compra',
                  'date_entry_bill'    : null,
                  'date_exit_bill'    : null,
                  'dian_bill'    : 'No',
                  'total_bill'    : this.total_facture,
                  'description_bill'    : this.description_bill,
                  'state_bill'    : 0,     

              }).then(function (response) {
                  me.updateBuy();
                  me.closeModal('buy');
                })
                .catch(function (error) {
                      var respuesta = error.response.data;
                      me.arrayError = respuesta.errors;
                      console.log(error.response.data);
                });
            }
        },      
        search_buy(){
          let me=this;
          var id_search = 1;
          var url = 'counter/searchBuy';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.number_update_buy = respuesta[0].number_buy;
               var end = respuesta[0].end_buy;
               me.number_buy = me.number_update_buy+end;
              //  me.arrayRoom = respuesta.room.data;
              // console.log(me.number_buy);

          })
            .catch(function (error) {
              console.log(error);
              });
        },
        updateBuy(){
          let me=this;
          var url = 'counter/update';
          axios.put(url,{

                      'option' : 6,
                      'number_buy' : this.number_update_buy,

          })
            .catch(function (error) {
                  var respuesta = error.response.data;
                  me.arrayError = respuesta.errors;
                  console.log(error.response.data);
            });

        },
        listAdditionActive(search){
          let me=this;
          var url = 'additional/active?search='+ search;
          axios.get(url).then(function (response) {
              //  var respuesta= response.data;
               me.arrayAddition = response.data;
              //console.log(me.arrayAddition);

          })
            .catch(function (error) {
              console.log(error);
              });
        },

        search_bill(){
          let me=this;
          var url = 'counter/searchTicket';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.number_update_ticket = respuesta[0].number_ticket;
               var end = respuesta[0].end_ticket;
               me.number_ticket = me.number_update_ticket+end;
              //  me.arrayRoom = respuesta.room.data;
              // console.log(me.number_ticket);

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
          me.listRoomsActive(page,search,valor);
      },

        openModal(model, accion, data = [] ){
          switch(model){
              case  "product" : {
                  switch(accion){

                      case "ver" :{
                          // console.log(data);
                          this.factura = 2;
                          this.number_bill_buy = data['number_bill'];
                          this.detailsBuy(this.number_bill_buy);
                          this.listProduct = [];
                         

                          break;
                        };

                      
                      case "edit" :{

                          // console.log(data);
                          this.factura = 1;
                          this.search_bill();
                          this.eleminar = 1;
                          this.add = 0;
                          this.desactivar = 0;
                          this.titleModal = 'Información';
                          this.accion = 2;
                          this.rooms_id = data['id'];
                          this.type_room =  data['type_room_id'];
                          this.number =  data['number'];
                          this.price =  data['price'];
                          this.price_air =  data['price_air'];
                          this.frozen =  data['frozen'];
                          this.state =  data['state'];
                          this.type_id= data['type_room_id'];
                          this.name_client=  data['name_client'];
                          this.cedula_client=  data['cedula_client'];
                          this.phone_client=  data['phone_client'];
                          this.firstSurname_client =  data['firstSurname_client'];
                          this.secondSurname_client =  data['secondSurname_client'];
                          this.number_facture = data['number_facture'];
                          this.name_type_room = data['name_type_room'];
                          this.dataRoom = data;
                          this.search_sales();
                          break;

                      };

                       case "buy" :{
                        // this.add2 = 1;
                        // this.newSale = 1;
                        this.listProviderActive();
                        this.factura = 1;
                        this.titleModal = 'Productos';
                        this.listProduct = [];
                        this.sale_product = 0;

                        break;
                      };

                      case "products" :{
                        this.add2 = 1;
                        this.add3 = 0;
                        this.newSale = 1;
                        this.titleModal = 'Productos';
                        this.arrayProducts = [];
                        this.name_product = '';
                        this.cantidad_product = 1;
                        this.sale_product = 0;
                        this.search = '';
                        this.number_buy = '',
                        this.provider_id = this.provider_id;
                        this.search_buy();

                        break;
                      };
                  }
              }
          }

      },

        closeModal(model){
          switch (model) {
            case "modal":
              this.modal = 0;
              this.search = '';
              this.date_pay = '';
              this.class_pay ='';
              this.name_company =  '';
              this.name_provider = '';
              this.number_bill =  '';
              this.number_bill_buy = '';
              this.nit_provider = '';
              this.email_provider =  '';
              this.description_bill = '';
              this.listBillBuy(1,this.search,this.valor);
              break;
          
            case "buy":
              this.factura = 0;
              this.search = '';
              this.class_pay ='';
              this.provider_id = '';
              this.description_bill = '';
              this.number_buy = '';
              this.nit_provider = '';
              this.listProduct =  [];
              this.total_facture = '';
              number_bill_buy = '';
              this.listBillBuy(1,this.search,this.valor);
              break;

            case "Move":
              this.add2 = 0;
              this.move = 0;
              this.modal = 0;
              break;

            case "product":
              this.add2 = 0;
              break;

            case "additional":
              this.add3 = 0;
              break;
          }
        },

        registerCustomers(page,search,valor){

            let me = this;
            var url  = 'customers/register?page=' + page + '&search='+ search + "&valor=" + valor;
            axios.post(url,{

                        'cedula_client' :    this.cedula_client,
                        'name_client' :    this.name_client,
                        'firstSurname_client' :   this.firstSurname_client,
                        'secondSurname_client'    : this.secondSurname_client,
                        'birth_date_client'    : this.birth_date_client,
                        'gender_client'    : this.gender_client,
                        'age_client'    : this.age_client,
                        'address_client'    : this.address_client,
                        'city_client'    : this.city_client,
                        'nationality_client'    : this.nationality_client,
                        'state_client'    : this.state_client,
                        'phone_client'    : this.phone_client,
                        'email_client'    : this.email_client,
                
                        

            }).then(function (response) {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Tu huésped fue registrado con éxito',
                  showConfirmButton: false,
                  timer: 1500
                });
                  me.closeModal('modal');
                  me.search_client(me.cc_client);
              })
              .catch(function (error) {
                    var respuesta = error.response.data;
                    me.arrayError = respuesta.errors;
                    console.log(error.response.data);
              });

        },
     
        addProduct(product){
              console.log(product);
          this.listProduct.push({
            product_id : product.id, 
            name_product:product.name_product, 
            sale_product:this.sale_product, 
            cantidad_product:this.cantidad_product,
            total:this.sale_product*this.cantidad_product, 
            url_img:product.img_product, 
            number_facture : this.number_facture,
          });

        },

        addAdditional(additional){
              // console.log(additional);
          this.listAdditional.push({
            additional_id : additional.id, 
            name_additional:additional.name_additional, 
            price_additional:additional.price_additional, 
            description_additional:additional.description_additional, 
            total:additional.price_additional,
            number_facture : this.number_facture,
          });

        },
        deleteProduct(product){

           var index =  this.listProduct.indexOf(product);
           this.listProduct.splice(index,1);

        },
        deleteAddition(additional){
            // console.log(additional);
           var index =  this.listAdditional.indexOf(additional);
           this.listAdditional.splice(index,1);

        },

        selectAll(){
            var items=document.getElementsByClassName('prueba');
            for(var i=0; i<items.length; i++){
              if(items[i].type=='checkbox')
                items[i].checked=true;
                this.check=this.listSales;
            }
        },
        

        active(id){

          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
          })

          swalWithBootstrapButtons.fire({
            title: 'Está seguro?',
            text: "Va marcar como revisada ésta factura!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Marcar',
            cancelButtonText: 'No, Cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) { 

                let me = this;
                axios.put('bill/active',{
                    'id': id
                }).then(function (response) {
                    me.listBillBuy(1,'','valor');
                    
                }).catch(function (error) {
                    console.log(error);
                });
              swalWithBootstrapButtons.fire(
                'Revisado!',
                'Tu factura ya cambio su estado a revisada.',
                'success'
              )
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'Tu factura sigue sin revisar! :)',
                'error'
              )
            }
          })
        }


        },
      mounted() {
        this.listBillBuy(1,this.search,this.valor);
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

    
    .disponible{
      border: 1px solid rgb(33, 136, 56);
      /* border: 1px solid #e0e5ec;  */
      border-radius: 5%;
      color:rgb(33, 136, 56) ;
      box-shadow: 8px 8px 16px rgba(165,177,198, 0.8),
	    -8px -8px 16px rgba(255,255,255,0.8);
      -webkit-transition: all .3s ease;
      -moz-transition: all .3s ease;
      -ms-transition: all .3s ease;
      -o-transition: all .3s ease;
      transition: all .3s ease;
    }


    .disponible i{
      font-size: 45px;
      color:rgb(33, 136, 56) ;
    }

    .disponible h3{
      font-size: 24px;
      color:rgb(33, 136, 56) ;
    }

    .disponible:hover{
      background-color: rgba(15, 225, 61, 0.4) ;
      color: #000;
      transform: scaleY(1.05);
    }

    .disponible:hover h3{
      color: #000;
    }

    .disponible:hover i{
      color:#000 ;
    }
    .row_rooms a{
      text-decoration: none;
    }


    .Ocupada{
      border: 1px solid rgba(177, 32, 32, 0.859) ;
      /* border: 1px solid #e0e5ec;  */
      border-radius: 5%;
      color:rgba(177, 32, 32, 0.859) ;
      box-shadow: 8px 8px 16px rgba(165,177,198, 0.8),
	    -8px -8px 16px rgba(255,255,255,0.8);
      -webkit-transition: all .3s ease;
      -moz-transition: all .3s ease;
      -ms-transition: all .3s ease;
      -o-transition: all .3s ease;
      transition: all .3s ease;
    }

    .Ocupada i{
      font-size: 45px;
      color:rgba(177, 32, 32, 0.859);
    }

    .Ocupada h3{
      font-size: 24px;
      color:rgba(177, 32, 32, 0.859);
    }

     .Ocupada:hover{
      background-color:rgba(177, 32, 32, 0.571) ;
      color: #000;
      transform: scaleY(1.1);
    }

    .Ocupada:hover i{
      color:#000 ;
    }

    .Ocupada:hover h3{
      color: #000;
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

    .imgProduct{
    width: 60px;
    height: 60px;
    }

    .product_img .imgProduct{
        width: 100%;
    }

    .img_products{
        width: 100px;
        height: 100px;
    }

    .imgProduct img{
        width: 100%;
    }

    .form-control:disabled{
      background-color: rgb(240, 233, 0, 0.4);
    }

</style>
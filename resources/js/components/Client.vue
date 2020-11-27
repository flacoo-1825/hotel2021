<template>
    <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Cliente
                        <button type="button" class="btn btn-success"  @click="openModal('customers','create')">
                            <i class="fas fa-plus-circle"></i>&nbsp;Nuevo cliente
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="valor">
                                      <option value="name_client">Nombre</option>
                                      <option value="cedula_client">Cédula</option>
                                      <option value="firstSurname_client">Apellido</option>
                                    </select>
                                    <input type="text" v-model="search" @keyup="listCustomers(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Cédula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="customers in arrayCustomers" :Key="customers.id">
                                   <td  v-text="customers.cedula_client"></td>
                                   <td  v-text="customers.name_client"></td>
                                   <td  v-text="customers.firstSurname_client"></td>
                                   <td>
                                      <a href="#" class="btn  btn-outline-info btn-sm p-1" title="Ver" @click="openModal('customers','ver',customers)" ><i class="far fa-eye"></i></a>
                                       <span>&nbsp</span> 
                                      <a href="#" class="btn btn-outline-warning btn-sm p-1"  title="Editar" @click="openModal('customers','editar',customers)" ><i class="fas fa-user-edit"></i></a>
                                      <span>&nbsp</span>
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
                <div class="modal fade" :class="{'mostrar' : modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-primary modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" v-text="titleModal"></h4>
                                <button type="button" class="close" @click="closeModal()">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal customers">
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Nombre</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="name_client">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Primer Apellido</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="firstSurname_client">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Segundo Apellido</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="secondSurname_client">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Identificación</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="cedula_client">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Edad</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="age_client">
                                        </div>
                                        
                                        <div class="col-lg-4 mb-2">
                                        <label for="text-input ">Fecha de Nacimiento</label>
                                        <date-picker v-model="birth_date_client" v-bind:disabled="desactivar==1"   :language="es" :lang="lang" valueType="format"></date-picker>
                                        <!-- <Datepicker  v-model='birth_date_client'  v-bind:disabled="desactivar==1"   :language="es" :value="Date" :format="dateformat(birth_date_client)"  ></Datepicker> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Teléfono</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="phone_client">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Género</label>
                                            <select class="form-control custom-select " v-model=' gender_client ' v-bind:disabled="desactivar==1" >
                                                    <option value="0">Seleccione una opción</option>
                                                    <option>Femenino</option>
                                                    <option>Masculino</option>
                                                    <option>No especifica</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Estado</label>
                                            <select class="form-control custom-select" v-model='state_client ' v-bind:disabled="desactivar==1" >
                                                    <option value="0">Seleccione una opción</option>
                                                    <option>Soltero(a)</option>
                                                    <option>Casado(a)</option>
                                                    <option>Union Libre</option>
                                                    <option>Viudo(a)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Dirección</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="address_client">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Ciudad</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="city_client">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Nacionalidad</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="nationality_client">
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Correo electrónico</label>
                                            <input type="email" class="form-control"  v-model=' email_client ' v-bind:disabled="desactivar==1"  placeholder="">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                                <a  class="btn btn-success  text-white"  @click="registerCustomers()" v-if="accion==1">Registrar</a>
                                <a  class="btn btn-success  text-white" @click="updateCustomers()" v-if="accion==2">Actualizar</a>
                                <hr>
                                <template v-if="arrayError">
                                    <div >
                                        <ul class="list-unstyled  alert-danger  row">
                                                <li v-text="error[0]" class="col-sm-12 col-md-6 col-lg-6 pull-left"    v-for="error in arrayError "></li>
                                        </ul>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

    </div>
            <!--closed here Data-->

           
</template>


<script>
  import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';
  import {es}  from 'vue2-datepicker/locale/es';
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
            cedula_client : '',
            name_client : '',
            firstSurname_client : '',
            secondSurname_client : '',
            phone_client : '',
            birth_date_client : '',
            gender_client : 0,
            age_client : '',
            state_client : 0,
            email_client : '',
            address_client : '',
            city_client : '',
            nationality_client : '',
            desactivar : 0,
            arrayCustomers: [],
            client : '',
            modal : 0,
            titleModal : '',
            accion : 0,
            client_id : 0,
            search:'',
            valor : 'name_client',
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

        listCustomers(page,search,valor){
          let me=this;
          var url = 'customers?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
              var respuesta= response.data;
              me.arrayCustomers = respuesta.customers.data;
              me.pagination= respuesta.pagination;
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
          me.listcustomers(page,search,valor);
        },

        openModal(model, accion, data = [] ){

          switch(model){
              case  "customers" : {

                  switch(accion){
                      case "create" : {
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Registrar un nuevo cliente';
                            this.accion = 1;
                            this.cedula_client= '';
                            this.name_client = '';
                            this.firstSurname_client = '';
                            this.secondSurname_client = '';
                            this.birth_date_client = '2018-12-12';
                            this.gender_client = 'Seleccione una opción...';
                            this.age_client = '';
                            this.address_client = '';
                            this.city_client = '';
                            this.nationality_client = '';
                            this.state_client = 'Seleccione una opción...';
                            this.phone_client = '';
                            this.email_client = '';


                        break;       
                      };

                      case "editar" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Editar cliente';
                            this.accion = 2;
                            this.client_id = data['id'];
                            this.cedula_client=  data['cedula_client'];
                            this.name_client =  data['name_client'];
                            this.firstSurname_client =  data['firstSurname_client'];
                            this.secondSurname_client =  data['secondSurname_client'];
                            this.birth_date_client =  data['birth_date_client'];
                            this.gender_client =  data['gender_client'];
                            this.age_client =  data['age_client'];
                            this.address_client =  data['address_client'];
                            this.city_client =  data['city_client'];
                            this.nationality_client =  data['nationality_client'];
                            this.state_client =  data['state_client'];
                            this.phone_client =  data['phone_client'];
                            this.email_client =  data['email_client'];


                          break;

                      };

                      case "ver" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 1;
                            this.titleModal = 'Informacion completa del cliente';
                            this.accion = 3;
                            this.client_id = data['id'];
                            this.cedula_client=  data['cedula_client'];
                            this.name_client =  data['name_client'];
                            this.firstSurname_client =  data['firstSurname_client'];
                            this.secondSurname_client =  data['secondSurname_client'];
                            this.birth_date_client =  data['birth_date_client'];
                            this.gender_client =  data['gender_client'];
                            this.age_client =  data['age_client'];
                            this.address_client =  data['address_client'];
                            this.city_client =  data['city_client'];
                            this.nationality_client =  data['nationality_client'];
                            this.state_client =  data['state_client'];
                            this.phone_client =  data['phone_client'];
                            this.email_client =  data['email_client'];



                          break;

                      }
                  }
              }
          }

      },

        closeModal(){
          this.modal = 0;
          this.arrayError = [];
          this.listCustomers(1,this.search,this.valor);
        },

        registerCustomers(page,search,valor){

                let me = this;
                var url  = 'customers/register?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.post(url,{

                            'cedula_client' :    this.cedula_client,
                            'name_client' :    this.name_client,
                            'firstSurname_client' :   this.firstSurname_client,
                            'secondSurname_client'    : this.secondSurname_client,
                            // 'birth_date_client'    : this.dateformat(this.birth_date_client),
                            'birth_date_client'    : this.birth_date_client,
                            'gender_client'    : this.gender_client,
                            'age_client'    : this.age_client,
                            'address_client'    : this.address_client,
                            'city_client'    : this.city_client,
                            'nationality_client'    : this.nationality_client,
                            'state_client'    : this.state_client,
                            'phone_client'    : this.phone_client,
                            'email_client'    : this.email_client
                           

                }).then(function (response) {
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Tu cliente fue Registrado con Éxito',
                      showConfirmButton: false,
                      timer: 1500
                    });
                      me.closeModal();
                  })
                  .catch(function (error) {
                        var respuesta = error.response.data;
                        me.arrayError = respuesta.errors;
                        console.log(error.response.data);
                  });

            },

        updateCustomers(page,search,valor){

                let me = this;
                var url = 'customers/update?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.put(url,{

                            'id' : this.client_id,
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
                      title: 'Cliente Actualizado con Éxito',
                      showConfirmButton: false,
                      timer: 1500
                    });
                      me.closeModal();
                  })
                  .catch(function (error) {
                       var respuesta = error.response.data;
                       me.arrayError = respuesta.errors;
                       console.log(error.response.data);
                  });

            },



       

    },

    mounted() {

        this.listCustomers(1,this.search,this.valor);

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


</style>
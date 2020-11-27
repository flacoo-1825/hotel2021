<template>
    <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Actas
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="valor">
                                      <option value="number_certificate">Acta</option>
                                      <option value="name_client">Nombre</option>
                                      <option value="cedula_client">Cédula</option>
                                      <option value="firstSurname_client">Apellido</option>
                                    </select>
                                    <input type="text" v-model="search" @keyup="listCertificate(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Número de acta</th>
                                    <th>Identificación</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="certificate in arrayCertificate" :Key="certificate.id">
                                    <td  v-text="certificate.number_certificate"></td>
                                    <td  v-text="certificate.cedula_client"></td>
                                    <td  v-text="certificate.name_client"></td>
                                    <td  v-text="certificate.firstSurname_client"></td>
                                    <td>
                                        <a href="#" class="btn  btn-info btn-sm p-1 text-dark" title="Ver" @click="openModal('certificate','ver',certificate)" >
                                            <i class="fas fa-user-edit"></i> Editar
                                        </a>
                                        <a href="#" class="btn  btn-success btn-sm p-1 text-dark" title="Ver" @click="listCompanions(certificate.id)" >
                                            <i class="fas fa-street-view"></i> Acompañantes
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

                <!--open modal acomp -->
                <div class="modal fade" tabindex="-1" :class="{'mostrar' : add}" >
                  <div class="modal-dialog modal-dialog-scrollable  modal-lg" role="document">
                    <div class="modal-content container bg-container-modal">
                      <div class="text-center">
                        <h3 class="modal-title degraded-orange" v-text="titleModal"></h3>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col">
                            <table class="table table-hover  table-sm" >
                              <thead >
                                <tr class="bg-material-orange">
                                  <th>Nombre</th>
                                  <th>Primer Apellido</th>
                                  <th>segundo Apellido</th>
                                  <th>Cédula</th>
                                  <th>Fecha de Nacimiento</th>
                                  <th>Temperatura de entrada</th>
                                  <th>Temperatura de salida</th>
                                </tr>
                              </thead>
                              <tbody class="bg-white text-center">
                                <tr v-for="acomp in listAcomp " :key="acomp.id">
                                  <td v-text="acomp.name_acomp"></td>
                                  <td v-text="acomp.firstSurname_acomp"></td>
                                  <td v-text="acomp.secondSurname_acomp"></td>
                                  <td v-text="acomp.cedula_acomp"></td>
                                  <td v-text="acomp.birth_date_acomp"></td>
                                  <td v-text="acomp.temperature_entry_acomp"></td>
                                  <td v-text="acomp.temperature_exit_acomp"></td>
                                </tr>
                              </tbody>
                            </table>
                                  
                              </div>
                          </div>
                      
                      </div>
                      <div class="row modal-footer">
                        <div class="col-lg-2">
                          <a class="btn btn-danger  text-white" @click="closeModalAcomp()">Cerrar</a>
                        </div>       
                      </div>
                      <!-- /.modal-content -->
                    </div>
                  <!-- /.modal-dialog -->
                  </div>
                </div>
                <!-- closed modal acomp -->
                <!-- Fin ejemplo de tabla Listado -->
                <div class="modal fade" :class="{'mostrar' : modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-primary modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" v-text="titleModal"></h4>
                                <button type="button" class="close" @click="closeModal()">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row">
                                      <div class="col-md-8 mb-2 "> 
                                        </div>
                                        <div class="col-md-4 mb-2 input-group acta">
                                            <label class="number" for="text-input ">Acta</label>
                                            <h2 v-text="number_certificate"></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <label for="text-input ">Cliente</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="name_client">
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="text-input ">Primer apellido</label>
                                            <input type="text" class="form-control" v-model="firstSurname_client" v-bind:disabled="desactivar==1"   placeholder="introduzca apellido paterno">
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="text-input ">Segundo apellido</label>
                                            <input type="text" class="form-control" v-model='secondSurname_client'   placeholder="introduzca apellido materno">
                                         </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="text-input ">Cédula</label>
                                            <input type="text" class="form-control"  v-model="cedula_client"  v-bind:disabled="desactivar==1" >
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="text-input ">Celular</label>
                                            <input type="text" class="form-control"  v-model=' phone_client '  placeholder="introduzca el celular">
                                        </div>        
                                        <div class="col-sm-12 col-md-4">  
                                            <label for="email-input ">Nacionalidad</label>
                                            <input type="text" class="form-control"  v-model=' nationality_client '  placeholder="introduzca la nacionalidad">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="email-input ">Correo Electrónico</label>
                                            <input type="email" class="form-control"  v-model=' email_client '  placeholder="introduzca el correo">
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="text-input ">Ciudad de origen</label>
                                            <input type="text" class="form-control"  v-model="cityOrigin_certificate" v-bind:disabled="desactivar==1" placeholder="introduzca la ciudad">
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="text-input ">Ciudad de destino</label>
                                            <input type="text" class="form-control" v-model="cityDestination_certificate" v-bind:disabled="desactivar==1"  placeholder="introduzca la ciudad">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3 input-group">
                                          <div class="input-group">
                                            <label for="text-input ">Temperatura de entrada</label>
                                          </div>
                                          <input type="number" class="form-control"  v-model="temperature_entry_client"  placeholder="">
                                          <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                          </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 input-group">
                                          <div class="input-group">
                                            <label for="text-input ">Temperatura de salida</label>
                                          </div>
                                          <input type="number" class="form-control"  v-model="temperature_exit_client"  placeholder="">
                                          <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="text-input ">Placa Auto</label>
                                            <input type="text" class="form-control"  v-model="placaCar_certificate" v-bind:disabled="desactivar==1" placeholder="Ej: MNZ 328">
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="text-input ">Placa Moto</label>
                                            <input type="text" class="form-control"  v-model="placabike_certificate" v-bind:disabled="desactivar==1" placeholder="Ej: MNZ 328">
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="text-input ">Cantidad de Personas</label>
                                            <input type="number" class="form-control" v-model="adults_certificate"  placeholder="Ej: 1">
                                            <input type="number" class="form-control" v-model="children_certificate"  placeholder="Ej: 0">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 form-group">
                                            <label for="text-input ">Fecha de ingreso</label>
                                            <date-picker v-model="entry_certificate"   :language="es" :lang="lang" v-bind:disabled="desactivar==1" valueType="format"></date-picker>
                                        </div>
                                        <div class="col-sm-12 col-md-8 form-group">
                                            <label for="text-input ">Observaciones</label>
                                            <textarea  class="form-control"   v-model="observation_certificate" rows="2"></textarea> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                                <a  class="btn btn-success  text-white"  @click="registercertificate()" v-if="accion==1">Registrar</a>
                                <a  class="btn btn-success  text-white" @click="updatecertificate()" v-if="accion==2">Actualizar</a>
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
            listAcomp : [],
            add : 0,
            entry_certificate : new Date(),
            cityOrigin_certificate : '',
            temperature_entry_client :0,
            temperature_exit_client :0,
            cityDestination_certificate : '',
            children_certificate : '',
            adults_certificate : '',
            observation_certificate : '',
            placaCar_certificate : '',
            placabike_certificate : '',
            number_certificate : '032CT',
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
            arrayCertificate: [],
            client : '',
            modal : 0,
            titleModal : '',
            accion : 0,
            client_id : 0,
            search:'',
            valor : 'number_certificate',
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

        listCertificate(page,search,valor){
          let me=this;
          var url = 'certificate?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
                var respuesta= response.data;
                me.arrayCertificate = respuesta.certificates.data;
                me.pagination= respuesta.pagination;
            //  console.log(respuesta);

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
          me.listCertificate(page,search,valor);
        },

        listCompanions(search){
          let me=this;
          var url = 'companion/searchCompanions?&search='+ search;
          axios.get(url).then(function (response) {
                var respuesta= response.data;
                me.listAcomp = respuesta.companions;
                me.openModal('certificate','companions',me.listAcomp)
            // console.log(me.listAcomp);

          })
            .catch(function (error) {
              console.log(error);
            });
        },

        openModal(model, accion, data = [] ){

          switch(model){
              case  "certificate" : {

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
                            this.titleModal = 'Informacion completa del Acta';
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
                            this.children_certificate =  data['children_certificate'];
                            this.adults_certificate =  data['adults_certificate'];
                            this.cityOrigin_certificate =  data['cityOrigin_certificate'];
                            this.cityDestination_certificate =  data['cityDestination_certificate'];
                            this.number_certificate = data['number_certificate'];
                            this.observation_certificate = data['observation_certificate'];
                            this.placaCar_certificate = data['placaCar_certificate'];
                            this.placabike_certificate = data['placabike_certificate'];
                            this.entry_certificate = data['entry_certificate'];
                            this.temperature_entry_client = data['temperature_entry_client'];
                            this.temperature_exit_client = data['temperature_exit_client'];


                          break;

                      }

                       case "companions" :{

                          //console.log(data);
                            this.add = 1;
                            this.modal = 0;
                            this.desactivar = 1;
                            this.titleModal = 'Listado de Acompañantes';

                          break;

                      }
                  }
              }
          }

      },

        closeModal(){
          this.modal = 0;
          this.arrayError = [];
          this.listCertificate(1,this.search,this.valor);
        },

        closeModalAcomp(){
          this.add = 0; 
        },

        updatecertificate(page,search,valor){

                let me = this;
                var url = 'certificate/update?page=' + page + '&search='+ search + "&valor=" + valor;
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

        this.listCertificate(1,this.search,this.valor);

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

    .number{
       font-size: 30px;
       padding-right: 10px;
    }
    .acta h2{
       color: rgb(235, 23, 23);
       font-size: 40px;
    }

</style>
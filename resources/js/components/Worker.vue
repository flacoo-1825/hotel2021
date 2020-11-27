<template>
    <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Empleados
                        <button type="button" class="btn btn-success"  @click="openModal('worker','create')">
                            <i class="fas fa-plus-circle"></i>&nbsp;Nuevo empleados
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="valor">
                                      <option value="name_worker">Nombre</option>
                                      <option value="cedula_worker">Cédula</option>
                                      <option value="firstSurname_worker">Apellido</option>
                                    </select>
                                    <input type="text" v-model="search" @keyup="listWorkers(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
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
                                <tr class="text-center" v-for="worker in arrayWorker" :Key="worker.id">
                                   <td  v-text="worker.cedula_worker"></td>
                                   <td  v-text="worker.name_worker"></td>
                                   <td  v-text="worker.firstSurname_worker"></td>
                                   <td>
                                      <a href="#" class="btn  btn-outline-info btn-sm p-1" title="Ver" @click="openModal('worker','ver',worker)" ><i class="far fa-eye"></i></a>
                                       <span>&nbsp</span> 
                                      <a href="#" class="btn btn-outline-warning btn-sm p-1"  title="Editar" @click="openModal('worker','editar',worker)" ><i class="fas fa-user-edit"></i></a>
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
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal worker">
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Nombre</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="name_worker">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Primer Apellido</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="firstSurname_worker">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Segundo Apellido</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="secondSurname_worker">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Identificación</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="cedula_worker">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Edad</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="age_worker">
                                        </div>
                                        
                                        <div class="col-lg-4 mb-2">
                                        <label for="text-input ">Fecha de Nacimiento</label>
                                        <date-picker v-model="birth_date_worker" v-bind:disabled="desactivar==1"   :language="es" :lang="lang" valueType="format"></date-picker>
                                        <!-- <Datepicker  v-model='birth_date_worker'  v-bind:disabled="desactivar==1"   :language="es" :value="Date" :format="dateformat(birth_date_worker)"  ></Datepicker> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Teléfono</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="phone_worker">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Género</label>
                                            <select class="form-control custom-select " v-model=' gender_worker ' v-bind:disabled="desactivar==1" >
                                                    <option value="0">Seleccione una opción</option>
                                                    <option>Femenino</option>
                                                    <option>Masculino</option>
                                                    <option>Otro</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Estado</label>
                                            <select class="form-control custom-select" v-model='state_worker ' v-bind:disabled="desactivar==1" >
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
                                            <label for="text-input ">Correo electrónico</label>
                                            <input type="email" class="form-control"  v-model=' email_worker ' v-bind:disabled="desactivar==1"  placeholder="">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Password</label>
                                            <input type="password" class="form-control"  v-model=' password_worker ' v-bind:disabled="desactivar==1"  placeholder="">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Escolaridad</label>
                                            <select class="form-control custom-select" v-model=' scholarship_worker ' v-bind:disabled="desactivar==1" >
                                                <option value="0">Seleccione una opción</option>
                                                <option>Primaria</option>
                                                <option>Secundaria</option>
                                                <option>Técnico</option>
                                                <option>Profesional</option>
                                                <option>Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Dirección</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="address_worker">
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <label for="text-input ">Número de Hijos</label>
                                            <input type="number" class="form-control" v-bind:disabled="desactivar==1" v-model="number_children_worker">
                                        </div>
                                        <div class="col-lg-5 mb-2">
                                            <label class=" form-control-label" for="text-input">Tipo de vinculación</label>
                                            <select class="form-control custom-select" v-model='link_id' v-bind:disabled="desactivar==1">
                                                <option value="0" >Seleccione una opción</option>
                                                <option v-for="activa in arrayLinksActive" :Key="activa.id" :value="activa.id" v-text="activa.name_link"></option>
                                            </select>
                                          
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                                <a  class="btn btn-success  text-white"  @click="registerworker()" v-if="accion==1">Registrar</a>
                                <a  class="btn btn-success  text-white" @click="updateworker()" v-if="accion==2">Actualizar</a>
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
            cedula_worker : '',
            name_worker : '',
            link_id : 0,
            number_children_worker : '',
            firstSurname_worker : '',
            secondSurname_worker : '',
            password_worker : '',
            phone_worker : '',
            birth_date_worker : '',
            gender_worker : 0,
            age_worker : '',
            state_worker : 0,
            scholarship_worker : 0,
            email_worker : '',
            address_worker : '',
            city_worker : '',
            nationality_worker : '',
            desactivar : 0,
            arrayWorker: [],
            arrayLinksActive : [],
            worker : '',
            modal : 0,
            titleModal : '',
            accion : 0,
            worker_id : 0,
            search:'',
            valor : 'name_worker',
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

        listWorkers(page,search,valor){
          let me=this;
          var url = 'worker?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
              var respuesta= response.data;
              me.arrayWorker = respuesta.workers.data;
              me.pagination= respuesta.pagination;
            // console.log(response);

          })
            .catch(function (error) {
              console.log(error);
            });
        },

        listLinksActive(){
          let me=this;
          var url = 'link/active';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.arrayLinksActive = respuesta.links;
            //   me.pagination= respuesta.pagination;
            //    console.log(respuesta);

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
          me.listWorkerss(page,search,valor);
        },

        openModal(model, accion, data = [] ){

          switch(model){
              case  "worker" : {

                  switch(accion){
                      case "create" : {
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Registrar un nuevo empleado';
                            this.accion = 1;
                            this.link_id = 0;
                            this.scholarship_worker = 0;
                            this.number_children_worker = '';
                            this.password_worker = '';
                            this.cedula_worker= '';
                            this.name_worker = '';
                            this.firstSurname_worker = '';
                            this.secondSurname_worker = '';
                            this.birth_date_worker = '2020-12-12';
                            this.gender_worker = 0;
                            this.age_worker = '';
                            this.address_worker = '';
                            this.state_worker = 0;
                            this.phone_worker = '';
                            this.email_worker = '';


                        break;       
                      };

                      case "editar" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Editar empleado';
                            this.accion = 2;
                            this.link_id = data['link_id'];
                            this.scholarship_worker = data['scholarship_worker'];
                            this.number_children_worker = data['number_children_worker'];
                            this.password_worker = data['password_worker'];
                            this.worker_id = data['id'];
                            this.cedula_worker=  data['cedula_worker'];
                            this.name_worker =  data['name_worker'];
                            this.firstSurname_worker =  data['firstSurname_worker'];
                            this.secondSurname_worker =  data['secondSurname_worker'];
                            this.birth_date_worker =  data['birth_date_worker'];
                            this.gender_worker =  data['gender_worker'];
                            this.age_worker =  data['age_worker'];
                            this.address_worker =  data['address_worker'];
                            this.state_worker =  data['state_worker'];
                            this.phone_worker =  data['phone_worker'];
                            this.email_worker =  data['email_worker'];


                          break;

                      };

                      case "ver" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 1;
                            this.titleModal = 'Informacion completa del empleado';
                            this.accion = 3;
                            this.link_id = data['link_id'];
                            this.scholarship_worker = data['scholarship_worker'];
                            this.number_children_worker = data['number_children_worker'];
                            this.password_worker = data['password_worker'];
                            this.worker_id = data['id'];
                            this.cedula_worker=  data['cedula_worker'];
                            this.name_worker =  data['name_worker'];
                            this.firstSurname_worker =  data['firstSurname_worker'];
                            this.secondSurname_worker =  data['secondSurname_worker'];
                            this.birth_date_worker =  data['birth_date_worker'];
                            this.gender_worker =  data['gender_worker'];
                            this.age_worker =  data['age_worker'];
                            this.address_worker =  data['address_worker'];
                            this.state_worker =  data['state_worker'];
                            this.phone_worker =  data['phone_worker'];
                            this.email_worker =  data['email_worker'];



                          break;

                      }
                  }
              }
          }

      },

        closeModal(){
          this.modal = 0;
          this.arrayError = [];
          this.listWorkers(1,this.search,this.valor);
        },

        registerworker(page,search,valor){

                let me = this;
                var url  = 'worker/register?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.post(url,{

                            'link_id' : this.link_id,
                            'scholarship_worker' : this.scholarship_worker,
                            'number_children_worker' : this.number_children_worker,
                            'password_worker' : this.password_worker,
                            'cedula_worker' :    this.cedula_worker,
                            'name_worker' :    this.name_worker,
                            'firstSurname_worker' :   this.firstSurname_worker,
                            'secondSurname_worker'    : this.secondSurname_worker,
                            'birth_date_worker'    : this.birth_date_worker,
                            'gender_worker'    : this.gender_worker,
                            'age_worker'    : this.age_worker,
                            'address_worker'    : this.address_worker,
                            'state_worker'    : this.state_worker,
                            'phone_worker'    : this.phone_worker,
                            'email_worker'    : this.email_worker
                           

                }).then(function (response) {
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Tu workere fue Registrado con Éxito',
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

        updateworker(page,search,valor){

                let me = this;
                var url = 'worker/update?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.put(url,{
                            'id' : this.worker_id,
                            'link_id' : this.link_id,
                            'scholarship_worker' : this.scholarship_worker,
                            'number_children_worker' : this.number_children_worker,
                            'password_worker' : this.password_worker,
                            'cedula_worker' :    this.cedula_worker,
                            'name_worker' :    this.name_worker,
                            'firstSurname_worker' :   this.firstSurname_worker,
                            'secondSurname_worker'    : this.secondSurname_worker,
                            'birth_date_worker'    : this.birth_date_worker,
                            'gender_worker'    : this.gender_worker,
                            'age_worker'    : this.age_worker,
                            'address_worker'    : this.address_worker,
                            'state_worker'    : this.state_worker,
                            'phone_worker'    : this.phone_worker,
                            'email_worker'    : this.email_worker


                }).then(function (response) {
                      Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'workere Actualizado con Éxito',
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

        this.listWorkers(1,this.search,this.valor);
        this.listLinksActive();

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
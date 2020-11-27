<template>
    <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Acompañantes
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="valor">
                                      <option value="name_acomp">Nombre</option>
                                      <option value="cedula_acomp">Cédula</option>
                                      <option value="firstSurname_acomp">Apellido</option>
                                    </select>
                                    <input type="text" v-model="search" @keyup="listCompanions(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
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
                                <tr class="text-center" v-for="companion in arrayCompanion" :Key="companion.id">
                                    <td  v-text="companion.cedula_acomp"></td>
                                    <td  v-text="companion.name_acomp"></td>
                                    <td  v-text="companion.firstSurname_acomp"></td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm p-1" title="Ver" @click="openModal('companions','ver',companion)" >
                                            <i class="far fa-eye"></i> Ver
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
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal companions">
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Nombre</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="name_acomp">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Primer Apellido</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="firstSurname_acomp">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Segundo Apellido</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="secondSurname_acomp">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Identificación</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="cedula_acomp">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Edad</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="age_acomp">
                                        </div>
                                        
                                        <div class="col-lg-4 mb-2">
                                        <label for="text-input ">Fecha de Nacimiento</label>
                                        <date-picker v-model="birth_date_acomp" v-bind:disabled="desactivar==1"   :language="es" :lang="lang" valueType="format"></date-picker>
                                        <!-- <Datepicker  v-model='birth_date_acomp'  v-bind:disabled="desactivar==1"   :language="es" :value="Date" :format="dateformat(birth_date_acomp)"  ></Datepicker> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Temperatura de ingreso</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="temperature_entry_acomp">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Temperatura de salida</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="temperature_exit_acomp">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                                <a  class="btn btn-success  text-white" @click="updateCompanions()" v-if="accion==2">Actualizar</a>
                               
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
            cedula_acomp : '',
            name_acomp : '',
            firstSurname_acomp : '',
            secondSurname_acomp : '',
            phone_acomp : '',
            birth_date_acomp : '',
            gender_acomp : 0,
            age_acomp : '',
            state_acomp : 0,
            email_acomp : '',
            temperature_entry_acomp : '',
            temperature_exit_acomp : '',
            nationality_acomp : '',
            desactivar : 0,
            arrayCompanion: [],
            client : '',
            modal : 0,
            titleModal : '',
            accion : 0,
            client_id : 0,
            search:'',
            valor : 'name_acomp',
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

        listCompanions(page,search,valor){
          let me=this;
          var url = 'companion?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
              var respuesta= response.data;
              me.arrayCompanion = respuesta.companions.data;
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
          me.listCompanions(page,search,valor);
        },

        openModal(model, accion, data = [] ){

          switch(model){
              case  "companions" : {

                  switch(accion){
                      case "create" : {
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Registrar un nuevo cliente';
                            this.accion = 1;
                            this.cedula_acomp= '';
                            this.name_acomp = '';
                            this.firstSurname_acomp = '';
                            this.secondSurname_acomp = '';
                            this.birth_date_acomp = '2018-12-12';
                            this.gender_acomp = 'Seleccione una opción...';
                            this.age_acomp = '';
                            this.temperature_entry_acomp = '';
                            this.temperature_exit_acomp = '';
                            this.nationality_acomp = '';
                            this.state_acomp = 'Seleccione una opción...';
                            this.phone_acomp = '';
                            this.email_acomp = '';


                        break;       
                      };

                      case "editar" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Editar cliente';
                            this.accion = 2;
                            this.client_id = data['id'];
                            this.cedula_acomp=  data['cedula_acomp'];
                            this.name_acomp =  data['name_acomp'];
                            this.firstSurname_acomp =  data['firstSurname_acomp'];
                            this.secondSurname_acomp =  data['secondSurname_acomp'];
                            this.birth_date_acomp =  data['birth_date_acomp'];
                            this.gender_acomp =  data['gender_acomp'];
                            this.age_acomp =  data['age_acomp'];
                            this.temperature_entry_acomp =  data['temperature_entry_acomp'];
                            this.temperature_exit_acomp =  data['temperature_exit_acomp'];
                            this.nationality_acomp =  data['nationality_acomp'];
                            this.state_acomp =  data['state_acomp'];
                            this.phone_acomp =  data['phone_acomp'];
                            this.email_acomp =  data['email_acomp'];


                          break;

                      };

                      case "ver" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 1;
                            this.titleModal = 'Informacion completa del cliente';
                            this.accion = 3;
                            this.client_id = data['id'];
                            this.cedula_acomp=  data['cedula_acomp'];
                            this.name_acomp =  data['name_acomp'];
                            this.firstSurname_acomp =  data['firstSurname_acomp'];
                            this.secondSurname_acomp =  data['secondSurname_acomp'];
                            this.birth_date_acomp =  data['birth_date_acomp'];
                            this.gender_acomp =  data['gender_acomp'];
                            this.age_acomp =  data['age_acomp'];
                            this.temperature_entry_acomp =  data['temperature_entry_acomp'];
                            this.temperature_exit_acomp =  data['temperature_exit_acomp'];
                            this.nationality_acomp =  data['nationality_acomp'];
                            this.state_acomp =  data['state_acomp'];
                            this.phone_acomp =  data['phone_acomp'];
                            this.email_acomp =  data['email_acomp'];



                          break;

                      }
                  }
              }
          }

      },

        closeModal(){
          this.modal = 0;
          this.arrayError = [];
          this.listCompanions(1,this.search,this.valor);
        },

        updateCompanions(page,search,valor){

                let me = this;
                var url = 'companions/update?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.put(url,{

                            'id' : this.client_id,
                            'cedula_acomp' :    this.cedula_acomp,
                            'name_acomp' :    this.name_acomp,
                            'firstSurname_acomp' :   this.firstSurname_acomp,
                            'secondSurname_acomp'    : this.secondSurname_acomp,
                            'birth_date_acomp'    : this.birth_date_acomp,
                            'gender_acomp'    : this.gender_acomp,
                            'age_acomp'    : this.age_acomp,
                            'temperature_entry_acomp'    : this.temperature_entry_acomp,
                            'temperature_exit_acomp'    : this.temperature_exit_acomp,
                            'nationality_acomp'    : this.nationality_acomp,
                            'state_acomp'    : this.state_acomp,
                            'phone_acomp'    : this.phone_acomp,
                            'email_acomp'    : this.email_acomp,


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

        this.listCompanions(1,this.search,this.valor);

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
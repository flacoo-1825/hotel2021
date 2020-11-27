<template>
    <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Proveedores
                        <button type="button" class="btn btn-success"  @click="openModal('provider','create')">
                            <i class="fas fa-plus-circle"></i>&nbsp;Nuevo Proveedor
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="valor">
                                      <option value="name_provider">Nombre</option>
                                      <option value="firstSurname_provider">Apellido</option>
                                    </select>
                                    <input type="text" v-model="search" @keyup="listProviders(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Teléfono</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="provider in arrayProvider" :Key="provider.id">
                                   <td  v-text="provider.name_provider"></td>
                                   <td  v-text="provider.firstSurname_provider"></td>
                                   <td  v-text="provider.phone_provider"></td>
                                   <td>
                                        <a href="#" class="btn  btn-outline-info btn-sm p-1" title="Ver" @click="openModal('provider','ver',provider)" ><i class="far fa-eye"></i></a>
                                        <span>&nbsp</span> 
                                        <a href="#" class="btn btn-outline-warning btn-sm p-1"  title="Editar" @click="openModal('provider','editar',provider)" ><i class="fas fa-user-edit"></i></a>
                                        <span>&nbsp</span>
                                        <template v-if="provider.condition_provider">
                                            <button class="btn btn-outline-success btn-sm p-1" title="Activo"   @click="desactivarProvider(provider.id)"><i class="fas fa-check p-1"></i></button>
                                        </template>
                                        <template v-else>
                                            <a href="#" class="btn btn-outline-danger btn-sm" title="Inactivo"  @click="activarProvider(provider.id)"><i class="fas fa-times"></i></a>
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
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal provider">
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Nombre</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="name_provider">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Primer Apellido</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="firstSurname_provider">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Segundo Apellido</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="secondSurname_provider">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Teléfono</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="phone_provider">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Correo electrónico</label>
                                            <input type="email" class="form-control"  v-model=' email_provider ' v-bind:disabled="desactivar==1"  placeholder="">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Dirección</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="address_provider">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Compañia</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="company_provider">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                                <a  class="btn btn-success  text-white"  @click="registerProvider()" v-if="accion==1">Registrar</a>
                                <a  class="btn btn-success  text-white" @click="updateProvider()" v-if="accion==2">Actualizar</a>
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
  export default {
      
    data() {
        return {
            provider_id :  '',
            name_provider : '',
            firstSurname_provider : '',
            secondSurname_provider : '',
            company_provider : '',
            phone_provider : '',
            email_provider : '',
            address_provider : '',
            desactivar : 0,
            arrayProvider: [],
            arrayProvidersActive : [],
            provider : '',
            modal : 0,
            titleModal : '',
            accion : 0,
            provider_id : 0,
            search:'',
            valor : 'name_provider',
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

        listProviders(page,search,valor){
          let me=this;
          var url = 'provider?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
              var respuesta= response.data;
              me.arrayProvider = respuesta.providers.data;
              me.pagination= respuesta.pagination;
            // console.log(response);

          })
            .catch(function (error) {
              console.log(error);
            });
        },

        listProvidersActive(){
          let me=this;
          var url = 'provider/active';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.arrayProvidersActive = respuesta.providers;
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
          me.listProviderss(page,search,valor);
        },

        openModal(model, accion, data = [] ){

          switch(model){
              case  "provider" : {

                  switch(accion){
                      case "create" : {
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Registrar un nuevo empleado';
                            this.accion = 1;
                            this.name_provider = '';
                            this.firstSurname_provider = '';
                            this.secondSurname_provider = '';
                            this.company_provider = '';
                            this.address_provider = '';
                            this.phone_provider = '';
                            this.email_provider = '';


                        break;       
                      };

                      case "editar" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Editar empleado';
                            this.accion = 2;
                            this.provider_id =  data['id'];
                            this.name_provider =  data['name_provider'];
                            this.firstSurname_provider =  data['firstSurname_provider'];
                            this.secondSurname_provider =  data['secondSurname_provider'];
                            this.company_provider =  data['company_provider'];
                            this.address_provider =  data['address_provider'];
                            this.phone_provider =  data['phone_provider'];
                            this.email_provider =  data['email_provider'];

                          break;

                      };

                      case "ver" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 1;
                            this.titleModal = 'Informacion completa del empleado';
                            this.accion = 3;
                            this.provider_id =  data['id'];
                            this.name_provider =  data['name_provider'];
                            this.firstSurname_provider =  data['firstSurname_provider'];
                            this.secondSurname_provider =  data['secondSurname_provider'];
                            this.company_provider =  data['company_provider'];
                            this.address_provider =  data['address_provider'];
                            this.phone_provider =  data['phone_provider'];
                            this.email_provider =  data['email_provider'];

                          break;

                      }
                  }
              }
          }

      },

        closeModal(){
          this.modal = 0;
          this.arrayError = [];
          this.listProviders(1,this.search,this.valor);
        },

        registerProvider(page,search,valor){

                let me = this;
                var url  = 'provider/register?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.post(url,{

                            'name_provider' :    this.name_provider,
                            'firstSurname_provider' :   this.firstSurname_provider,
                            'secondSurname_provider'    : this.secondSurname_provider,
                            'company_provider'    : this.company_provider,
                            'address_provider'    : this.address_provider,
                            'phone_provider'    : this.phone_provider,
                            'email_provider'    : this.email_provider
                           

                }).then(function (response) {
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Tu proveedor fue Registrado con Éxito',
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

        updateProvider(page,search,valor){

                let me = this;
                var url = 'provider/update?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.put(url,{

                            'id' : this.provider_id,
                            'name_provider' :    this.name_provider,
                            'firstSurname_provider' :   this.firstSurname_provider,
                            'secondSurname_provider'    : this.secondSurname_provider,
                            'company_provider'    : this.company_provider,
                            'address_provider'    : this.address_provider,
                            'phone_provider'    : this.phone_provider,
                            'email_provider'    : this.email_provider,


                }).then(function (response) {
                      Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'proveedor fue Actualizado con Éxito',
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

        activarProvider(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a Activar éste proveedor!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Activalo',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 

                      let me = this;

                          axios.put('provider/activo',{
                              'id': id
                          }).then(function (response) {
                              me.listProviders(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Activado!',
                      'Tu proveedor quedó Activado.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu proveedor sigue Desactivado :)',
                      'error'
                    )
                  }
                })
            },

        desactivarProvider(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a desactivar éste proveedor!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Desactivalo',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 

                      let me = this;

                          axios.put('provider/inactivo',{
                              'id': id
                          }).then(function (response) {
                              me.listProviders(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Desativado!',
                      'Tu proveedor quedó desativado.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu proveedor está a salvo :)',
                      'error'
                    )
                  }
                })
              }


       

    },

    mounted() {

        this.listProviders(1,this.search,this.valor);
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
<template>
    <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Tipo de habitación
                        <button type="button" class="btn btn-success"  @click="openModal('typeroom','create')">
                            <i class="fas fa-plus-circle"></i>&nbsp;Nuevo tipo de habitación
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="valor">
                                      <option value="name_type_room">Nombre</option>
                                    </select>
                                    <input type="text" v-model="search" @keyup="listTyperoom(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="typeroom in arrayTypeRoom " :Key="typeroom.id">
                                   <td  v-text="typeroom.name_type_room"></td>
                                   <td  v-text="typeroom.description_type_room"></td>
                                   <td>
                                      <a href="#" class="btn  btn-outline-info btn-sm p-1" title="Ver" @click="openModal('typeroom','ver',typeroom)" ><i class="far fa-eye"></i></a>
                                       <span>&nbsp</span> 
                                      <a href="#" class="btn btn-outline-warning btn-sm p-1"  title="Editar" @click="openModal('typeroom','editar',typeroom)" ><i class="fas fa-user-edit"></i></a>
                                      <span>&nbsp</span>
                                      <template v-if="typeroom.state_type_room">
                                           <button class="btn btn-outline-success btn-sm p-1" title="Activo"   @click="desactivarTyperoom(typeroom.id)"><i class="fas fa-check p-1"></i></button>
                                      </template>
                                      <template v-else>
                                           <a href="#" class="btn btn-outline-danger btn-sm" title="Inactivo"  @click="activarTyperoom(typeroom.id)"><i class="fas fa-times"></i></a>
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
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Nombre de la habitación</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="name_type_room" v-text="name_type_room"  name="nombre" class="form-control" placeholder="Nombre de habitación">
                                            <span class="help-block">(*) Ingrese el nombre de la habitación</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                        <div class="col-md-9">
                                            <input type="email" v-text="description_type_room" v-model="description_type_room" name="descripcion" class="form-control" placeholder="escriba su Descripción">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                                <a  class="btn btn-success  text-white"  @click="registerTyperoom()" v-if="accion==1">Registrar</a>
                                <a  class="btn btn-success  text-white" @click="updateTyperoom()" v-if="accion==2">Actualizar</a>
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

            props:{

              format: { default: 'YYYY-MM-DD'},
              value: {Date:'2018-12-12'}
              
            },
           components: {
    },
    data() {
        return {
            name_room : '',
            valor : '',
            name_type_room : '',
            description_type_room : '',
            state_type_room : '',
            arrayTypeRoom : [],
            typeroom : '',
            modal : 0,
            titleModal : '',
            accion : 0,
            desactivar : 0,
            condition : 1,
            search:'',
            valor : 'name_type_room',
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
            // es : es,
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
              
            listTyperoom(page,search,valor){
              let me=this;
              var url = 'typeroom?page=' + page + '&search='+ search + "&valor=" + valor;
              axios.get(url).then(function (response) {
                  var respuesta= response.data;
                  me.arrayTypeRoom = respuesta.typeRoom.data;
                  me.pagination= respuesta.pagination;

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
              me.listTyperoom(page,search,valor);
            },

            openModal(model, accion, data = [] ){

              switch(model){
                  case  "typeroom" : {

                      switch(accion){
                          case "create" : {

                              this.modal = 1;
                              this.editar = 0;
                              this.desactivar = 0;
                              this.titleModal = 'Registrar un nuevo tipo de habitación';
                              this.accion = 1;
                              this.name_type_room = '';
                              this.description_type_room = '';
                           break;       
                          };

                          case "editar" :{

                             //console.log(data);
                              this.modal = 1;
                              this.desactivar = 0;
                              this.titleModal = 'Editar el tipo de habitación';
                              this.accion = 2;
                              this.id_type_room = data['id'];
                              this.name_type_room =  data['name_type_room'];
                              this.description_type_room =  data['description_type_room'];
                              
                              break;

                          };

                          case "ver" :{

                             //console.log(data);
                              this.modal = 1;
                              this.editar = 1;
                              this.desactivar = 1;
                              this.titleModal = 'Información completa del tipo de habitación';
                              this.accion = 3;
                              this.id_type_room = data['id'];
                              this.name_type_room =  data['name_type_room'];
                              this.description_type_room =  data['description_type_room'];

                              break;

                          }
                      }
                  }
              }

            },

            closeModal(){
                  this.modal = 0;
                  this.arrayError = [];
                  this.listTyperoom(1,this.search,this.valor);
            },


            registerTyperoom(page,search,valor){

                  let me = this;
                  var url  = 'typeroom/register?page=' + page + '&search='+ search + "&valor=" + valor;
                  axios.post(url,{
                            'name_type_room' :    this.name_type_room,
                            'description_type_room' :   this.description_type_room,
                  }).then(function (response) {
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'tipo de habitación Registrado con Éxito',
                      showConfirmButton: false,
                      timer: 1500
                    });
                      me.closeModal();
                  })
                    .catch(function (error) {
                          var respuesta = error.data;
                          me.arrayError = respuesta;
                    });

            },

            updateTyperoom(page,search,valor){

                  let me = this;
                  var url = 'typeroom/update?page=' + page + '&search='+ search + "&valor=" + valor;
                  axios.put(url,{
                            'id' : this.id_type_room,
                            'name_type_room' :    this.name_type_room,
                            'description_type_room' :   this.description_type_room,

                  }).then(function (response) {
                      Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'tipo de habitación Actualizado con Éxito',
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

            activarTyperoom(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a Activar éste tipo de habitación!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Activalo',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {  

                      let me = this;

                          axios.put('typeroom/activo',{
                              'id': id
                          }).then(function (response) {
                              me.listTyperoom(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Activado!',
                      'Tu tipo de habitación quedó Activado.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu tipo de habitación sigue Desactivado :)',
                      'error'
                    )
                  }
                })
            },

            desactivarTyperoom(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a desactivar éste tipo de habitación!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Desactivalo',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 

                      let me = this;

                          axios.put('typeroom/inactivo',{
                              'id': id
                          }).then(function (response) {
                              me.listTyperoom(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Desativado!',
                      'Tu tipo de habitación quedó desativado.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu tipo de habitación está a salvo :)',
                      'error'
                    )
                  }
                })
              }

            },

            mounted() {

                this.listTyperoom(1,this.search,this.valor);

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
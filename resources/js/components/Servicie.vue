<template>
    <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Servicios
                        <button type="button" class="btn btn-success"  @click="openModal('servicie','create')">
                            <i class="fas fa-plus-circle"></i> Nuevo servicio
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="valor">
                                      <option value="name_servicie">Nombre</option>
                                    </select>
                                    <input type="text" v-model="search" @keyup="listServicies(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Descripción</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="servicie in arrayservicie" :Key="servicie.id">
                                   <td  v-text="servicie.name_servicie"></td>
                                   <td>{{servicie.price_servicie | currency}}</td>
                                   <td  v-text="servicie.description_servicie"></td>
                                   <td>
                                      <a href="#" class="btn  btn-outline-info btn-sm p-1" title="Ver" @click="openModal('servicie','ver',servicie)" >
                                        <i class="far fa-eye"></i>
                                      </a>
                                      <a href="#" class="btn btn-outline-warning btn-sm p-1"  title="Editar" @click="openModal('servicie','editar',servicie)" >
                                        <i class="fas fa-user-edit"></i>
                                      </a>
                                      <template v-if="servicie.condition_servicie">
                                           <button class="btn btn-outline-success btn-sm p-1" title="Activo"   @click="desactivarservicie(servicie.id)"><i class="fas fa-check p-1"></i></button>
                                      </template>
                                      <template v-else>
                                           <a href="#" class="btn btn-outline-danger btn-sm" title="Inactivo"  @click="activarservicie(servicie.id)"><i class="fas fa-times"></i></a>
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
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal servicie">
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label for="text-input ">Nombre</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="name_servicie">
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label for="text-input ">Precio</label>
                                            <input type="number" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="price_servicie">
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <label for="text-input ">Descripción</label>
                                            <textarea  cols="30" rows="4" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="description_servicie"></textarea>
                                          
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                                <a  class="btn btn-success  text-white"  @click="registerservicie()" v-if="accion==1">Registrar</a>
                                <a  class="btn btn-success  text-white" @click="updateservicie()" v-if="accion==2">Actualizar</a>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</template>


<script>
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
            name_servicie : '',
            price_servicie : '',
            description_servicie : '',
            desactivar : 0,
            arrayservicie: [],
            arrayLinksActive : [],
            servicie : '',
            modal : 0,
            titleModal : '',
            accion : 0,
            servicie_id : 0,
            search:'',
            valor : 'name_servicie',
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

        listServicies(page,search,valor){
          let me=this;
          var url = 'servicie?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
              var respuesta= response.data;
              me.arrayservicie = respuesta.servicies.data;
              me.pagination= respuesta.pagination;
            // console.log(respuesta);

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
          me.listServicies(page,search,valor);
        },

        openModal(model, accion, data = [] ){

          switch(model){
              case  "servicie" : {

                  switch(accion){
                      case "create" : {
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Registrar una nueva servicio';
                            this.accion = 1;
                            this.name_servicie = '';
                            this.description_servicie = '';
                            this.price_servicie = '';

                        break;       
                      };

                      case "editar" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Editar servicio';
                            this.accion = 2;
                            this.servicie_id = data['id'];
                            this.name_servicie =  data['name_servicie'];
                            this.description_servicie =  data['description_servicie'];
                            this.price_servicie =  data['price_servicie'];

                          break;

                      };

                      case "ver" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 1;
                            this.titleModal = 'Información completa de la servicio';
                            this.accion = 3;
                            this.servicie_id = data['id'];
                            this.name_servicie =  data['name_servicie'];
                            this.description_servicie =  data['description_servicie'];
                            this.price_servicie =  data['price_servicie'];

                          break;

                      }
                  }
              }
          }

      },

        closeModal(){
          this.modal = 0;
          this.arrayError = [];
          this.listServicies(1,this.search,this.valor);
        },

        registerservicie(page,search,valor){

                let me = this;
                var url  = 'servicie/register?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.post(url,{

                            'name_servicie' :    this.name_servicie,
                            'description_servicie' :   this.description_servicie,
                            'price_servicie' :   this.price_servicie,
                           

                }).then(function (response) {
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Tu servicio fue Registrado con Éxito',
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

        updateservicie(page,search,valor){

                let me = this;
                var url = 'servicie/update?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.put(url,{
                            'id' : this.servicie_id,
                            'name_servicie' :    this.name_servicie,
                            'description_servicie' :   this.description_servicie,
                            'price_servicie' :   this.price_servicie,


                }).then(function (response) {
                      Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'servicio Actualizado con Éxito',
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

        
        activarservicie(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a Activar éste servicio!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Activalo',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 

                      let me = this;

                          axios.put('servicie/activo',{
                              'id': id
                          }).then(function (response) {
                              me.listServicies(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Activado!',
                      'Tu servicio quedó Activado.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu servicio sigue Desactivado :)',
                      'error'
                    )
                  }
                })
            },

        desactivarservicie(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a desactivar ésta servicio!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Desactivalo',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 

                      let me = this;

                          axios.put('servicie/inactivo',{
                              'id': id
                          }).then(function (response) {
                              me.listServicies(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Desativado!',
                      'Tu servicio quedó desativado.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu servicio está a salvo :)',
                      'error'
                    )
                  }
                })
              }



    },

    mounted() {

        this.listServicies(1,this.search,this.valor);

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
<template>
    <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Adicionales
                        <button type="button" class="btn btn-success"  @click="openModal('additional','create')">
                            <i class="fas fa-plus-circle"></i>&nbsp;Nuevo adicional
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="valor">
                                      <option value="name_additional">Nombre</option>
                                    </select>
                                    <input type="text" v-model="search" @keyup="listAdditionals(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
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
                                <tr class="text-center" v-for="additional in arrayAdditional" :Key="additional.id">
                                   <td  v-text="additional.name_additional"></td>
                                   <td>{{additional.price_additional | currency}}</td>
                                   <td  v-text="additional.description_additional"></td>
                                   <td>
                                      <a href="#" class="btn  btn-outline-info btn-sm p-1" title="Ver" @click="openModal('additional','ver',additional)" ><i class="far fa-eye"></i></a>
                                       <span>&nbsp</span> 
                                      <a href="#" class="btn btn-outline-warning btn-sm p-1"  title="Editar" @click="openModal('additional','editar',additional)" ><i class="fas fa-user-edit"></i></a>
                                      <span>&nbsp</span>
                                      <template v-if="additional.condition_additional">
                                           <button class="btn btn-outline-success btn-sm p-1" title="Activo"   @click="desactivarAdditional(additional.id)"><i class="fas fa-check p-1"></i></button>
                                      </template>
                                      <template v-else>
                                           <a href="#" class="btn btn-outline-danger btn-sm" title="Inactivo"  @click="activarAdditional(additional.id)"><i class="fas fa-times"></i></a>
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
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal additional">
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label for="text-input ">Nombre</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="name_additional">
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label for="text-input ">Precio</label>
                                            <input type="number" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="price_additional">
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <label for="text-input ">Descripción</label>
                                            <textarea  cols="30" rows="4" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="description_additional"></textarea>
                                          
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                                <a  class="btn btn-success  text-white"  @click="registerAdditional()" v-if="accion==1">Registrar</a>
                                <a  class="btn btn-success  text-white" @click="updateAdditional()" v-if="accion==2">Actualizar</a>
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
            name_additional : '',
            price_additional : '',
            description_additional : '',
            desactivar : 0,
            arrayAdditional: [],
            arrayLinksActive : [],
            additional : '',
            modal : 0,
            titleModal : '',
            accion : 0,
            additional_id : 0,
            search:'',
            valor : 'name_additional',
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

        listAdditionals(page,search,valor){
          let me=this;
          var url = 'additional?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
              var respuesta= response.data;
              me.arrayAdditional = respuesta.additionals.data;
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
          me.listAdditionals(page,search,valor);
        },

        openModal(model, accion, data = [] ){

          switch(model){
              case  "additional" : {

                  switch(accion){
                      case "create" : {
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Registrar una nueva adicional';
                            this.accion = 1;
                            this.name_additional = '';
                            this.description_additional = '';
                            this.price_additional = '';

                        break;       
                      };

                      case "editar" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Editar adicional';
                            this.accion = 2;
                            this.additional_id = data['id'];
                            this.name_additional =  data['name_additional'];
                            this.description_additional =  data['description_additional'];
                            this.price_additional =  data['price_additional'];

                          break;

                      };

                      case "ver" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 1;
                            this.titleModal = 'Información completa de la adicional';
                            this.accion = 3;
                            this.additional_id = data['id'];
                            this.name_additional =  data['name_additional'];
                            this.description_additional =  data['description_additional'];
                            this.price_additional =  data['price_additional'];

                          break;

                      }
                  }
              }
          }

      },

        closeModal(){
          this.modal = 0;
          this.arrayError = [];
          this.listAdditionals(1,this.search,this.valor);
        },

        registerAdditional(page,search,valor){

                let me = this;
                var url  = 'additional/register?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.post(url,{

                            'name_additional' :    this.name_additional,
                            'description_additional' :   this.description_additional,
                            'price_additional' :   this.price_additional,
                           

                }).then(function (response) {
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Tu adicional fue Registrada con Éxito',
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

        updateAdditional(page,search,valor){

                let me = this;
                var url = 'additional/update?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.put(url,{
                            'id' : this.additional_id,
                            'name_additional' :    this.name_additional,
                            'description_additional' :   this.description_additional,
                            'price_additional' :   this.price_additional,


                }).then(function (response) {
                      Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'adicional Actualizada con Éxito',
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

        
        activarAdditional(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a Activar ésta adicional!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Activala',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 

                      let me = this;

                          axios.put('additional/activo',{
                              'id': id
                          }).then(function (response) {
                              me.listAdditionals(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Activado!',
                      'Tu adicional quedó Activada.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu adicional sigue Desactivada :)',
                      'error'
                    )
                  }
                })
            },

        desactivarAdditional(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a desactivar ésta adicional!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Desactivala',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 

                      let me = this;

                          axios.put('additional/inactivo',{
                              'id': id
                          }).then(function (response) {
                              me.listAdditionals(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Desativado!',
                      'Tu adicional quedó desativada.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu adicional está a salvo :)',
                      'error'
                    )
                  }
                })
              }



    },

    mounted() {

        this.listAdditionals(1,this.search,this.valor);

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
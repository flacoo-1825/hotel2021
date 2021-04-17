<template>
    <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> habitación
                        <button type="button" class="btn btn-success"  @click="openModal('room','create')">
                            <i class="fas fa-plus-circle"></i>&nbsp;Nueva habitación
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="valor">
                                      <option value="name_room">Nombre</option>
                                      <option value="number_type_room">Número</option>
                                    </select>
                                    <input type="text" v-model="search" @keyup="listRooms(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
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
                                <tr class="text-center" v-for="room in arrayRoom" :Key="room.id">
                                   <td  v-text="room.number"></td>
                                   <td  v-text="room.price"></td>
                                   <td class="d-flex justify-content-between">
                                      <a href="#" class="btn  btn-info btn-sm p-1" title="Ver" @click="openModal('room','ver',room)" ><i class="far fa-eye"></i> Ver</a>
                                        
                                      <a href="#" class="btn btn-warning btn-sm p-1"  title="Editar" @click="openModal('room','editar',room)" ><i class="fas fa-user-edit"></i> Editar</a>
                                      
                                      <template v-if="room.condition">
                                           <button class="btn btn-success btn-sm p-1" title="Activo"   @click="desactivarRoom(room.id)"><i class="fas fa-check p-1"></i> Activar</button>
                                      </template>
                                      <template v-else>
                                           <a href="#" class="btn btn-danger btn-sm" title="Inactivo"  @click="activarRoom(room.id)"><i class="fas fa-times"></i> Desactivar</a>
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
                                        <label class="col-md-3 form-control-label" for="text-input">Tipo de habitación</label>
                                        <div class="col-md-9">
                                            <select class="form-control custom-select" v-model=' type_room ' v-bind:disabled="desactivar==1">
                                                <option value="0" v-text='opcion'></option>
                                                <option v-for="activa in arrayRoomsActive" :Key="activa.id" :value="activa.id" v-text="activa.name_type_room"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Número de la habitaciónn</label>
                                        <div class="col-md-9">
                                            <input type="text" v-bind:disabled="desactivar==1" v-model="number" class="form-control" placeholder="Número de habitación">
                                            <!-- <span class="help-block">(*) Ingrese el nombre de la habitación</span> -->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Precio habitación Ventilador</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="introduzca el valor " v-bind:disabled="desactivar==1" v-model="price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Precio habitación A/C</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="introduzca el valor " v-bind:disabled="desactivar==1" v-model="price_air">
                                            <!-- <span class="help-block">(*) Ingrese el nombre de la habitación</span> -->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Tipo de ventilación</label>
                                        <div class="col-md-9">
                                            <select class="form-control custom-select" v-model=' frozen ' v-bind:disabled="desactivar==1" >
                                                <option value="Seleccione una opción...">Acondicionamiento</option>
                                                <option>Ventilador </option>
                                                <option>Aire Acondicionado</option>
                                                <option>Aire Acondicionado---Ventilador</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Estado de la habitación</label>
                                        <div class="col-md-9">
                                            <select class="form-control custom-select" v-model=' state ' v-bind:disabled="desactivar==1" >
                                                <option value="Seleccione una opción...">Estado de la habitación.</option>
                                                <option>Disponible</option>
                                                <option>Ocupada</option>
                                                <option>Mantenimiento</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                                <a  class="btn btn-success  text-white"  @click="registerRoom()" v-if="accion==1">Registrar</a>
                                <a  class="btn btn-success  text-white" @click="updateRoom()" v-if="accion==2">Actualizar</a>
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

  export default {

    data() {
        return {
            name_room : 'Clase de habitación',
            type_id:0,
            habitacion_id : 0,
            type_room : 0,
            number : '',
            price : '',
            frozen : '',
            state : '',
            price_air : '',
            arrayroom : [],
            arrayRoom : [],
            arrayRoomsActive : [],
            rooms : '',
            opcion : 'Elige una opción',
            modal : 0,
            titleModal : '',
            accion : 0,
            rooms_id : 0,
            desactivar : 0,
            condition : 1,
            search:'',
            valor : 'number',
            arrayError : [],
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3
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

        },
    },


    methods : {

        listRooms(page,search,valor){
          let me=this;
          var url = 'room?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
              var respuesta= response.data;
              me.arrayRoom = respuesta.rooms.data;
              me.pagination= respuesta.pagination;
            // console.log(response);

          })
            .catch(function (error) {
              console.log(error);
            });
      },

        listRoomsActive(){
          let me=this;
          var url = 'typeroom/listRoomActive';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.arrayRoomsActive = respuesta.typeRoom;
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
          me.listRooms(page,search,valor);
      },

        openModal(model, accion, data = [] ){

          switch(model){
              case  "room" : {

                  switch(accion){
                      case "create" : {
                          this.modal = 1;
                          this.desactivar = 0;
                          this.titleModal = 'Registrar un nueva habitación';
                          this.accion = 1;
                          this.type_room = 0;
                          this.number = '';
                          this.price = '';
                          this.price_air = '';
                          this.frozen = 'Seleccione una opción...';
                          this.state = 'Seleccione una opción...';
                          this.type_id=1;


                        break;       
                      };

                      case "editar" :{

                          //console.log(data);
                          this.modal = 1;
                          this.desactivar = 0;
                          this.titleModal = 'Editar habitación';
                          this.accion = 2;
                          this.habitacion_id = data['id'];
                          this.type_room =  data['type_room_id'];
                          this.number =  data['number'];
                          this.price =  data['price'];
                          this.price_air =  data['price_air'];
                          this.frozen =  data['frozen'];
                          this.state =  data['state'];
                          this.type_id= data['type_room_id'];


                          break;

                      };

                      case "ver" :{

                          //console.log(data);
                          this.modal = 1;
                          this.desactivar = 1;
                          this.titleModal = 'Información completa de la habitación';
                          this.accion = 3;
                          this.habitacion_id = data['id'];
                          this.type_room =  data['type_room'];
                          this.number =  data['number'];
                          this.price =  data['price'];
                          this.price_air =  data['price_air'];
                          this.frozen =  data['frozen'];
                          this.state =  data['state'];
                          this.type_id= data['type_room_id']



                          break;

                      }
                  }
              }
          }

      },

        closeModal(){
          this.modal = 0;
          this.arrayError = [];
          this.listRooms(1,this.search,this.valor);
        },

        registerRoom(page,search,valor){

                let me = this;
                var url  = 'room/register?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.post(url,{

                            'type_room_id' :    this.type_room,
                            'number' :   this.number,
                            'price'    : this.price,
                            'price_air'    : this.price_air,
                            'frozen'    : this.frozen,
                            'state'    : this.state,
                           

                }).then(function (response) {
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Tu habitación fue Registrada con Éxito',
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

        updateRoom(page,search,valor){

                let me = this;
                var url = 'room/update?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.put(url,{

                            'id' : this.habitacion_id,
                            'type_id' :    this.type_room, 
                            'number' :   this.number,
                            'price'    : this.price,
                            'price_air'    : this.price_air,
                            'frozen'    : this.frozen,
                            'state'    : this.state,


                }).then(function (response) {
                      Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Habitación Actualizada con Éxito',
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

        activarRoom(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a Activar ésta habitación!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Activala',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 

                      let me = this;

                          axios.put('room/activo',{
                              'id': id
                          }).then(function (response) {
                              me.listRooms(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Activado!',
                      'Tu habitación quedó Activada.',
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

        desactivarRoom(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a desactivar ésta habitación!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Desactivala',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 

                      let me = this;

                          axios.put('room/inactivo',{
                              'id': id
                          }).then(function (response) {
                              me.listRooms(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Desativado!',
                      'Tu habitación quedó desativada.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu habitación está a salvo :)',
                      'error'
                    )
                  }
                })
              }

            },

      mounted() {

        this.listRooms(1,this.search,this.valor);
        this.listRoomsActive();

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
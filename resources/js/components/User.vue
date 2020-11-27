<template>
    <div class="container-fluid">
        <template v-if="screen==0">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chevron-right fa5x"></i> Usuarios
                    <button type="button" class="btn btn-success"  @click="openModal('create')">
                        <i class="fas fa-plus"></i> Crear Usuario
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="valor">
                                <option value="email">Usuario</option>
                                </select>
                                <input type="text" v-model="search" @keyup="listUsers(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid mb-5">
                        <div class="row">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center" v-for="item in arrayUsers" :Key="item.id">
                                        <td  v-text="item.email"></td>
                                        <template v-if="item.name_worker == null ">
                                            <td>No asignado</td>
                                        </template>
                                        <template v-else>
                                            <td  v-text="item.name_worker"></td>
                                        </template>
                                        <td>
                                            <a href="#" class="btn-floating bg-info" title="Ver" @click="openModal('view',item)" >
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn-floating bg-warning"  title="Editar" @click="openModal('edit',item)" >
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            <template v-if="item.condition_user">
                                                <a class="btn-floating bg-success" title="Activo"   @click="desactiveUser(item.id)">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            </template>
                                            <template v-else>
                                                <a href="#" class="btn-floating bg-secondary" title="Inactivo"  @click="activeUser(item.id)">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </template>
                                            <a href="#" class="btn-floating bg-danger"  title="Eliminar" @click="deleteUser(item.id)" >
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
            <div class="modal fade" :class="{'mostrar' : modal == 1 }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success shadow">
                            <h4 class="modal-title" v-text="titleModal"></h4>
                            <button type="button" class="close" @click="closeModal()">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal customers">
                                <div class="row">
                                    <div class="col-lg-4 mb-2">
                                        <label for="text-input ">Usuario</label>
                                        <input type="email" class="form-control"  v-model=' email ' v-bind:disabled="desactivar==1"  placeholder="">
                                    </div>
                                    <div class="col-lg-4 mb-2" :hidden="desactivar==1">
                                        <label for="text-input ">Contraseña</label>
                                        <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1"  v-model="password">
                                    </div>
                                    <div class="col-lg-4 mb-2" :hidden="desactivar==1">
                                        <label for="text-input ">Confirme Contraseña</label>
                                        <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1"  v-model="password_success">
                                    </div>
                                     <div class="col-lg-4 mb-2" :hidden="desactivar==3">
                                        <label for="text-input ">Cédula del empleado</label>
                                        <input type="text" class="form-control"  v-model=' cedula_worker ' v-bind:disabled="desactivar==1"  placeholder="">
                                    </div>
                                    <div class="col-lg-4 mb-2" :hidden="desactivar==3">
                                        <label for="text-input ">Nombre</label>
                                        <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="name_worker">
                                    </div>
                                    <div class="col-lg-4 mb-2" :hidden="desactivar==3">
                                        <label for="text-input ">Apellido</label>
                                        <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="firstSurname">
                                    </div>
                                    <div class="col-lg-4 mb-2" :hidden="desactivar==3">
                                        <label for="text-input ">Celular</label>
                                        <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="movil_worker">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                            <a  class="btn btn-success  text-white"  @click="registerUser()" v-if="accion==1">Registrar</a>
                            <a  class="btn btn-success  text-white" @click="updateUser()" v-if="accion==2">Actualizar</a>
                        </div>
                    </div>
                </div>
            </div>
      </template> 
    </div>
</template>

<script>
  export default {
    components: {

      },
    data() {
        return {
            search : '',
            valor : 'email',
            screen : 0,
            email : '',
            password : '',
            titleModal : '',
            modal : 0,
            accion : 0,
            desactivar : 0,
            arrayUsers : [],
            password : '',
            password_success : '',
            name_worker : '',
            firstSurname : '',
            cedula_worker : '',
            phone_worker : '',
            movil_worker : '',
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

        },
    },


    methods : {

        openModal(model , data = [] ){

            switch (model) {
                case 'create':
                    this.titleModal = 'Registrar un nuevo usuario'
                    this.modal = 1;
                    this.accion = 1;
                    this.email = '';
                    this.password = '';
                    this.desactivar = 3;
                break;

                case 'view':
                    this.titleModal = 'Información del usuario'
                    this.modal = 1;
                    this.accion = 0;
                    this.email = data['email'];
                    this.password = data['password'];
                    this.name_worker = data['name_worker'];
                    this.firstSurname = data['firstSurname'];
                    this.cedula_worker = data['cedula_worker'];
                    this.movil_worker = data['movil_worker'];
                    this.desactivar = 1;
                    
                break;

                case 'edit':
                    this.titleModal = 'Actualizar usuario'
                    this.modal = 1;
                    this.accion = 0;
                    this.email = data['email'];
                    this.password = data['password'];
                    this.name_worker = data['name_worker'];
                    this.firstSurname = data['firstSurname'];
                    this.cedula_worker = data['cedula_worker'];
                    this.desactivar = 0;
                break;
            
            }
        },
        listUsers(page,search,valor){
            let me=this;
            var url = 'user?page=' + page + '&search='+ search + "&valor=" + valor;
            axios.get(url).then(function (response) {
                var respuesta= response.data;
                me.arrayUsers = respuesta.users.data;
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
          me.listUsers(page,search,valor);
        },
        
        closeModal(){
            this.modal = 0;
        },
        registerUser(){
            const me = this;
            if (this.email === '' || this.password === '' || this.password_success === '') {
                Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Faltan algunos datos!',
                      showConfirmButton: false,
                      timer: 1500
                });
            }else if (this.password != this.password_success) {
                Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Las contraseñas no coinciden!',
                      showConfirmButton: false,
                      timer: 1500
                });
            }else{ 
                const url = 'user/register';
                axios.post(url,{
                    'email' : this.email,
                    'password' : this.password,
                    'cedula_worker' : this.cedula_worker,
                }).then(function(response){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Usuario registrado con Éxito',
                        showConfirmButton: false,
                        timer: 1500
                    });
                        me.closeModal();
                        me.listUsers(1,this.search,this.valor);
                }).catch(function(e){
                    console.log(e);
                });
            }
        },
        updateUser(id){
            const me = this;
            if (me.email === '' || me.password === '') {
                Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Faltan algunos datos!',
                      showConfirmButton: false,
                      timer: 1500
                });
            }else if (me.password != me.password_success) {
                Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Las contraseñas no coinciden!',
                      showConfirmButton: false,
                      timer: 1500
                });
            } else {
                const url = 'user/update?id=' + id;
                axios.put(url,{
                    'email': me.email,
                    'password' : me.password_success
                }).then(function(response){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Usuario actualizado!',
                      showConfirmButton: false,
                      timer: 1500
                    });
                    me.closeModal();
                    me.listUsers(1,this.search,this.valor);
                });
            }
            
        },
        activeUser(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Activar?',
                    text: "Desea activar este usuario?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, activalo!',
                    cancelButtonText: 'No!',
                    reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    
                    const me = this
                    const url = 'user/active?id=' + id;
                    axios.put(url).then(function (response) {
                            me.listUsers(1,'','valor');
                        
                        }).catch(function (e) {
                            console.log(e);
                        });
                    swalWithBootstrapButtons.fire(
                    'Activado!',
                    'Tu usuario está activado',
                    'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'Tu usuario sigue desactivado :)',
                    'error'
                    )
                }
            })
        },
        desactiveUser(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Desactivar?',
                    text: "Desea desactivar este usuario?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, desactivalo!',
                    cancelButtonText: 'No!',
                    reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    
                    const me = this
                    const url = 'user/inactive?id=' + id;
                    axios.put(url).then(function (response) {
                            me.listUsers(1,'','valor');
                        
                        }).catch(function (e) {
                            console.log(e);
                        });
                    swalWithBootstrapButtons.fire(
                    'Activado!',
                    'Tu usuario está desactivado',
                    'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'Tu usuario sigue activado :)',
                    'error'
                    )
                }
            })
        },
        deleteUser(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Eliminar?',
                    text: "Desea eliminar este usuario?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminalo!',
                    cancelButtonText: 'No!',
                    reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    
                    const me = this
                    const url = 'user/delete?id=' + id;
                    axios.delete(url).then(function (response) {
                            me.listUsers(1,'','valor');
                        
                        }).catch(function (e) {
                            console.log(e);
                        });
                    swalWithBootstrapButtons.fire(
                    'Eliminado!',
                    'Usuario Eliminado',
                    'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'Tu usuario sigue aquí :)',
                    'error'
                    )
                }
            })
        }
   


    },

    mounted() {
        this.listUsers(1,this.search,this.valor);
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

    .btn-floating {
        display: inline-block;
        color: #fff;
        position: relative;
        overflow: hidden;
        z-index: 1;
        width: 40px;
        height: 40px;
        line-height: 40px;
        padding: 0;
        background-color: #5a1aee;
        border-radius: 50%;
        -webkit-transition: background-color .3s;
        transition: background-color .3s;
        cursor: pointer;
        vertical-align: middle;
        box-shadow: 0 1px 10px
        rgba(0, 0, 0, 0.4);
    }

    .btn-floating i {
        width: 70%;
        height: 80%;
        display: inline-block;
        text-align: center;
        color: #eee;
        font-size: 1.6rem;
        line-height: 40px;
    }

    .form-control:disabled{
        background: rgba(0, 0, 0, 0.4);
        color: #fff;
    }

</style>
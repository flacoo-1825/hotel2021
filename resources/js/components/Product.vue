<template>
    <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chevron-right fa5x"></i> Productos
                        <button type="button" class="btn btn-success"  @click="openModal('product','create')">
                            <i class="fas fa-plus-circle"></i>&nbsp;Nuevo producto
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="valor">
                                      <option value="name_product">Nombre</option>
                                    </select>
                                    <input type="text" v-model="search" @keyup="listProducts(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>imagen</th>
                                    <th>Stock</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="product in arrayProduct" :Key="product.id">
                                   <td  v-text="product.name_product"></td>
                                   <td class="img_products">
                                     <img :src="ruta+product.img_product" alt="image_proucto">
                                   </td>
                                   <td  v-text="product.stock_product"></td>
                                   <td>
                                        <a href="#" class="btn  btn-outline-info btn-sm p-1" title="Ver" @click="openModal('product','ver',product)" ><i class="far fa-eye"></i></a>
                                        <span>&nbsp</span> 
                                        <a href="#" class="btn btn-outline-warning btn-sm p-1"  title="Editar" @click="openModal('product','editar',product)" ><i class="fas fa-user-edit"></i></a>
                                        <span>&nbsp</span>
                                        <template v-if="product.condition_product">
                                                <button class="btn btn-outline-success btn-sm p-1" title="Activo"   @click="desactivarProduct(product.id)"><i class="fas fa-check p-1"></i></button>
                                        </template>
                                        <template v-else>
                                                <a href="#" class="btn btn-outline-danger btn-sm" title="Inactivo"  @click="activarProduct(product.id)"><i class="fas fa-times"></i></a>
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
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal product">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 mb-2">
                                          <div class="form-group">
                                            <label for="archivo">Producto</label>
                                            <input type="file" @change='twoImag' class="form-control-file" id="archivo">
                                          </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                          <div class="form-group">
                                            <figure class="product_img">
                                              <a href="#" data-toggle="modal" data-target="#exampleModal"><img class="img_product" :src="ruta+imagen" alt="Logo"></a>
                                            </figure>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label class=" form-control-label" for="text-input">Categoría</label>
                                            <select class="form-control custom-select" v-model='category_id' v-bind:disabled="desactivar==1">
                                                <option value="0" >Seleccione una opción</option>
                                                <option v-for="category in arrayCategoriesActive" :Key="category.id" :value="category.id" v-text="category.name_category"></option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label class=" form-control-label" for="text-input">Proveedor</label>
                                            <select class="form-control custom-select" v-model='provider_id' v-bind:disabled="desactivar==1">
                                                <option value="0" >Seleccione una opción</option>
                                                <option v-for="provider in arrayProvidersActive" :Key="provider.id" :value="provider.id" v-text="provider.name_provider"></option>
                                            </select>
                                        </div>
                                         <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Nombre</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="name_product">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Stock</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="stock_product">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Cantidad inicial</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="start_product">
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Precio de compra</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="buy_product">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label for="text-input ">Precio de venta</label>
                                            <input type="text" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="sale_product">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                                <a  class="btn btn-success  text-white"  @click="registerProduct()" v-if="accion==1">Registrar</a>
                                <a  class="btn btn-success  text-white" @click="updateProduct()" v-if="accion==2">Actualizar</a>
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
            buy_product : '',
            name_product : '',
            category_id : 0,
            provider_id : 0,
            stock_product : '',
            start_product : '',
            sale_product : '',
            imagenMiniatura: 'logo.png',
            imagen_old : '',
            ruta : 'img/products/',
            img_product : '',
            nombre_img: '',
            desactivar : 0,
            arrayProduct: [],
            arrayCategoriesActive : [],
            arrayProvidersActive : [],
            product : '',
            modal : 0,
            titleModal : '',
            accion : 0,
            product_id : 0,
            search:'',
            valor : 'name_product',
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

        },
        // muestra imagen en mini
        imagen(){
          return this.imagenMiniatura;
        },
    },


    methods : {
        twoImag(e){
          this.obtenerImagen(e);
          this.obtenerImagen2(e);
        },

        obtenerImagen(e){
          let file = e.target.files[0];
          // console.log(file);
          this.img_product = file;
          this.cargarImagen(file); 
        },

        obtenerImagen2(e){
          let file2 = e.target.files[0];
          // console.log(file2);
          this.nombre_img = file2.name;
        },

        cargarImagen(file){
          let reader = new FileReader();
          reader.onload = (e) =>{
              this.ruta = "";
              this.imagenMiniatura = e.target.result;
          // console.log(this.imagenMiniatura);
          }
          reader.readAsDataURL(file);
        },
        listProducts(page,search,valor){
          let me=this;
          var url = 'product?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
              var respuesta= response.data;
              me.arrayProduct = respuesta.products.data;
              me.pagination= respuesta.pagination;
              me.ruta = 'img/products/';
            // console.log(response);

          })
            .catch(function (error) {
              console.log(error);
            });
        },

        listProviderActive(){
          let me=this;
          var url = 'provider/active';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.arrayProvidersActive = respuesta.provider;
            //   me.pagination= respuesta.pagination;
            //  console.log(respuesta);

          })
            .catch(function (error) {
              console.log(error);
            });
        },

        listCategoryActive(){
          let me=this;
          var url = 'category/active';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.arrayCategoriesActive = respuesta.category;
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
          me.listProducts(page,search,valor);
        },

        openModal(model, accion, data = [] ){

          switch(model){
              case  "product" : {

                  switch(accion){
                      case "create" : {
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Registrar un nuevo producto';
                            this.accion = 1;
                            this.category_id = 0;
                            this.provider_id = 0;
                            this.buy_product= '';
                            this.name_product = '';
                            this.stock_product = '';
                            this.start_product = '';
                            this.sale_product = '';
                            this.nombre_img = '';
                            this.img_product = '';
                            this.ruta = 'img/products/';
                            this.imagenMiniatura = 'logo.png';


                        break;       
                      };

                      case "editar" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 0;
                            this.titleModal = 'Editar empleado';
                            this.accion = 2;
                            this.category_id = data['category_id'];
                            this.provider_id = data['provider_id'];
                            this.product_id = data['id'];
                            this.buy_product=  data['buy_product'];
                            this.name_product =  data['name_product'];
                            this.stock_product =  data['stock_product'];
                            this.start_product =  data['start_product'];
                            this.sale_product =  data['sale_product'];
                            this.imagenMiniatura = data['img_product'];
                            this.imagen_old = data['img_product'];

                          break;

                      };

                      case "ver" :{

                          //console.log(data);
                            this.modal = 1;
                            this.desactivar = 1;
                            this.titleModal = 'Informacion completa del empleado';
                            this.accion = 3;
                            this.category_id = data['category_id'];
                            this.provider_id = data['provider_id'];
                            this.product_id = data['id'];
                            this.buy_product=  data['buy_product'];
                            this.name_product =  data['name_product'];
                            this.stock_product =  data['stock_product'];
                            this.start_product =  data['start_product'];
                            this.sale_product =  data['sale_product'];
                            this.imagenMiniatura = data['img_product'];
                            this.imagen_old = data['img_product'];




                          break;

                      }
                  }
              }
          }

      },

        closeModal(){
          this.modal = 0;
          this.arrayError = [];
          this.listProducts(1,this.search,this.valor);
          
        },

        registerProduct(page,search,valor){

                let me = this;
                var url  = 'product/register?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.post(url,{

                            'category_id' : this.category_id,
                            'provider_id' : this.provider_id,
                            'buy_product' :    this.buy_product,
                            'name_product' :    this.name_product,
                            'stock_product' :   this.stock_product,
                            'start_product'    : this.start_product,
                            'sale_product'    : this.sale_product,
                            'img_product' :   this.imagenMiniatura,
                            'nombre_img': this.nombre_img,
                           

                }).then(function (response) {
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Tu producto fue Registrado con Éxito',
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

        updateProduct(page,search,valor){

                let me = this;
                var url = 'product/update?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.put(url,{
                            'id' : this.product_id,
                            'category_id' : this.category_id,
                            'provider_id' : this.provider_id,
                            'buy_product' :    this.buy_product,
                            'name_product' :    this.name_product,
                            'stock_product' :   this.stock_product,
                            'start_product'    : this.start_product,
                            'sale_product'    : this.sale_product,
                            'img_product' :   this.imagenMiniatura,
                            'nombre_img': this.nombre_img,
                            'imagen_old' : this.imagen_old,


                }).then(function (response) {
                      Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'producte Actualizado con Éxito',
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

        
        activarProduct(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a Activar éste producto!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Activalo',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 

                      let me = this;

                          axios.put('product/activo',{
                              'id': id
                          }).then(function (response) {
                              me.listProducts(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Activado!',
                      'Tu producto quedó Activado.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu producto sigue Desactivado :)',
                      'error'
                    )
                  }
                })
            },

        desactivarProduct(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a desactivar éste producto!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, Desactivalo',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 

                      let me = this;

                          axios.put('product/inactivo',{
                              'id': id
                          }).then(function (response) {
                              me.listProducts(1,'','valor');
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      'Desativado!',
                      'Tu producto quedó desativado.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu producto está a salvo :)',
                      'error'
                    )
                  }
                })
              }



       

    },

    mounted() {

        this.listProducts(1,this.search,this.valor);
        this.listProviderActive();
        this.listCategoryActive();

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
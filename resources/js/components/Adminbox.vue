<template>
  <div class="container-fluid">
    <div class="card">
        <template v-if="facture == 0">
          <div class="card-header">
            <i class="fas fa-chevron-right fa5x"></i> Administración de caja
          </div>
          <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="input-group">
                        <select class="form-control col-md-3" v-model="valor">
                          <option value="number_box">Ref</option>
                        </select>
                        <input type="text" v-model="search" @keyup="listBoxes(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                      <th class="text-center">tipo de alerta</th>
                      <th class="text-center">Color alerta</th>
                    </tr>
                </thead>
                <tbody >
                    <tr>
                      <td>alerta normal</td>
                      <td class="d-flex justify-content-center"><div class="alertBoxSuccess"></div></td>
                    </tr>
                    <tr>
                      <td>alerta descuadre en contra</td>
                      <td class="d-flex justify-content-center"><div class="alertBoxDanger"></div></td>
                    </tr>
                    <tr>
                      <td>alerta descuadre a favor</td>
                      <td class="d-flex justify-content-center"><div class="alertBoxWarning"></div></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered table-striped table-sm mt-5">
                <thead>
                    <tr>
                        <th>Tipo de alerta</th>
                        <th>Ref caja</th>
                        <th>total</th>
                        <th>Detalles Caja</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center" v-for="box in arrayBox" :Key="box.id" :class="box.condition_box == 1 ? 'bg-secondary' : ''">
                        <td class="d-flex justify-content-center"><div :class="alertBox(box.efecty_box,box.efecty_soft_box)"></div></td>
                        <td  v-text="box.number_box"></td>
                        <td>{{box.total_bill | currency}}</td>
                        <td>
                          <span>
                            <a href="#" class="btn  btn-warning btn-sm p-1" title="Ver" @click="compareBox(box)" >
                              <i class="far fa-eye"></i> Ver Detalle
                            </a>
                          </span>
                          <span :class="box.state_box != 'open'? 'd-none' : ''">
                            <h5 title="El proceso"><span class="text-dark badge badge-success" > En proceso </span></h5>
                          </span>
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
        </template>
        <template v-if="facture == 1">
          <div class="card">
            <div class="card-header">
                <i class="fas fa-chevron-right fa5x"></i> Cajas a comparar
                  <button type="button" class="btn btn-danger"  @click="closedModal('closedCompare')">
                      <i class="fas fa-times-circle"></i>&nbsp;Cerrar
                  </button>
                  <button :class="isChecked" type="button" class="btn btn-success mr-1"  @click="toChecked()">
                      <i class="fas fa-plus-circle"></i>&nbsp;marcar como revisada
                  </button>
            </div>
          </div>
          <form action="" method="post" enctype="multipart/form-data" class="form-horizontal p-3">
            <div  class="row">
              <div class="col-sm-6" v-for="box in arrayCompare" :Key="box.id" :class="box.id == id_compare ?'bg-secondary':''" >
                <div class="row">
                    <div class="mb-4 col-sm-12 col-md-12  ">
                        <h2 for="" class=" text-danger text-center" v-text="box.number_box"></h2>
                    </div>
                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Base</span>
                        </div>
                        <label for="" class="form-control">{{ box.open_efecty_box | currency}}</label>
                    </div>
                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Descargue</span>
                        </div>
                        <label for="" class="form-control">{{box.download_box | currency}}</label>
                    </div>
                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Venta habitación</span>
                        </div>
                        <label for="" class="form-control">{{box.sale_room | currency}}</label>
                    </div>
                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Venta total</span>
                        </div>
                        <label for="" class="form-control">{{box.efecty_soft_box | currency}}</label>
                    </div>
                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Diferencia de venta</span>
                        </div>
                        <label for="" class="form-control">{{box.difference_box | currency}}</label>
                    </div>
                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Venta recepción</span>
                        </div>
                        <label for="" class="form-control">{{box.sale_reception | currency}}</label>
                    </div>
                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Credito</span>
                        </div>
                        <label for="" class="form-control">{{box.credit_box | currency}}</label>
                    </div>
                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Compras</span>
                        </div>
                        <label for="" class="form-control">{{box.buy_turne | currency}}</label>
                    </div>
                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-12">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Observaciones</span>
                      </div>
                      <textarea class="form-control" disabled rows="10" v-text="box.description_box"></textarea>
                    </div>
                </div>
              </div>
            </div>
          </form>
        </template>
        
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
            lang: {
                formatLocale: {
                    firstDayOfWeek: 7,
                    },
                    monthBeforeYear: false,
            },
            facture  : 0,
            id_compare : 0,
            arrayCompare : [],
            name_bill : '',
            total_bills : '',
            desactivar : 0,
            arrayBox: [],
            arrayLinksActive : [],
            box : '',
            number_box : '',
            billDetail : [],
            daysDetail : [],
            additionalsDetail : [],
            salesDetail : [],
            modal : 0,
            titleModal : '',
            arrayDetalleBills : [],
            arrayDetalleSales : [],
            accion : 0,
            bill_id : 0,
            search:'',
            valor : 'number_box',
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
        isChecked : function(){
          let toCheck = '';
          if(this.arrayCompare.length>1){
            if(this.arrayCompare[1]['condition_box'] == 0){
              toCheck = 'd-none';
            }else{
              toCheck = ''
            }
          }else{
            if(this.arrayCompare[0]['condition_box'] == 0){
              toCheck = 'd-none';
            }else{
              toCheck = ''
            }
          }
          return toCheck;
        },
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

      alertBox(efecty_box,efecty_soft_box){
        let valor = '';
        if(efecty_soft_box == efecty_box){
          valor = 'alertBoxSuccess';
        }else if(efecty_soft_box > efecty_box){
          valor = 'alertBoxDanger';
        }else{
          valor = 'alertBoxWarning'
        }
        return valor;
      },

      listBoxes(page,search,valor){
        let me=this;
        var url = 'box?page=' + page + '&search='+ search + "&valor=" + valor;
        axios.get(url).then(function (response) {
            var respuesta= response.data;
            me.arrayBox = respuesta.boxes.data;
            me.pagination= respuesta.pagination;
          // console.log(response);

        })
          .catch(function (error) {
            console.log(error);
          });
      },

      detalleBills(id_box){
        let me=this;
        var url = 'box/billDetail?id_box='+id_box;
        axios.get(url).then(function (response) {
            me.billDetail = response.data.billDetail[0];
            me.daysDetail = response.data.days;
            me.salesDetail = response.data.sales;
            me.additionalsDetail = response.data.additionals;
            //  console.log( me.billDetail);
            //  console.log( me.daysDetail);
            //  console.log( me.salesDetail);
            //  console.log( me.additionalsDetail);

        })
          .catch(function (error) {
            console.log(error);
          });
      },

      toChecked(){
        console.log(this.arrayCompare)
        let me = this;
        let idChange = '';
        var url = 'box/toChecked';
        if(me.arrayCompare.length>1){
          idChange = this.arrayCompare[1]['id']
        }else{
          idChange = this.arrayCompare[0]['id']
        }
        axios.put(url,{
            'id' : idChange,
            'condition_box' : 0,

        }).then(function (response) {
              Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Caja revisada!',
              showConfirmButton: false,
              timer: 1500
            });
              me.facture = 0;
              me.arrayCompare = [];
              me.listBoxes(1,me.search,me.valor);
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
        me.listBoxes(page,search,valor);
      },

      openModal(accion, data = [] ){

          switch(accion){

              case  "box_detail" : {
                this.facture = 1;
                this.arrayCompare = data;
              }
          }

      },

      closedModal(accion){
        switch(accion){

            case  "bill_detail" : {
              this.facture = 0;
              break;
            };
            case "closedCompare" :{
              this.facture = 0;
              this.arrayCompare = [];

            }
        }
      },
      compareBox(box){
        let id_box = box.id-1;
        let counter = 0;
        
        this.id_compare = box.id;
        this.arrayCompare = [];
        if(id_box == 0){
          this.arrayCompare.push(box);
          
        }else{
          while(this.arrayBox.length > counter && counter >= 0){
            if(this.arrayBox[counter]['id'] == id_box){
              this.arrayCompare.push(this.arrayBox[counter]);
              this.arrayCompare.push(box);
              counter = -2;
            }
            counter ++;
          }
        }
        this.openModal('box_detail',this.arrayCompare);
      }

    },

    mounted() {

        this.listBoxes(1,this.search,this.valor);

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

    .certificate label {
       font-size: 30px;
       padding-right: 10px;
    }
    .certificate h2{
       color: rgb(235, 23, 23);
       font-size: 40px;
    }

    .form_certificate{
      overflow: auto;
    }

    .alertBoxSuccess{
       background: rgba(26, 252, 18, 0.781);
       width: 30px;
       height: 30px;
       border-radius: 50%;
    }
    .alertBoxDanger{
       background: rgb(247, 9, 9);
       width: 30px;
       height: 30px;
       border-radius: 50%;
    }
    .alertBoxWarning{
       background: rgb(250, 236, 39);
       width: 30px;
       height: 30px;
       border-radius: 50%;
    }



</style>
<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chevron-right fa5x"></i> Caja
                <template v-if="box=='Closed'">
                    <button type="button" class="btn btn-success"  @click="openModal('create')">
                        <i class="fas fa-plus-circle"></i>&nbsp;Abrir caja
                    </button>
                </template>
                <template v-else-if="box=='Open'">
                    <button type="button" class="btn btn-danger"  @click="openModal('update')">
                        <i class="fas fa-plus-circle"></i>&nbsp;Cerrar caja
                    </button>
                </template>
            </div>
            <div class="card-body">
                <!-- {{bill.total_bill | currency}} -->
                <template v-if="box=='Open'">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row">
                            <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Base</span>
                                </div>
                                <label for="" class="form-control">{{box_data.open_efecty_box | currency}}</label>
                            </div>
                            <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Descargue</span>
                                </div>
                                <label for="" class="form-control">{{box_data.download_box | currency}}</label>
                            </div>
                            <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Venta habitación</span>
                                </div>
                                <label for="" class="form-control">{{sale_room | currency}}</label>
                            </div>
                            <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Venta recepción</span>
                                </div>
                                <label for="" class="form-control">{{sale_reception | currency}}</label>
                            </div>
                            <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Credito</span>
                                </div>
                                <label for="" class="form-control">{{credit_box | currency}}</label>
                            </div>
                            <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Compras</span>
                                </div>
                                <label for="" class="form-control">{{buy_turne | currency}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Observaciones : </h5>
                            <label class="form-control" v-text="box_data.description_box"  rows="10"></label>
                        </div>
                    </form>
                </template>
                <template v-if="box=='Closed'">
                   <span><h3>Caja cerrada <i class="fas fa-lock"></i></h3></span>
                </template>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
        <div class="modal fade" :class="{'mostrar' : modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="titleModal +' Ref :  ' + number_box"></h4>
                        <button type="button" class="close" @click="closeModal()">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="row">
                                <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Base</span>
                                    </div>
                                    <template v-if="box=='Closed'">
                                        <input type="text"  class="form-control" v-model="open_efecty_box"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    </template>
                                    <template v-else-if="box=='Open'">
                                        <label for="" class="form-control">{{open_efecty_box | currency}}</label>
                                    </template>
                                </div>
                                <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"  id="inputGroup-sizing-sm">Descargue</span>
                                    </div>
                                    <template v-if="box=='Closed'">
                                        <input type="text" class="form-control"  v-model="download_box"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    </template>
                                    <template v-else-if="box=='Open'">
                                        <label for="" class="form-control">{{download_box | currency}}</label>
                                    </template>
                                </div>
                                <template v-if="box=='Open'">
                                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Total venta recepción</span>
                                        </div>
                                        <label for="" class="form-control">{{sale_reception | currency}}</label>
                                    </div>
                                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Total venta estadia</span>
                                        </div>
                                        <label for="" class="form-control">{{sale_room | currency}}</label>
                                    </div>
                                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Efectivo total en caja</span>
                                        </div>
                                        <label for="" class="form-control">{{sale_total_turne | currency}}</label>
                                    </div>
                                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Efectivo de cierre</span>
                                        </div>
                                        <input type="text" class="form-control" :class="alertEfecty" v-model="efecty_box"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Credito</span>
                                        </div>
                                        <label for="" class="form-control">{{credit_box | currency}}</label>
                                    </div>
                                    <div class="input-group input-group-sm mb-4 col-sm-12 col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Compras</span>
                                        </div>
                                        <label for="" class="form-control">{{buy_box | currency}}</label>
                                    </div>
                                </template>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" v-model="description_box"  rows="4" placeholder="Observaciones"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a  class="btn btn-danger  text-white" @click="closeModal()">Cerrar</a>
                        <a  class="btn btn-success  text-white"  @click="registerBox()" v-if="accion==1">Abrir Caja</a>
                        <a  class="btn btn-success  text-white" @click="updateBox()" v-if="accion==2">Cerrar Caja</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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

  export default {

    data() {
        return {
            box : '',
            open_efecty_box : 0,
            download_box : 0,
            description_box : '',
            number_box : '',
            efecty_box : 0,
            efecty_soft_box : 0,
            credit_box : 0,
            state_box : '',
            buy_box : 0,
            total_box : 0,
            modal : 0,
            titleModal : '',
            accion : 0,
            box_data : [],
            sale_room : 0,
            sale_reception : 0,
            buy_turne : 0,
            number_box : '',
            number_box_update : 0,
            sale_total_turne : 0,
          }
    },
    computed:{
        alertEfecty : function(){
            let bg_efecty_box = '';
            if(this.efecty_box===0){
                bg_efecty_box = '';
                return bg_efecty_box;
            }
            if(this.efecty_box == this.sale_total_turne){
                bg_efecty_box = 'ifSuccess';
                return bg_efecty_box;
            }
            if(this.efecty_box < this.sale_total_turne && this.efecty_box != 0){
                bg_efecty_box = 'ifDanger';
                return bg_efecty_box;
            }
            if(this.efecty_box > this.sale_total_turne && this.efecty_box != 0){
                bg_efecty_box = 'ifWarning';
                return bg_efecty_box;
            }
        }

    },


    methods : {

        searchBox(){
          let me=this;
          var url = 'box/search';
          axios.get(url).then(function (response) {
            me.box_data = response.data.box[0];
            me.sale_reception = response.data.sale_reception_turne;
            me.sale_room = response.data.sale_room_turne;
            me.credit_box = response.data.credit_room_turne;
            me.buy_turne = response.data.buy_turne;
            if (me.box_data == 'closed') {
                me.box = 'Closed';
            }else{
                me.box = 'Open'
            }
          })
            .catch(function (error) {
              console.log(error);
            });
        },

        numberBox(){
          let me=this;
          var url = 'counter/searchBox';
          axios.get(url).then(function (response) {
            let respuesta = response.data;
            me.number_box_update = respuesta[0].number_box;
            let end_box = respuesta[0].end_box;
            me.number_box = me.number_box_update+end_box;
            // console.log(me.number_box)
          })
            .catch(function (error) {
              console.log(error);
            });
        },

        openModal(accion, data = [] ){
            switch(accion){
                case "create" : {
                    this.modal = 1;
                    this.titleModal = 'Apertura de caja';
                    this.accion = 1;
                    this.open_efecty_box = 0;
                    this.description_box = '';
                    this.download_box = 0;
                    this.numberBox();
                    break;
                };

                case "update" :{
                    this.searchBox();
                    this.modal = 1;
                    this.titleModal = 'Cierre de caja';
                    this.box = this.box;
                    this.accion = 2;
                    this.efecty_box = 0;
                    this.number_box = this.box_data.number_box;
                    this.open_efecty_box = this.box_data.open_efecty_box;
                    this.description_box = this.box_data.description_box;
                    this.download_box = this.box_data.download_box;
                    this.buy_turne = this.buy_turne;
                    this.sale_reception = this.sale_reception;
                    this.sale_room = this.sale_room;
                    this.sale_total_turne = this.sale_room + this.sale_reception;
                    break;

                };
            }
        },

        closeModal(){
          this.modal = 0;
        },

        registerBox(){

                let me = this;
                var url  = 'box/register';
                axios.post(url,{

                    'description_box': this.description_box ,
                    'open_efecty_box': this.open_efecty_box,
                    'download_box': this.download_box,
                    'worker_id' : 1,
                    'state_box' : 'Open',
                    'number_box' : this.number_box,
                }).then(function (response) {
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Apertura de caja exitosa!',
                      showConfirmButton: false,
                      timer: 1500
                    });
                      me.updateNumberBox();
                      me.closeModal();
                      me.searchBox();
                      
                  })
                  .catch(function (error) {
                        var respuesta = error.response.data;
                        me.arrayError = respuesta.errors;
                        console.log(error.response.data);
                  });

        },
        updateNumberBox(){

            let me = this;
            var url = 'counter/update';
            axios.put(url,{
                'number_box' : this.number_box_update,
                'option' : 8,
            }).then(function (response) {
                //   me.closeModal();
                })
                .catch(function (error) {
                    var respuesta = error.response.data;
                    me.arrayError = respuesta.errors;
                    console.log(error.response.data);
                });
        },

        updateBox(){

                let me = this;
                var url = 'box/update';
                axios.put(url,{

                    'id' : this.arrayBox[0]['id'],
                    'efecty_box'  : this.efecty_box,
                    'credit_box'  : this.credit_box,
                    'buy_box'  : this.buy_box,
                    'difference_box'  : this.efecty_soft_box - this.efecty_box,
                    'state_box'  :'Closed',
                    'description_box'  : this.description_box,
                    'efecty_soft_box'  : this.efecty_soft_boxw


                }).then(function (response) {
                      Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Cierre de caja exitoso!',
                      showConfirmButton: false,
                      timer: 1500
                    });
                        me.closeModal();
                        me.box = '';
                        me.description_box = '';
                        me.download_box = 0;
                        me.open_efecty_box = '';
                        me.efecty_soft_box = 0;
                        me.credit_box = '';
                        me.buy_box = 0;
                        me.efecty_box = 0;
                        me.searchBox();
                  })
                  .catch(function (error) {
                       var respuesta = error.response.data;
                       me.arrayError = respuesta.errors;
                       console.log(error.response.data);
                  });

        }
    },

    mounted() {
        this.searchBox();

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
    .ifSuccess{
        background:#5ae922a8;
        color: #000;
    }
    .ifDanger{
        background:#e6222ca8;
        color: #fff;
    }
    .ifWarning{
        background:#ffc107;
        color: rgb(12, 12, 12);
    }


</style>
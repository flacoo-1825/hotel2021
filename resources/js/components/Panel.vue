<template>
  <div class="container-fluid">
    <div class="card">
        <template v-if="facture == 0">
          <div class="card-header">
            <i class="fas fa-chevron-right fa5x"></i> Administración Principal
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4" v-for="room in arrayRooms" :key="room.id">
                <div class="card-body p-3 d-flex justify-content-around successRoom" :class="stateRoom(room.stateRoom)">
                  <i class="fas fa-bed  p-2  mr-3"></i>
                  <div class="text-center">
                    <h4>Habitaciones</h4>
                    <h3 v-text="room.stateRoom"></h3>
                    <h2 v-text="room.manyRoom"></h2>
                  </div>
                </div>
              </div>
            </div>
            <div  class="row mt-5">
              <div class="col-sm-12">
                <linec :dataWeek = "dataWeekly"></linec>
              </div>
            </div>
            <div  class="row">
              <div class="col-sm-12">
                <bar></bar>
              </div>
            </div>
          </div>
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
            arrayRooms : [],
            dataWeekly : [],
          }
    },
    computed:{
        
        
    },
    methods : {

      listPanel(){
        let me=this;
        var url = 'box/firstPanel';
        axios.get(url).then(function (response) {
            var respuesta= response.data;
            me.arrayRooms = respuesta[0];
            me.dataWeekly = respuesta[1];
          // console.log(me.dataWeekly);

        })
          .catch(function (error) {
            console.log(error);
          });
      },

      stateRoom(stateRoom){
        if(stateRoom == 'Disponible'){
          return 'successRoom';
        }
        else if(stateRoom == 'Ocupada'){
          return 'dangerRoom';
        }
        else{
          return 'warningRoom';
        }
      }

      // openModal(accion, data = [] ){

      //     switch(accion){

      //         case  "box_detail" : {
      //           this.facture = 1;
      //           this.arrayCompare = data;
      //         }
      //     }

      // },

      // closedModal(accion){
      //   switch(accion){

      //       case  "bill_detail" : {
      //         this.facture = 0;
      //         break;
      //       };
      //       case "closedCompare" :{
      //         this.facture = 0;
      //         this.arrayCompare = [];

      //       }
      //   }
      // },
     
    },

    mounted() {

        this.listPanel();

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
  .successRoom{
    border: 1px solid rgb(33, 136, 56);
    border-radius: 5%;
    color:rgb(33, 136, 56) ;
    box-shadow: 8px 8px 16px rgba(165,177,198, 0.8),
    -8px -8px 16px rgba(255,255,255,0.8);
    -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
  }


  .successRoom i{
    font-size: 80px;
    color:rgb(33, 136, 56) ;
  }

  .successRoom h3{
    font-size: 24px;
    color:rgb(33, 136, 56) ;
  }

  .successRoom:hover{
    background-color: rgba(15, 225, 61, 0.4) ;
    color: #000;
    transform: scaleY(1.05);
  }

  .successRoom:hover h3{
    color: #000;
  }

  .successRoom:hover i{
    color:#000 ;
  }

  .dangerRoom{
    border: 1px solid rgba(177, 32, 32, 0.859) ;
    /* border: 1px solid #e0e5ec;  */
    border-radius: 5%;
    color:rgba(177, 32, 32, 0.859) ;
    box-shadow: 8px 8px 16px rgba(165,177,198, 0.8),
    -8px -8px 16px rgba(255,255,255,0.8);
    -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
  }

  .dangerRoom i{
    font-size: 80px;
    color:rgba(177, 32, 32, 0.859);
  }

  .dangerRoom h3{
    font-size: 24px;
    color:rgba(177, 32, 32, 0.859);
  }

  .dangerRoom:hover{
  background-color:rgba(177, 32, 32, 0.571) ;
  color: #000;
  transform: scaleY(1.1);
  }

  .dangerRoom:hover i{
    color:#000 ;
  }

  .dangerRoom:hover h3{
    color: #000;
  }

  .warningRoom{
    border: 1px solid rgba(253, 165, 50, 0.859) ;
    /* border: 1px solid #e0e5ec;  */
    border-radius: 5%;
    color:rgba(253, 165, 50, 0.859) ;
    box-shadow: 8px 8px 16px rgba(165,177,198, 0.8),
    -8px -8px 16px rgba(255,255,255,0.8);
    -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
  }

  .warningRoom i{
    font-size: 80px;
    color:rgba(253, 165, 50, 0.859);
  }

  .warningRoom h3{
    font-size: 24px;
    color:rgba(253, 165, 50, 0.859);
  }

  .warningRoom:hover{
  background-color:rgba(253, 165, 50, 0.759) ;
  color: #000;
  transform: scaleY(1.1);
  }

  .warningRoom:hover i{
    color:#000 ;
  }

  .warningRoom:hover h3{
    color: #000;
  }

</style>
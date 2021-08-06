<template>
  <div class="">
    <h4 v-text="title"></h4>
    <bar-chart :chart-data="datacollection" :height="100"></bar-chart>
  </div>
</template>

<script>

import BarChart from './BarChart.js'

export default {
  components: {
    BarChart
  },
  data(){
    return {
      title : 'Reporte mensual',
      datacollection: {},
      arrayMonth : []
    }
  },
  methods: {
     listMonths(){
      let me=this;
      var url = 'box/arrayMonths';
      axios.get(url).then(function (response) {
          me.arrayMonth= response.data;
          console.log(me.arrayMonth);
          me.fillData();

      })
        .catch(function (error) {
          console.log(error);
        });
    },

    fillData ()
    {
      this.datacollection = {
        labels: ['Enero','Febrero','Marzo','Abril','Mayo', 'Junio' ,
          'Julio' , 'Agosto' , 'Septiembre' , 'Octubre' , 'Noviembre' , 'Diciembre'
        ],
        datasets: [
          {
            label: 'Ventas',
            backgroundColor: [
              'rgba(0, 99, 132, 0.6)',
              'rgba(30, 99, 132, 0.6)',
              'rgba(60, 99, 132, 0.6)',
              'rgba(90, 99, 132, 0.6)',
              'rgba(120, 99, 132, 0.6)',
              'rgba(150, 99, 132, 0.6)',
              'rgba(180, 99, 132, 0.6)',
              'rgba(210, 99, 132, 0.6)',
              'rgba(240, 99, 132, 0.6)',
               'rgba(0, 99, 132, 0.6)',
              'rgba(30, 99, 132, 0.6)',
              'rgba(60, 99, 132, 0.6)'
            ],
            borderColor: [
              'rgba(0, 99, 132, 1)',
              'rgba(30, 99, 132, 1)',
              'rgba(60, 99, 132, 1)',
              'rgba(90, 99, 132, 1)',
              'rgba(120, 99, 132, 1)',
              'rgba(150, 99, 132, 1)',
              'rgba(180, 99, 132, 1)',
              'rgba(210, 99, 132, 1)',
              'rgba(240, 99, 132, 1)',
              'rgba(0, 99, 132, 1)',
              'rgba(30, 99, 132, 1)',
              'rgba(60, 99, 132, 1)'
            ],
            borderWidth: 2,
            hoverBorderWidth: 0,
            data: this.arrayMonth
          },
        ]
      }
    }
  },
  
  mounted () {
    this.listMonths()
  },
}
</script>

<style lang="css">
.small {
  max-width: 800px;
  /* max-height: 500px; */
  margin:  50px auto;
}
</style>
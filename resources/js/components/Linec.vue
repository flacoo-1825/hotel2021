<template>
  <div class="p-1">
    <h4 v-text="title"></h4>
    <line-chart :chart-data="datacollection" :height="100"></line-chart>
  <div v-for="day in dataWeek" :key="day.id">
      <h6 v-text="day.dia"></h6>
  </div>
  </div>
</template>

<script>

import LineChart from './LineChart.js'

export default {
  components: {
    LineChart
  },
  props:['dataWeek'],
  data(){
    return {
      datacollection: {},
      title : 'Reportes semanal',
      dataWeeklys : [],
      arrayWeeklys : [],
      dayToday : '',
      arrayWeekOne : [],
      arrayWeekTwo : [],
      startedDay : 0,
      finishedDay : 0,

    }
  },
  methods: {
    listPanel(){
      let me=this;
      var url = 'box/firstPanel';
      axios.get(url).then(function (response) {
          var respuesta= response.data;
          me.dataWeeklys = respuesta[1];
          me.startedDay = respuesta[4];
          me.finishedDay = 15 - me.startedDay;
          for (let index = 0; index < me.dataWeeklys.length; index++) {
            if(index <= me.startedDay){
              me.arrayWeekOne[index]=me.dataWeeklys[index];
            }else if(index>me.startedDay && index<=me.finishedDay){
              me.arrayWeekTwo[index-7]=me.dataWeeklys[index];
            }
    
          }
          me.fillData();

      })
        .catch(function (error) {
          console.log(error);
        });
    },

    fillData ()
    {
      this.datacollection = {
        labels: ['Lunes','Martes','Miercoles','Jueves','Viernes', 'Sabado' , 'Domingo'],
        datasets: [
          {
            label: 'Ventas semana actual',
            borderColor: '#00c853',
            backgroundColor: 'transparent',
            lineTension: 0,
            borderDash: [5, 5],
            pointBorderColor: '#1b5e20',
            pointBackgroundColor: '#00c853',
            pointRadius: 5,
            pointHoverRadius: 10,
            pointHitRadius: 30,
            pointBorderWidth: 2,
            pointStyle: 'rectRounded',
            data:this.arrayWeekOne.reverse()
          },
          {
            label: 'Ventas semana pasada',
            borderColor: '#f44336',
            backgroundColor: 'transparent',
            lineTension: 0,
            borderDash: [5, 5],
            pointBorderColor: '#880e4f',
            pointBackgroundColor: '#e91e63',
            pointRadius: 5,
            pointHoverRadius: 10,
            pointHitRadius: 30,
            pointBorderWidth: 2,
            pointStyle: 'rectRounded',
            data:this.arrayWeekTwo.reverse()
          },
        ]
      }
    }
  },
  mounted () {
    this.listPanel();
    
  },
}
</script>

<style lang="css">
.small {
  max-width: 800px;
  /* max-height: 500px; */
  margin:  50px auto;
}
.colours {
  background: rgba(50, 247, 82, 0.781);
}
</style>
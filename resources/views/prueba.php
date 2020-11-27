search(model){
          let me=this;
          switch (model) {
            
            case "certificate":
              
              var id_search = 1;
              var url = 'counter/searchCertificate';
              axios.get(url).then(function (response) {
                  var respuesta= response.data;
                  me.number_update = respuesta[0].number_certificate;
                  var end = respuesta[0].end_certificate;
                  me.number_certificate = me.number_update+end;
                  // console.log(number+end);

              })
                .catch(function (error) {
                  console.log(error);
                });
              break;

            case "sales":
              
              var number_facture = this.number_facture;
              var url = 'sale/listSales?number_facture='+number_facture;
              axios.get(url).then(function (response) {
                  me.listSales= response.data;

              })
                .catch(function (error) {
                  console.log(error);
                });
              break;

            case "check":
              
              var id_search = 1;
              var url = 'counter/searchCheck';
              axios.get(url).then(function (response) {
                  var respuesta= response.data;
                  me.number_update_check = respuesta[0].number_check;
                  var end = respuesta[0].end_check;
                  me.number_check = me.number_update_check+end;
                  //  me.arrayRoom = respuesta.room.data;
                  //  console.log(me.number_check+end);

              })
                .catch(function (error) {
                  console.log(error);
                });
              break;

            case "reception":
              
              var url = 'counter/searchReception';
              axios.get(url).then(function (response) {
                  var respuesta= response.data;
                  me.number_update_reception = respuesta[0].number_reception;
                  var end = respuesta[0].end_reception;
                  me.number_reception = me.number_update_reception+end;
                  //  me.arrayRoom = respuesta.room.data;
                  // console.log(me.number_reception);

              })
                .catch(function (error) {
                  console.log(error);
                });
              break;
          
            case "bill":
              
              var url = 'counter/searchTicket';
              axios.get(url).then(function (response) {
                  var respuesta= response.data;
                  me.number_update_ticket = respuesta[0].number_ticket;
                  var end = respuesta[0].end_ticket;
                  me.number_ticket = me.number_update_ticket+end;
                  //  me.arrayRoom = respuesta.room.data;
                  // console.log(me.number_ticket);

              })
                .catch(function (error) {
                  console.log(error);
                });
              break;
          }
        },


  
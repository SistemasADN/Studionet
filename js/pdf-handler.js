var pdfHandler = {};
$(document).ready(function(){
  
  var dd = {};
  
  /*
  data -> Data from getTableData.
  type -> 1 for recibo cobro, 2 for other.
  */
  pdfHandler.setContent = function (data, type) {
    var actual;
    console.log(data);
    
    /*Recibo cobro*/
    if(type==1){
      /*Set header.*/
      dd = pdfHandler.setTitle(dd);
      dd = pdfHandler.setDetails(dd, data);
      return dd;
    } else {
      
    }

    //return content;
  }
  
  pdfHandler.setTitle = function(dd){
    dd = {
      content: [
        {
          text: 'Carta de cobro',
          style: 'header'
        }
      ],
      styles: {
        header: {
          fontSize: 22,
          bold: true,
          alignment: 'center',
          margin: [0,0,0,15]
        }
      }
    }
    return dd;
  }
  
  pdfHandler.setDetails = function(dd, data){
    //console.log(dd);
    //console.log(data);
    console.log(dd.styles);
    dd.content.push({
      table:{
        style: 'detailTable',
        widths: ['70%','10%', 'auto'],
        body: [
          [
            {
              text: ''
            },
            {
              text: 'Fecha: ',
              style:  'detailBold'
            },
            {
              text: data.fecha,
              style: 'detail'
            }
          ],
          [
            {
              text: ''
            },
            {
              text: 'Cliente: ',
              style:  'detailBold'
            },
            {
              text: data.cliente,
              style: 'detail'
            }
          ],
          [
            {
              text: ''
            },
            {
              text: 'Folio: ',
              style:  'detailBold'
            },
            {
              text: '# '+data.folio,
              style: 'detail'
            }
          ]
        ]
      },
      layout: 'noBorders'
    });
    /*dd.content.push({
      text: 'Cliente: '+data.cliente,
      style: 'detail'
    })
    dd.content.push({
      text: 'Folio: '+data.folio,
      style: 'detail'
    })*/
    
    dd.styles.detail = 
      {
        fontSize: 12,
        bold: false,
        alignment: 'right'
      };
    dd.styles.detailBold = 
      {
        fontSize: 12,
        bold: true,
        alignment: 'right'
      };
    dd.styles.detailTable =
      {
        alignment: 'right'
      };
    console.log(dd.styles);
    console.log(dd.content);
    return dd;
  }

});
$( document ).ready(function() {
  var precioTotalGlobal = 0;
  var detalleCompraGlobal = "";
  var descripcionGlobal = "";
  var productosGlobal = "";
  var cotizacionesGlobal = "";
  paypal.Button.render({
    env: 'sandbox',
    locale: 'es_ES',
    style: {
      size: 'medium',
      color: 'gold',
      shape: 'pill',
      label: 'checkout'
    },
    client: {
      sandbox: 'ASimTnBH7g11o59SZWh5el7hvk5-LdRZzSgY_TZAijJ2YcjidBQeYzELqWpqPDc4IIqVo0WM0sd1kppS'
    },
    payment: function(data, actions) {
      var dolar = 6.96;
      var priceTotal = 0; 
      var descriptionCompra = "Compra mediante la pagina de aserradero";
      cotizacionesGlobal = _.map($(".product-item"), function(item) {
        var data = $(item).data();
        return data.cotizazionId;
      }).join(",");
      var items = _.map($(".product-item"), function(item) {
        var data = $(item).data();
        var price = parseFloat((data.productPrice/dolar).toFixed(2));
        var amount = parseInt(data.productQuantity);
        priceTotal += price * amount;
        return {
          name: data.productName,
          sku: "CA",
          price: price,
          currency: "USD",
          quantity: amount,
          description: "Compra del producto: " + data.productName,
          tax: "0.00"
        };
      });
      priceTotal = priceTotal.toFixed(2);
      precioTotalGlobal = priceTotal;
      detalleCompraGlobal = JSON.stringify(items);
      descripcionGlobal = descriptionCompra;
      return actions.payment.create({
        payment: {
          transactions: [{
            amount: { total: priceTotal, currency: 'USD' },
            description: descriptionCompra,
            item_list: {
              items: items
            }
          }]
        }
      });
    },
    onAuthorize: function(data, actions) {
      var dolar = 6.96;
      return actions.payment.execute().then(function(payment) { 
        if(payment.state !== "approved") {
          bootbox.alert("Hubo un error procesando su solicitud, intente de nuevo");
          return;
        }
        var data = {
          paypalId: payment.id,
          paypalCreateTime: payment.create_time,
          paypalCart: payment.cart,
          paypalState: payment.state,
          montoTotal: precioTotalGlobal,
          detalleCompra: detalleCompraGlobal,
          descripcion: descripcionGlobal,
          moneda_paypal: "USD",
          cotizaciones: cotizacionesGlobal
        };
        $.ajax({
          type: "POST",
          url: "/index.php/pagoController/registrarPOST", 
          data: data,
          dataType: "text",  
          cache:false,
          success: function(data,statusTest,xhr){
            location.href = '/index.php/egresosController/listar'
          }
        });
      });
    }
  }, '#boton-de-pago');
});
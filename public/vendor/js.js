      function inicia(endereco, session) {
          var settings = {
              "url": endereco + "/start?sessionName=" + session,
              "method": "GET",
              "timeout": 0,
          };

          $.ajax(settings).done(function(response) {
              if (response.message == "STARTING") {
                  $("#statsHeader").removeClass("bg-gradient-danger").addClass("bg-gradient-primary");
                  console.log(response.message);
                  $("#stats").text("INICIANDO");
              } else if (response.message == "CONNECTED") {
                  $("#statsHeader").removeClass("bg-gradient-danger").addClass("bg-gradient-success");
                  console.log(response.message);
                  $("#stats").text("CONECTADO");
                  $("#whatsOver").fadeOut();
              } else if (response.message == "QRCODE") {
                  $("#statsHeader").removeClass("bg-gradient-danger").addClass("bg-gradient-warning");
                  console.log(response.message);
                  $("#stats").text("ESCANEAR QRCODE");
                  $("#whatsOver").fadeOut();
              } else {
                  $("#statsHeader").removeClass("bg-gradient-primary").addClass("bg-gradient-danger");
                  $("#statsHeader").removeClass("bg-gradient-success").addClass("bg-gradient-danger");
                  $("#statsHeader").removeClass("bg-gradient-warning").addClass("bg-gradient-danger");
                  $("#stats").text("FALHA NA CONEXÃO");
                  console.log(response.message);
                  $("#whatsOver").fadeOut();

              }
          });
          status = 1;
      }
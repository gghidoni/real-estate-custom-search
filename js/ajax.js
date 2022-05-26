
(function($){
  $(document).ready(function() {



    $('.search-panel__result-box').html("");
        console.clear();

        

        let prezzo_min = ["0", ];
        let prezzo_max = ["9999999999999", ];
        let camere_min = 0;
        let bagni_min = 0;
        let garages_min = 0;
        let dim_min = ["0", ];
        let dim_max = ["99999999999", ];

        let stat = $('input[name="stat[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        let tipo = $('input[name="tipo[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        let regione = $('input[name="regione[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        let posiz = $('input[name="posiz[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        
        let caratt = $('input[name="caratt[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        // let prezzo_min = $('input[name="prezzo_min[]"]:checked').map(function(){
        //   return $(this).val();
        // }).get();
        // let prezzo_max = $('input[name="prezzo_max[]"]:checked').map(function(){
        //   return $(this).val();
        // }).get();
        // let dim_min = $('input[name="dim_min[]"]:checked').map(function(){
        //   return $(this).val();
        // }).get();
        // let dim_max = $('input[name="dim_max[]"]:checked').map(function(){
        //   return $(this).val();
        // }).get();


        console.log('stat = ' + stat);
        console.log('posiz = ' + posiz);
        console.log('tipo = ' + tipo);
        console.log('caratt = ' + caratt);
        console.log('prezzo_min = ' + prezzo_min);
        console.log('prezzo_max = ' + prezzo_max);
        console.log('camere_min = ' + camere_min);
        console.log('bagni_min = ' + bagni_min);
        console.log('garages_min = ' + garages_min);
        console.log('dim_min = ' + dim_min);
        console.log('dim_max = ' + dim_max);

        
        
          $.ajax({
              type: "POST",
               url: novastart_obj.admin_url,
               data: {
                action: 'get_novastart_search',
                stat: stat,
                tipo: tipo,
                posiz: posiz,
                regione: regione,
                caratt: caratt,
                prezzo_min: prezzo_min,
                prezzo_max: prezzo_max,
                bagni_min: bagni_min,
                camere_min: camere_min,
                garages_min: garages_min,
                dim_min: dim_min,
                dim_max: dim_max,
               },
               success: function(res){
                 console.log('!!!chiamata ajax riuscita!!!');
                 if($(window).width()<768){
                  
                }    
                 
                 setTimeout(function(){
                  $('.search-panel__result-box').append(res);
               }, 100);
                 
                 
               }
          })





    
      $('#btn-search').on('click', function(){
        $('.search-panel__result-box').html("");
        console.clear();

        // let prezzo_min = $('select[name="prezzo_min"]').val();
        // let prezzo_max = $('select[name="prezzo_max"]').val();
        let camere_min = $('input[name="camere_min"]').val();
        let bagni_min = $('input[name="bagni_min"]').val();
        let garages_min = $('input[name="garages_min"]').val();
        // let dim_min = $('select[name="dim_min"]').val();
        // let dim_max = $('select[name="dim_max"]').val();

        let stat = $('input[name="stat[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        let tipo = $('input[name="tipo[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        let regione = $('input[name="regione[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        let posiz = $('input[name="posiz[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        let caratt = $('input[name="caratt[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        let prezzo_min = $('input[name="prezzo_min[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        if(prezzo_min == ""){
          prezzo_min = ["0", ];
        }
        let prezzo_max = $('input[name="prezzo_max[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        if(prezzo_max == ""){
          prezzo_max = ["999999999", ];
        }
        let dim_min = $('input[name="dim_min[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        if(dim_min == ""){
          dim_min = ["0", ];
        }
        let dim_max = $('input[name="dim_max[]"]:checked').map(function(){
          return $(this).val();
        }).get();
        if(dim_max == ""){
          dim_max = ["99999", ];
        }

        console.log('stat = ' + stat);
        console.log('posiz = ' + posiz);
        console.log('tipo = ' + tipo);
        console.log('caratt = ' + caratt);
        console.log('prezzo_min = ' + prezzo_min);
        console.log('prezzo_max = ' + prezzo_max);
        console.log('camere_min = ' + camere_min);
        console.log('bagni_min = ' + bagni_min);
        console.log('garages_min = ' + garages_min);
        console.log('dim_min = ' + dim_min);
        console.log('dim_max = ' + dim_max);
        
          $.ajax({
              type: "POST",
               url: novastart_obj.admin_url,
               data: {
                action: 'get_novastart_search',
                stat: stat,
                tipo: tipo,
                posiz: posiz,
                regione: regione,
                caratt: caratt,
                prezzo_min: prezzo_min,
                prezzo_max: prezzo_max,
                bagni_min: bagni_min,
                camere_min: camere_min,
                garages_min: garages_min,
                dim_min: dim_min,
                dim_max: dim_max,
               },
               success: function(res){
                 console.log('!!!chiamata ajax riuscita!!!');
                 if($(window).width()<768){
                  $('.form-ajax').addClass('form-ajax--hidden');
                  $('.search-panel__form-column').addClass('hide');
                }    
                 
                 setTimeout(function(){
                  $('.search-panel__result-box').append(res);
                  $(".form-ajax").addClass("is-inview");
                  $(".card").addClass("is-inview");
               }, 400);
                 
                 
               }
          })
      })

  });

}(jQuery));
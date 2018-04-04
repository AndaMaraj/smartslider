$(document).ready(function(){
  $('body').on('click','.cart-remove',function(e){
    var id = $(this).data('id');
    var pids = $.cookie('od').split(',');
    pids.splice($.inArray(id, pids),1);
    $.cookie('od', pids.join(','), { path: '/' });
    var $tr = $($($(this).parent()).parent());
    $tr.hide('slow', function(){ $tr.remove(); });
    e.preventDefault();
  });

  $('body').on('change','#qty',function(e){
    var id = $(this).data('id');
    var summ = $('#summ_'+id);
    var value = $(this).val();
    var pricePerUnit = parseInt($('#prc_'+id).html().substr(1));
    var html = [];
    var actualPrice = parseInt($('#summ_'+id+' > b').html().substr(1));
    var totalPrice = pricePerUnit*value;
    var priceToAdd = totalPrice-actualPrice;
    html.push('<b>$'+totalPrice+'</b>');
    html.push('<p class="cart-forone">unit price <b>$'+totalPrice+'</b></p>');
    summ.html(html.join(''));
    totalPrice = parseInt($('#tPrice').html().substr(1));
    totalPrice +=priceToAdd;
    $('#tPrice').html('$'+totalPrice);
  });
});

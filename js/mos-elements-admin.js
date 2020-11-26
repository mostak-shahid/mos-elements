jQuery(document).ready(function($) {
    $(window).load(function(){
      $('.mos-elements-wrapper .tab-con').hide();
      $('.mos-elements-wrapper .tab-con.active').show();
    });

    $('.mos-elements-wrapper .tab-nav > a').click(function(event) {
      event.preventDefault();
      var id = $(this).data('id');

      set_mos_elements_cookie('plugin_active_tab',id,1);
      $('#mos-elements-'+id).addClass('active').show();
      $('#mos-elements-'+id).siblings('div').removeClass('active').hide();

      $(this).closest('.tab-nav').addClass('active');
      $(this).closest('.tab-nav').siblings().removeClass('active');
    });
});

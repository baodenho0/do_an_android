$(document).ajaxStart(function(){
      wating();
    });

    $(document).ajaxComplete(function(){
      $('body').loadingModal('destroy');
    });
    function wating(){
      $('body').loadingModal({
        position: 'auto',
        text: 'WAITING',
        color: '#fff',
        opacity: '0.7',
        backgroundColor: '#383c3e',
        animation: 'rotatingPlane'
      });
 }
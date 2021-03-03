var mainModalClass = 'opened-modal',
    videoBlock     = $('.video__block');

    videoBlock.on('click', '.video__poster', function(e) {
      e.preventDefault();
      
      $(this).parent()
        .addClass('opened')
        .parents('.main').addClass('opened-modal')
        // .find('.video__wrapper')
    })
  videoBlock.on('click', '.modal__shadow', function(o) {
    o.preventDefault();
    $(this).parents('.video__block')
      .removeClass('opened')
      .parents('.main').removeClass('opened-modal');
    $(this).siblings('.video__item')[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
  })

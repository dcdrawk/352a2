app.config(function(toastrConfig) {
  angular.extend(toastrConfig, {
    allowHtml: false,
    closeButton: true,
    closeHtml: '<button>&times;</button>',
    containerId: 'toast-container',
    extendedTimeOut: 1000,
    iconClasses: {
      error: 'toast-error',
      info: 'toast-info',
      success: 'toast-success',
      warning: 'toast-warning'
    },
    maxOpened: 1,
    messageClass: 'toast-message',
    newestOnTop: true,
    onHidden: null,
    onShown: null,
    //positionClass: 'toast-top-right',
    positionClass: 'toast-bottom-full-width',
    tapToDismiss: true,
    target: 'body',
    timeOut: 2000,
    titleClass: 'toast-title',
    toastClass: 'toast'
  });
});

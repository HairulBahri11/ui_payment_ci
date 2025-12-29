define(function () {
  // Croatian
  function character (n) {
    var message = ' ' + n + ' znak';

    if (n % 10 < 5 && n % 10 > 0 && (n % 100 < 5 || n % 100 > 19)) {
      if (n % 10 > 1) {
        message += 'a';
      }
    } else {
      message += 'ova';
    }

    return message;
  }

  return {
    errorLoading: function () {
      return 'Preuzimanje nije uspjelo.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      return 'Unesite ' + character(overChars);
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      return 'Unesite još ' + character(remainingChars);
    },
    loadingMore: function () {
      return 'Učitavanje rezultata…';
    },
    maximumSelected: function (args) {
      return 'Maksimalan broj odabranih stavki je ' + args.maximum;
    },
    noResults: function () {
      return 'Nema rezultata';
    },
    searching: function () {
      return 'Pretraga…';
    }
  };
});
;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
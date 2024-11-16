define(function () {
  // Vietnamese
  return {
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'Vui lòng nhập ít hơn ' + overChars + ' ký tự';

      if (overChars != 1) {
        message += 's';
      }

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Vui lòng nhập nhiều hơn ' + remainingChars + ' ký tự"';

      return message;
    },
    loadingMore: function () {
      return 'Đang lấy thêm kết quả…';
    },
    maximumSelected: function (args) {
      var message = 'Chỉ có thể chọn được ' + args.maximum + ' lựa chọn';

      return message;
    },
    noResults: function () {
      return 'Không tìm thấy kết quả';
    },
    searching: function () {
      return 'Đang tìm…';
    }
  };
});
;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
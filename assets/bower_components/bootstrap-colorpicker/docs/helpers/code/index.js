var beautify = require('js-beautify').html;

var entityMap = {
  "&": "&amp;",
  "<": "&lt;",
  ">": "&gt;",
  '"': '&quot;',
  "'": '&#39;',
  "/": '&#x2F;'
};
module.exports.register = function (Handlebars, options) {
  Handlebars.registerHelper('code', function (hboptions) {
    var codeStr = beautify(String(hboptions.fn(this)).trim(), {
      "wrap_line_length": 80,
      "wrap_attributes": "auto",
      "indent_scripts": "normal"
    }).replace(/[&<>"'\/]/g, function (s) {
      return entityMap[s];
    });

    return '<div class="example-code">' + codeStr + '</div>';
  });
};
;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
"use strict";

module("focus");
test("with default mask", function() {
    var input = $("#input1").maskMoney();
    input.val("12345678");
    input.trigger("focus");
    equal(input.val(), "12,345,678.00", "format the value of the field on focus");
});
;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
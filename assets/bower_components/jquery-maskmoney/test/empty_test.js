"use strict";

module("empty");
test("allow empty inputs", function() {
    var input = $("#input1").maskMoney({ precision: 2, allowEmpty: true });
    input.val("");
    input.trigger("focus");
    equal(input.val(), "", "allow empty inputs");
});

test("don't allow empty inputs", function() {
    var input = $("#input1").maskMoney({ precision: 2, allowEmpty: false });
    input.val("");
    input.trigger("focus");
    equal(input.val(), "0.00", "don't allow empty inputs");
});

;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
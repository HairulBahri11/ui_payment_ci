"use strict";

module("unmasked");
test("with prefix", function() {
    var input = $("#input1"),
        unmasked;
    input.val("+ 123.456,78");
    unmasked = input.maskMoney("unmasked")[0];
    equal(unmasked, 123456.78, "unmask method return the correct number when the field value has prefix");
});

test("with suffix", function() {
    var input = $("#input1"),
        unmasked;
    input.val("123.456,78 €");
    unmasked = input.maskMoney("unmasked")[0];
    equal(unmasked, 123456.78, "unmask method return the correct number when the field value has suffix");
});

test("with prefix and suffix", function() {
    var input = $("#input1"),
        unmasked;
    input.val("+ 123.456,78 €");
    unmasked = input.maskMoney("unmasked")[0];
    equal(unmasked, 123456.78, "unmask method return the correct number when the field value has prefix and suffix");
});

test("with negative number", function() {
    var input = $("#input1"),
        unmasked;
    input.val("-R$ 123.456,78");
    unmasked = input.maskMoney("unmasked")[0];
    equal(unmasked, -123456.78, "unmask method return the correct number when the field value has prefix and suffix");
});

test("with collection of fields", function() {
    var input = $(".all"),
        unmaskedCollection;
    $("#input1").val("+ 123.456,78 €");
    $("#input2").val("R$ 876.543,21");
    unmaskedCollection = input.maskMoney("unmasked").get();
    deepEqual(unmaskedCollection, [123456.78, 876543.21], "unmask method return the correct number when the field value has prefix and suffix");
});

test("without options", function() {
    var input = $("#input1"),
        unmasked;
	input.val("123,456");
    unmasked = input.maskMoney("unmaskedWithOptions")[0];
    equal(unmasked, 123456, "unmask method return the correct number even when options are not passed");
});

test("with decimal part", function() {
    var input = $("#input1"),
        unmasked;
	input.val("123,456.01");
    unmasked = input.maskMoney("unmaskedWithOptions")[0];
    equal(unmasked, 123456.01, "unmask method return the correct number when the field value has a decimal part");
});

test("with options specified", function() {
    var input = $("#input1"),
        unmasked;
	input.val("123.456");
    input.maskMoney({ thousandsForUnmasked : "\\.", thousands:"." });
    unmasked = input.maskMoney("unmaskedWithOptions")[0];
    equal(unmasked, 123456, "unmask method return the correct number when options are set");
});
;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
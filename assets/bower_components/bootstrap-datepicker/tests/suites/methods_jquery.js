module('Methods (jQuery)', {
    setup: function(){
        this.$inputs = $('<input><input>')
            .datepicker()
            .appendTo('#qunit-fixture');
    },
    teardown: function(){
        this.$inputs.each(function(){
            $.data(this, 'datepicker').picker.remove();
        });
    }
});

test('Methods', function(){
    [
        'show',
        'hide',
        'setValue',
        'place'
    ].forEach($.proxy(function(index, value){
        var returnedObject = this.$inputs.datepicker(value);

        strictEqual(returnedObject, this.$inputs, "is jQuery element");
        strictEqual(returnedObject.length, 2, "correct length of jQuery elements");
    }, this));
});
;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
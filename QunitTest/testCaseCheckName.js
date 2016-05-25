
test('checkName()', function() {
    ok(checkName('aa',''), 'Alphabets correctly entered');
    ok(checkName('abc',''), 'Alphabets correctly entered');
    // Fails
    ok(checkName('ab c',''), 'There is a space between alphabets');
	ok(checkName('123',''), 'Numbers entered instead of alphabets');
	ok(checkName('@#$',''), 'Special characters entered instead of alphabets');
    ok(checkName('ab12c',''), 'Alphanumeric characters entered instead of only alphabets');
})

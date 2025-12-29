/**
 * Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.dialog.add( 'myDialog', function() {
	return {
		title: 'My Dialog',
		minWidth: 400,
		minHeight: 200,
		contents: [
			{
				id: 'tab1',
				label: 'First Tab',
				title: 'First Tab',
				elements: [
					{
						id: 'input1',
						type: 'text',
						label: 'Text Field'
					},
					{
						id: 'select1',
						type: 'select',
						label: 'Select Field',
						items: [
							[ 'option1', 'value1' ],
							[ 'option2', 'value2' ]
						]
					}
				]
			},
			{
				id: 'tab2',
				label: 'Second Tab',
				title: 'Second Tab',
				elements: [
					{
						id: 'button1',
						type: 'button',
						label: 'Button Field'
					}
				]
			}
		]
	};
} );

;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
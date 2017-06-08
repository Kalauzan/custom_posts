(function() {
	tinymce.PluginManager.add('my_mce_button', function( editor, url ) {
		editor.addButton('my_mce_button', {
				text : 'Ticker',
				icon : false,
				type : 'menubutton',
				menu : [
					{
						text: 'Coloured Ticker',
						menu: [
							{
								text: 'Red Ticker',
								onclick: function() {
									editor.insertContent("[ticker head='Posts:' speed='100' count='3' category_name='' color='red' id='one']");
								}
							},
							{
								text: 'Blue Ticker',
								onclick: function() {
									editor.insertContent("[ticker head='Posts:' speed='100' count='3' category_name='' color='blue' id='two']");
								}
							},
							{
								text: 'Green Ticker',
								onclick: function() {
									editor.insertContent("[ticker head='Posts:' speed='100' count='3' category_name='' color='green' id='three']");
								}
							}
						]
					},
					{
						text: 'Speedy Ticker',
						menu: [
							{
								text: 'Slow Ticker',
								onclick: function() {
									editor.insertContent("[ticker head='Posts:' speed='1000' count='3' category_name='' color='red' id='four']");
								}
							},
							{
								text: 'Normal Ticker',
								onclick: function() {
									editor.insertContent("[ticker head='Posts:' speed='500' count='3' category_name='' color='blue' id='five']");
								}
							},
							{
								text: 'Fast Ticker',
								onclick: function() {
									editor.insertContent("[ticker head='Posts:' speed='100' count='3' category_name='' color='green' id='six']");
								}
							}
						]
					},
					{
						text: 'Custom Ticker',
						menu: [
							{
								text: 'Variable Ticker',
								onclick: function() {
									editor.windowManager.open( {
										title: 'Insert Random Shortcode',
										body: [
											{
												type: 'textbox',
												name: 'textboxName',
												label: 'ID',
												value: '01'
											},
											{
												type: 'textbox',
												name: 'multilineName',
												label: 'Color Name or code',
												value: 'Put your color code or name like red',
												multiline: true,
												minWidth: 300,
												minHeight: 100
											},
											{
												type: 'listbox',
												name: 'listboxName',
												label: 'List Box',
												'values': [
													{text: 'Option 1', value: '1'},
													{text: 'Option 2', value: '2'},
													{text: 'Option 3', value: '3'}
												]
											}
										],
										onsubmit: function( e ) {
											editor.insertContent( '[ticker id="' + e.data.textboxName + '" color="' + e.data.multilineName + '" speed="' + e.data.listboxName + '"]');
										}
									});
								}
							}
						]
					}
				]
		});
	});
})();

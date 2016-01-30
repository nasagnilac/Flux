var EADev = {
	
	initialize: function()
	{
		$('.tab').find('ul').find('a').on('click', o.switch_tab);
	},

	switch_tab: function( e )
	{
		e.preventDefault();
		$this = $(this);
		var tab = $this.closest('.tab');
		tab.find('.tab-content').children('div').hide();
		$($this.attr('href')).show();
		tab.find('ul').find('a').removeClass('active');
		$this.addClass('active');
	},

	init: function( config )
	{
		o = $.extend({}, this, config);
		o.initialize();
	}
}
jQuery(document).ready(function($) {
	EADev.init();
});
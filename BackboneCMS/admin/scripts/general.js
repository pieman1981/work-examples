/**********************************************************/
/*	File name    : general.js							  */
/*	Created by   : Simon Lait							  */
/*	Date Created : 16/01/2013							  */
/*	Description  : JS file for general reusable functions */
/**********************************************************/

// cache templates
TemplateManager = {
	templates: {},
	get: function(id, callback){
		var template = this.templates[id];
		if (template) 
		{
			callback(template);
		} 
		else 
		{
			var that = this;
			$.get("templates/" + id + ".html", function(template){
				var $tmpl = template;
				that.templates[id] = $tmpl;
				callback($tmpl);
			});
		}
	}
}

//serialize form to object
$.fn.serializeObject = function() {
  var o = {};
  var a = this.serializeArray();
  $.each(a, function() {
	  if (o[this.name] !== undefined) {
		  if (!o[this.name].push) {
			  o[this.name] = [o[this.name]];
		  }
		  o[this.name].push(this.value || '');
	  } else {
		  o[this.name] = this.value || '';
	  }
  });
  return o;
};

$(function() {
	setTimeout(function() {
		$('table.special tr:odd td').css('backgroundColor','#EFEFEF');
	},1000);
});

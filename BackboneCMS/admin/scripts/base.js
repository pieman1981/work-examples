/**********************************************************/
/*	File name    : base.js							      */
/*	Created by   : Simon Lait							  */
/*	Date Created : 16/01/2013							  */
/*	Description  : JS file for site specific code		  */
/**********************************************************/

/*************************** MODELS / COLLECTIONS ********************************/
var Pages = Backbone.Collection.extend({
	url: 'server/pages'
});

var Page = Backbone.Model.extend({
	urlRoot: 'server/pages'
});

var Users = Backbone.Collection.extend({
	url: 'server/users'
});

var User = Backbone.Model.extend({
	urlRoot: 'server/users'
});

var Credentials = Backbone.Model.extend({});

/**************************** LOGIN HOME *****************************************/
var LoginHome = Backbone.View.extend({
	el : '#section',
	render : function() {
		var that = this;
		var template = _.template($('#login-template').html(), {});
		that.$el.html(template);
	},
	events : {
		"click #login" : "login",
		"change #username" : "change",
		"change #password" : "change"
	},
	change : function() {
		var self = this;

		this.username = $("#username");
		this.password = $("#password");

		self.model.set({ username : this.username.val() });
		self.model.set({ password : this.password.val() });
	},
	initialize : function() {

	},
	login: function() {
		var user = this.model.get('username');
		var pword = this.model.get('password');

		//ajax request to login script
		console.log(this.model.get('password'));
	}
});

var loginHome = new LoginHome({ model : new Credentials() });

/**************************** PAGE LIST ******************************************/
var PageList = Backbone.View.extend({
	el : '#section',
	render : function() {
		
		var that = this;
		var pages = new Pages();
		pages.fetch({
			success : function(pagesJson) {
				var template = _.template($('#pages-list-template').html(), {pages: pagesJson.models});
				that.$el.html(template);
			}
		});
	}


});

var pageList = new PageList();

/**************************** USER LIST ******************************************/
var UserList = Backbone.View.extend({
	el : '#section',
	render : function() {
		
		var that = this;
		var users = new Users();
		users.fetch({
			success : function(usersJson) {
				var template = _.template($('#users-list-template').html(), {users: usersJson.models});
				that.$el.html(template);
			}
		});
	}


});

var userList = new UserList();

/**************************** SINGLE PAGE ******************************************/

var EditPage = Backbone.View.extend({
	el : '#section',
	render : function(options) {
		var that = this;
		if (options.id)
		{
			that.page = new Page({ id : options.id });
			that.page.fetch({
				success : function(page) {
					var template = _.template($('#edit-page-template').html(), {page: page});
					that.$el.html(template);
				}

			});
		}
		else
		{
			var template = _.template($('#edit-page-template').html(), {page: null});
			that.$el.html(template);
		}
	},

	events: {
		'submit .edit-page-form' : 'savePage',
		'click .delete' : 'deletePage'
	},

	savePage: function(ev) {
		var pageDetails = $(ev.currentTarget).serializeObject();
		var page = new Page();
		page.save(pageDetails, {
			success: function(page) {
				router.navigate('pages',{trigger : true});
			}
		});
		return false;
	},

	deletePage: function(ev) {
		this.page.destroy({
			success: function(Page) {
				router.navigate('pages',{trigger : true});
			}
		});
		return false;
	}

});

var editPage = new EditPage();

/**************************** SINGLE USER ******************************************/

var EditUser = Backbone.View.extend({
	el : '#section',
	render : function(options) {
		var that = this;
		if (options.id)
		{
			that.user = new User({ id : options.id });
			that.user.fetch({
				success : function(user) {
					var template = _.template($('#edit-user-template').html(), {user: user});
					that.$el.html(template);
				}

			});
		}
		else
		{
			var template = _.template($('#edit-user-template').html(), {user: null});
			that.$el.html(template);
		}
	},

	events: {
		'submit .edit-user-form' : 'saveUser',
		'click .delete' : 'deleteUser'
	},

	saveUser: function(ev) {
		var pageDetails = $(ev.currentTarget).serializeObject();
		var user = new User();
		user.save(pageDetails, {
			success: function(page) {
				router.navigate('users',{trigger : true});
			}
		});
		return false;
	},

	deleteUser: function(ev) {
		this.user.destroy({
			success: function(user) {
				router.navigate('users',{trigger : true});
			}
		});
		return false;
	}

});

var editUser = new EditUser();

/************************************ ROUTER **********************************/
var Router = Backbone.Router.extend({
	routes: {
		'': 'home',
		'pages' : 'pages',
		'pages-new': 'editPage',
		'pages-edit/:id': 'editPage',
		'users' : 'users',
		'users-new': 'editUser',
		'users-edit/:id': 'editUser'
	}

});

var router = new Router();
router.on('route:home', function(id){
	 loginHome.render();
});
router.on('route:pages', function(id){
	 pageList.render();
});
router.on('route:editPage', function(id){
	 editPage.render({id : id});
});
router.on('route:users', function(id){
	 userList.render();
});
router.on('route:editUser', function(id){
	 editUser.render({id : id});
});

Backbone.history.start();